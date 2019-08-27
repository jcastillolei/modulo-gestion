<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createtransacciones_usuariofinalRequest;
use App\Http\Requests\Updatetransacciones_usuariofinalRequest;
use App\Repositories\transacciones_usuariofinalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class transacciones_usuariofinalController extends AppBaseController
{
    /** @var  transacciones_usuariofinalRepository */
    private $transaccionesUsuariofinalRepository;

    public function __construct(transacciones_usuariofinalRepository $transaccionesUsuariofinalRepo)
    {
        $this->transaccionesUsuariofinalRepository = $transaccionesUsuariofinalRepo;
    }

    /**
     * Display a listing of the transacciones_usuariofinal.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $transaccionesUsuariofinals = $this->transaccionesUsuariofinalRepository->all();

        return view('transacciones_usuariofinals.index')
            ->with('transaccionesUsuariofinals', $transaccionesUsuariofinals);
    }

    /**
     * Show the form for creating a new transacciones_usuariofinal.
     *
     * @return Response
     */
    public function create()
    {
        return view('transacciones_usuariofinals.create');
    }

    /**
     * Store a newly created transacciones_usuariofinal in storage.
     *
     * @param Createtransacciones_usuariofinalRequest $request
     *
     * @return Response
     */
    public function store(Createtransacciones_usuariofinalRequest $request)
    {
        $input = $request->all();

        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->create($input);

        Flash::success('Transacciones Usuariofinal saved successfully.');

        return redirect(route('transaccionesUsuariofinals.index'));
    }

    /**
     * Display the specified transacciones_usuariofinal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->find($id);

        if (empty($transaccionesUsuariofinal)) {
            Flash::error('Transacciones Usuariofinal not found');

            return redirect(route('transaccionesUsuariofinals.index'));
        }

        return view('transacciones_usuariofinals.show')->with('transaccionesUsuariofinal', $transaccionesUsuariofinal);
    }

    /**
     * Show the form for editing the specified transacciones_usuariofinal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->find($id);

        if (empty($transaccionesUsuariofinal)) {
            Flash::error('Transacciones Usuariofinal not found');

            return redirect(route('transaccionesUsuariofinals.index'));
        }

        return view('transacciones_usuariofinals.edit')->with('transaccionesUsuariofinal', $transaccionesUsuariofinal);
    }

    /**
     * Update the specified transacciones_usuariofinal in storage.
     *
     * @param int $id
     * @param Updatetransacciones_usuariofinalRequest $request
     *
     * @return Response
     */
    public function update($id, Updatetransacciones_usuariofinalRequest $request)
    {
        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->find($id);

        if (empty($transaccionesUsuariofinal)) {
            Flash::error('Transacciones Usuariofinal not found');

            return redirect(route('transaccionesUsuariofinals.index'));
        }

        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->update($request->all(), $id);

        Flash::success('Transacciones Usuariofinal updated successfully.');

        return redirect(route('transaccionesUsuariofinals.index'));
    }

    /**
     * Remove the specified transacciones_usuariofinal from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->find($id);

        if (empty($transaccionesUsuariofinal)) {
            Flash::error('Transacciones Usuariofinal not found');

            return redirect(route('transaccionesUsuariofinals.index'));
        }

        $this->transaccionesUsuariofinalRepository->delete($id);

        Flash::success('Transacciones Usuariofinal deleted successfully.');

        return redirect(route('transaccionesUsuariofinals.index'));
    }
}
