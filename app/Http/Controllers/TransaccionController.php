<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransaccionRequest;
use App\Http\Requests\UpdateTransaccionRequest;
use App\Repositories\TransaccionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TransaccionController extends AppBaseController
{
    /** @var  TransaccionRepository */
    private $transaccionRepository;

    public function __construct(TransaccionRepository $transaccionRepo)
    {
        $this->transaccionRepository = $transaccionRepo;
    }

    /**
     * Display a listing of the Transaccion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $transaccions = $this->transaccionRepository->all();

        return view('transaccions.index')
            ->with('transaccions', $transaccions);
    }

    /**
     * Show the form for creating a new Transaccion.
     *
     * @return Response
     */
    public function create()
    {
        return view('transaccions.create');
    }

    /**
     * Store a newly created Transaccion in storage.
     *
     * @param CreateTransaccionRequest $request
     *
     * @return Response
     */
    public function store(CreateTransaccionRequest $request)
    {
        $input = $request->all();

        $transaccion = $this->transaccionRepository->create($input);

        Flash::success('Transaccion creado correctamente.');

        return redirect(route('transaccions.index'));
    }

    /**
     * Display the specified Transaccion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transaccion = $this->transaccionRepository->find($id);

        if (empty($transaccion)) {
            Flash::error('Transaccion not found');

            return redirect(route('transaccions.index'));
        }

        return view('transaccions.show')->with('transaccion', $transaccion);
    }

    /**
     * Show the form for editing the specified Transaccion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transaccion = $this->transaccionRepository->find($id);

        if (empty($transaccion)) {
            Flash::error('Transaccion not found');

            return redirect(route('transaccions.index'));
        }

        return view('transaccions.edit')->with('transaccion', $transaccion);
    }

    /**
     * Update the specified Transaccion in storage.
     *
     * @param int $id
     * @param UpdateTransaccionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransaccionRequest $request)
    {
        $transaccion = $this->transaccionRepository->find($id);

        if (empty($transaccion)) {
            Flash::error('Transaccion not found');

            return redirect(route('transaccions.index'));
        }

        $transaccion = $this->transaccionRepository->update($request->all(), $id);

        Flash::success('Transaccion actualizado correctamente.');

        return redirect(route('transaccions.index'));
    }

    /**
     * Remove the specified Transaccion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transaccion = $this->transaccionRepository->find($id);

        if (empty($transaccion)) {
            Flash::error('Transaccion not found');

            return redirect(route('transaccions.index'));
        }

        $this->transaccionRepository->delete($id);

        Flash::success('Transaccion eliminado.');

        return redirect(route('transaccions.index'));
    }
}
