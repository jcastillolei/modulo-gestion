<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransaccionesRequest;
use App\Http\Requests\UpdateTransaccionesRequest;
use App\Repositories\TransaccionesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TransaccionesController extends AppBaseController
{
    /** @var  TransaccionesRepository */
    private $transaccionesRepository;

    public function __construct(TransaccionesRepository $transaccionesRepo)
    {
        $this->transaccionesRepository = $transaccionesRepo;
    }

    /**
     * Display a listing of the Transacciones.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $transacciones = $this->transaccionesRepository->all();

        return view('transacciones.index')
            ->with('transacciones', $transacciones);
    }

    /**
     * Show the form for creating a new Transacciones.
     *
     * @return Response
     */
    public function create()
    {
        return view('transacciones.create');
    }

    /**
     * Store a newly created Transacciones in storage.
     *
     * @param CreateTransaccionesRequest $request
     *
     * @return Response
     */
    public function store(CreateTransaccionesRequest $request)
    {
        $input = $request->all();

        $transacciones = $this->transaccionesRepository->create($input);

        Flash::success('Transacciones creado correctamente..');

        return redirect(route('transacciones.index'));
    }

    /**
     * Display the specified Transacciones.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transacciones = $this->transaccionesRepository->find($id);

        if (empty($transacciones)) {
            Flash::error('Transacciones not found');

            return redirect(route('transacciones.index'));
        }

        return view('transacciones.show')->with('transacciones', $transacciones);
    }

    /**
     * Show the form for editing the specified Transacciones.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transacciones = $this->transaccionesRepository->find($id);

        if (empty($transacciones)) {
            Flash::error('Transacciones not found');

            return redirect(route('transacciones.index'));
        }

        return view('transacciones.edit')->with('transacciones', $transacciones);
    }

    /**
     * Update the specified Transacciones in storage.
     *
     * @param int $id
     * @param UpdateTransaccionesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransaccionesRequest $request)
    {
        $transacciones = $this->transaccionesRepository->find($id);

        if (empty($transacciones)) {
            Flash::error('Transacciones not found');

            return redirect(route('transacciones.index'));
        }

        $transacciones = $this->transaccionesRepository->update($request->all(), $id);

        Flash::success('Transacciones actualizado correctamente.');

        return redirect(route('transacciones.index'));
    }

    /**
     * Remove the specified Transacciones from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transacciones = $this->transaccionesRepository->find($id);

        if (empty($transacciones)) {
            Flash::error('Transacciones not found');

            return redirect(route('transacciones.index'));
        }

        $this->transaccionesRepository->delete($id);

        Flash::success('Transacciones eliminado.');

        return redirect(route('transacciones.index'));
    }
}
