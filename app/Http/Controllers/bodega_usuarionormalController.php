<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createbodega_usuarionormalRequest;
use App\Http\Requests\Updatebodega_usuarionormalRequest;
use App\Repositories\bodega_usuarionormalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class bodega_usuarionormalController extends AppBaseController
{
    /** @var  bodega_usuarionormalRepository */
    private $bodegaUsuarionormalRepository;

    public function __construct(bodega_usuarionormalRepository $bodegaUsuarionormalRepo)
    {
        $this->bodegaUsuarionormalRepository = $bodegaUsuarionormalRepo;
    }

    /**
     * Display a listing of the bodega_usuarionormal.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $bodegaUsuarionormals = $this->bodegaUsuarionormalRepository->all();

        return view('bodega_usuarionormals.index')
            ->with('bodegaUsuarionormals', $bodegaUsuarionormals);
    }

    /**
     * Show the form for creating a new bodega_usuarionormal.
     *
     * @return Response
     */
    public function create()
    {
        return view('bodega_usuarionormals.create');
    }

    /**
     * Store a newly created bodega_usuarionormal in storage.
     *
     * @param Createbodega_usuarionormalRequest $request
     *
     * @return Response
     */
    public function store(Createbodega_usuarionormalRequest $request)
    {
        $input = $request->all();

        $bodegaUsuarionormal = $this->bodegaUsuarionormalRepository->create($input);

        Flash::success('Bodega Usuarionormal saved successfully.');

        return redirect(route('bodegaUsuarionormals.index'));
    }

    /**
     * Display the specified bodega_usuarionormal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bodegaUsuarionormal = $this->bodegaUsuarionormalRepository->find($id);

        if (empty($bodegaUsuarionormal)) {
            Flash::error('Bodega Usuarionormal not found');

            return redirect(route('bodegaUsuarionormals.index'));
        }

        return view('bodega_usuarionormals.show')->with('bodegaUsuarionormal', $bodegaUsuarionormal);
    }

    /**
     * Show the form for editing the specified bodega_usuarionormal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bodegaUsuarionormal = $this->bodegaUsuarionormalRepository->find($id);

        if (empty($bodegaUsuarionormal)) {
            Flash::error('Bodega Usuarionormal not found');

            return redirect(route('bodegaUsuarionormals.index'));
        }

        return view('bodega_usuarionormals.edit')->with('bodegaUsuarionormal', $bodegaUsuarionormal);
    }

    /**
     * Update the specified bodega_usuarionormal in storage.
     *
     * @param int $id
     * @param Updatebodega_usuarionormalRequest $request
     *
     * @return Response
     */
    public function update($id, Updatebodega_usuarionormalRequest $request)
    {
        $bodegaUsuarionormal = $this->bodegaUsuarionormalRepository->find($id);

        if (empty($bodegaUsuarionormal)) {
            Flash::error('Bodega Usuarionormal not found');

            return redirect(route('bodegaUsuarionormals.index'));
        }

        $bodegaUsuarionormal = $this->bodegaUsuarionormalRepository->update($request->all(), $id);

        Flash::success('Bodega Usuarionormal updated successfully.');

        return redirect(route('bodegaUsuarionormals.index'));
    }

    /**
     * Remove the specified bodega_usuarionormal from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bodegaUsuarionormal = $this->bodegaUsuarionormalRepository->find($id);

        if (empty($bodegaUsuarionormal)) {
            Flash::error('Bodega Usuarionormal not found');

            return redirect(route('bodegaUsuarionormals.index'));
        }

        $this->bodegaUsuarionormalRepository->delete($id);

        Flash::success('Bodega Usuarionormal deleted successfully.');

        return redirect(route('bodegaUsuarionormals.index'));
    }
}
