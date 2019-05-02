<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createuser_rolRequest;
use App\Http\Requests\Updateuser_rolRequest;
use App\Repositories\user_rolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class user_rolController extends AppBaseController
{
    /** @var  user_rolRepository */
    private $userRolRepository;

    public function __construct(user_rolRepository $userRolRepo)
    {
        $this->userRolRepository = $userRolRepo;
    }

    /**
     * Display a listing of the user_rol.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userRols = $this->userRolRepository->all();

        return view('user_rols.index')
            ->with('userRols', $userRols);
    }

    /**
     * Show the form for creating a new user_rol.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_rols.create');
    }

    /**
     * Store a newly created user_rol in storage.
     *
     * @param Createuser_rolRequest $request
     *
     * @return Response
     */
    public function store(Createuser_rolRequest $request)
    {
        $input = $request->all();

        $userRol = $this->userRolRepository->create($input);

        Flash::success('User Rol creado correctamente.');

        return redirect(route('userRols.index'));
    }

    /**
     * Display the specified user_rol.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userRol = $this->userRolRepository->find($id);

        if (empty($userRol)) {
            Flash::error('User Rol not found');

            return redirect(route('userRols.index'));
        }

        return view('user_rols.show')->with('userRol', $userRol);
    }

    /**
     * Show the form for editing the specified user_rol.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userRol = $this->userRolRepository->find($id);

        if (empty($userRol)) {
            Flash::error('User Rol not found');

            return redirect(route('userRols.index'));
        }

        return view('user_rols.edit')->with('userRol', $userRol);
    }

    /**
     * Update the specified user_rol in storage.
     *
     * @param int $id
     * @param Updateuser_rolRequest $request
     *
     * @return Response
     */
    public function update($id, Updateuser_rolRequest $request)
    {
        $userRol = $this->userRolRepository->find($id);

        if (empty($userRol)) {
            Flash::error('User Rol not found');

            return redirect(route('userRols.index'));
        }

        $userRol = $this->userRolRepository->update($request->all(), $id);

        Flash::success('User Rol actualizado correctamente.');

        return redirect(route('userRols.index'));
    }

    /**
     * Remove the specified user_rol from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userRol = $this->userRolRepository->find($id);

        if (empty($userRol)) {
            Flash::error('User Rol not found');

            return redirect(route('userRols.index'));
        }

        $this->userRolRepository->delete($id);

        Flash::success('User Rol eliminado.');

        return redirect(route('userRols.index'));
    }
}
