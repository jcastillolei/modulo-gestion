<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createusuario_bodegaRequest;
use App\Http\Requests\Updateusuario_bodegaRequest;
use App\Repositories\usuario_bodegaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\User;
use App\Models\locations;
use App\Models\log;
use Illuminate\Support\Collection;
use App\Models\usuario_bodega;

class usuario_bodegaController extends AppBaseController
{
    /** @var  usuario_bodegaRepository */
    private $usuarioBodegaRepository;

    public function __construct(usuario_bodegaRepository $usuarioBodegaRepo)
    {
        $this->usuarioBodegaRepository = $usuarioBodegaRepo;
    }

    /**
     * Display a listing of the usuario_bodega.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $usuarioBodegas = $this->usuarioBodegaRepository->all();

        return view('usuario_bodegas.index')
            ->with('usuarioBodegas', $usuarioBodegas);
    }

    /**
     * Show the form for creating a new usuario_bodega.
     *
     * @return Response
     */
    public function create()
    {
        $usuarios = User::pluck('name','id');
        $bodegas = locations::pluck('location_name','loc_code');

        return view('usuario_bodegas.create', compact('usuarios','bodegas'));
    }

    /**
     * Store a newly created usuario_bodega in storage.
     *
     * @param Createusuario_bodegaRequest $request
     *
     * @return Response
     */
    public function store(Createusuario_bodegaRequest $request)
    {
        $input = $request->all();

        $usuarioBodega = $this->usuarioBodegaRepository->create($input);

        Flash::success('Usuario Bodega creado correctamente.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha creado un usuario bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('usuarioBodegas.index'));
    }

    /**
     * Display the specified usuario_bodega.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $usuarioBodega = $this->usuarioBodegaRepository->find($id);

        if (empty($usuarioBodega)) {
            Flash::error('Usuario Bodega not found');

            return redirect(route('usuarioBodegas.index'));
        }

        return view('usuario_bodegas.show')->with('usuarioBodega', $usuarioBodega);
    }

    /**
     * Show the form for editing the specified usuario_bodega.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $usuarioBodega = $this->usuarioBodegaRepository->find($id);

        if (empty($usuarioBodega)) {
            Flash::error('Usuario Bodega not found');

            return redirect(route('usuarioBodegas.index'));
        }

        $usuarios = User::pluck('name','id');
        $bodegas = locations::pluck('location_name','loc_code');

        return view('usuario_bodegas.edit',compact('usuarios','bodegas'))->with('usuarioBodega', $usuarioBodega);
    }

    /**
     * Update the specified usuario_bodega in storage.
     *
     * @param int $id
     * @param Updateusuario_bodegaRequest $request
     *
     * @return Response
     */
    public function update($id, Updateusuario_bodegaRequest $request)
    {
        $usuarioBodega = $this->usuarioBodegaRepository->find($id);

        if (empty($usuarioBodega)) {
            Flash::error('Usuario Bodega not found');

            return redirect(route('usuarioBodegas.index'));
        }

        $usuarioBodega = $this->usuarioBodegaRepository->update($request->all(), $id);

        Flash::success('Usuario Bodega actualizado correctamente.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha actualizado un usuario bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('usuarioBodegas.index'));
    }

    /**
     * Remove the specified usuario_bodega from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $usuarioBodega = $this->usuarioBodegaRepository->find($id);

        if (empty($usuarioBodega)) {
            Flash::error('Usuario Bodega not found');

            return redirect(route('usuarioBodegas.index'));
        }

        $usr = usuario_bodega::find($id);
        $usr->delete();

        Flash::success('Usuario Bodega eliminado.');

        return redirect(route('usuarioBodegas.index'));
    }
}
