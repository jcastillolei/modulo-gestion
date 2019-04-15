<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateuserRequest;
use App\Http\Requests\UpdateuserRequest;
use App\Repositories\userRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\log;
use App\Models\roles;
use App\Models\user_rol;
use App\User;
use DB;

use Illuminate\Support\Facades\Hash;


class userController extends AppBaseController
{
    /** @var  userRepository */
    private $userRepository;

    public function __construct(userRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all();

        $roles = roles::pluck('nombre','id');

        return view('users.index', compact('roles'))
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
        $roles = roles::pluck('nombre','id');

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param CreateuserRequest $request
     *
     * @return Response
     */
    public function store(CreateuserRequest $request)
    {
        $input = $request->all();

        $user = User::create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => Hash::make($request->input("password")),
        ]);

        $us = DB::table('users')->where('email', $request->input("email"))->first();

        $user_rol = new user_rol;

        $user_rol->idUser = $us->id;
        $user_rol->idRol = $request->input("rol");

        $user_rol->save();

        Flash::success('User saved successfully.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha creado un usuario.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('users.index'));
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $roles = roles::pluck('nombre','id');

        return view('users.edit', compact('roles'))->with('user', $user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param int $id
     * @param UpdateuserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateuserRequest $request)
    {
        //$user = $this->userRepository->find($id);

        $user = User::find($id);

        $user->name=$request->input("name");
        $user->email=$request->input("email");
        
        $user->password=Hash::make($request->input("password"));

        $user->save();

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha actualizado un usuario bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }
}
