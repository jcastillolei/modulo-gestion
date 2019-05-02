<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createusuario_normalRequest;
use App\Http\Requests\Updateusuario_normalRequest;
use App\Repositories\usuario_normalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\log;
use Flash;
use Response;

class usuario_normalController extends AppBaseController
{
    /** @var  usuario_normalRepository */
    private $usuarioNormalRepository;

    public function __construct(usuario_normalRepository $usuarioNormalRepo)
    {
        $this->usuarioNormalRepository = $usuarioNormalRepo;
    }

    /**
     * Display a listing of the usuario_normal.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $usuarioNormals = $this->usuarioNormalRepository->all();

        return view('usuario_normals.index')
            ->with('usuarioNormals', $usuarioNormals);
    }

    /**
     * Show the form for creating a new usuario_normal.
     *
     * @return Response
     */
    public function create()
    {
        return view('usuario_normals.create');
    }

    /**
     * Store a newly created usuario_normal in storage.
     *
     * @param Createusuario_normalRequest $request
     *
     * @return Response
     */
    public function store(Createusuario_normalRequest $request)
    {
        $input = $request->all();

        $usuarioNormal = $this->usuarioNormalRepository->create($input);

        Flash::success('Usuario Normal creado correctamente.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha creado un usuario normal.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('usuarioNormals.index'));
    }

    /**
     * Display the specified usuario_normal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $usuarioNormal = $this->usuarioNormalRepository->find($id);

        if (empty($usuarioNormal)) {
            Flash::error('Usuario Normal not found');

            return redirect(route('usuarioNormals.index'));
        }

        return view('usuario_normals.show')->with('usuarioNormal', $usuarioNormal);
    }

    /**
     * Show the form for editing the specified usuario_normal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $usuarioNormal = $this->usuarioNormalRepository->find($id);

        if (empty($usuarioNormal)) {
            Flash::error('Usuario Normal not found');

            return redirect(route('usuarioNormals.index'));
        }

        return view('usuario_normals.edit')->with('usuarioNormal', $usuarioNormal);
    }

    /**
     * Update the specified usuario_normal in storage.
     *
     * @param int $id
     * @param Updateusuario_normalRequest $request
     *
     * @return Response
     */
    public function update($id, Updateusuario_normalRequest $request)
    {
        $usuarioNormal = $this->usuarioNormalRepository->find($id);

        if (empty($usuarioNormal)) {
            Flash::error('Usuario Normal not found');

            return redirect(route('usuarioNormals.index'));
        }

        $usuarioNormal = $this->usuarioNormalRepository->update($request->all(), $id);

        Flash::success('Usuario Normal actualizado correctamente.');

        return redirect(route('usuarioNormals.index'));
    }

    /**
     * Remove the specified usuario_normal from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $usuarioNormal = $this->usuarioNormalRepository->find($id);

        if (empty($usuarioNormal)) {
            Flash::error('Usuario Normal not found');

            return redirect(route('usuarioNormals.index'));
        }

        $this->usuarioNormalRepository->delete($id);

        Flash::success('Usuario Normal eliminado.');

        return redirect(route('usuarioNormals.index'));
    }
}
