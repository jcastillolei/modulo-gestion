<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createtipo_transaccionRequest;
use App\Http\Requests\Updatetipo_transaccionRequest;
use App\Repositories\tipo_transaccionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\log;

class tipo_transaccionController extends AppBaseController
{
    /** @var  tipo_transaccionRepository */
    private $tipoTransaccionRepository;

    public function __construct(tipo_transaccionRepository $tipoTransaccionRepo)
    {
        $this->tipoTransaccionRepository = $tipoTransaccionRepo;
    }

    /**
     * Display a listing of the tipo_transaccion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tipoTransaccions = $this->tipoTransaccionRepository->all();

        return view('tipo_transaccions.index')
            ->with('tipoTransaccions', $tipoTransaccions);
    }

    /**
     * Show the form for creating a new tipo_transaccion.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_transaccions.create');
    }

    /**
     * Store a newly created tipo_transaccion in storage.
     *
     * @param Createtipo_transaccionRequest $request
     *
     * @return Response
     */
    public function store(Createtipo_transaccionRequest $request)
    {
        $input = $request->all();

        $tipoTransaccion = $this->tipoTransaccionRepository->create($input);

        Flash::success('Tipo Transaccion saved successfully.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha creado un nuevo tipo transaccion.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('tipoTransaccions.index'));
    }

    /**
     * Display the specified tipo_transaccion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoTransaccion = $this->tipoTransaccionRepository->find($id);

        if (empty($tipoTransaccion)) {
            Flash::error('Tipo Transaccion not found');

            return redirect(route('tipoTransaccions.index'));
        }

        return view('tipo_transaccions.show')->with('tipoTransaccion', $tipoTransaccion);
    }

    /**
     * Show the form for editing the specified tipo_transaccion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoTransaccion = $this->tipoTransaccionRepository->find($id);

        if (empty($tipoTransaccion)) {
            Flash::error('Tipo Transaccion not found');

            return redirect(route('tipoTransaccions.index'));
        }

        return view('tipo_transaccions.edit')->with('tipoTransaccion', $tipoTransaccion);
    }

    /**
     * Update the specified tipo_transaccion in storage.
     *
     * @param int $id
     * @param Updatetipo_transaccionRequest $request
     *
     * @return Response
     */
    public function update($id, Updatetipo_transaccionRequest $request)
    {
        $tipoTransaccion = $this->tipoTransaccionRepository->find($id);

        if (empty($tipoTransaccion)) {
            Flash::error('Tipo Transaccion not found');

            return redirect(route('tipoTransaccions.index'));
        }

        $tipoTransaccion = $this->tipoTransaccionRepository->update($request->all(), $id);

        Flash::success('Tipo Transaccion updated successfully.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha actualizado un usuario bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('tipoTransaccions.index'));
    }

    /**
     * Remove the specified tipo_transaccion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoTransaccion = $this->tipoTransaccionRepository->find($id);

        if (empty($tipoTransaccion)) {
            Flash::error('Tipo Transaccion not found');

            return redirect(route('tipoTransaccions.index'));
        }

        $this->tipoTransaccionRepository->delete($id);

        Flash::success('Tipo Transaccion deleted successfully.');

        return redirect(route('tipoTransaccions.index'));
    }
}
