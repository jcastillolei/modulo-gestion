<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createstock_movesRequest;
use App\Http\Requests\Updatestock_movesRequest;
use App\Repositories\stock_movesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\log;

class stock_movesController extends AppBaseController
{
    /** @var  stock_movesRepository */
    private $stockMovesRepository;

    public function __construct(stock_movesRepository $stockMovesRepo)
    {
        $this->stockMovesRepository = $stockMovesRepo;
    }

    /**
     * Display a listing of the stock_moves.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $stockMoves = $this->stockMovesRepository->all();

        return view('stock_moves.index')
            ->with('stockMoves', $stockMoves);
    }

    /**
     * Show the form for creating a new stock_moves.
     *
     * @return Response
     */
    public function create()
    {
        return view('stock_moves.create');
    }

    /**
     * Store a newly created stock_moves in storage.
     *
     * @param Createstock_movesRequest $request
     *
     * @return Response
     */
    public function store(Createstock_movesRequest $request)
    {
        $input = $request->all();

        $stockMoves = $this->stockMovesRepository->create($input);

        Flash::success('Stock Moves saved successfully.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha creado una nueva transacion.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('stockMoves.index'));
    }

    /**
     * Display the specified stock_moves.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockMoves = $this->stockMovesRepository->find($id);

        if (empty($stockMoves)) {
            Flash::error('Stock Moves not found');

            return redirect(route('stockMoves.index'));
        }

        return view('stock_moves.show')->with('stockMoves', $stockMoves);
    }

    /**
     * Show the form for editing the specified stock_moves.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockMoves = $this->stockMovesRepository->find($id);

        if (empty($stockMoves)) {
            Flash::error('Stock Moves not found');

            return redirect(route('stockMoves.index'));
        }

        return view('stock_moves.edit')->with('stockMoves', $stockMoves);
    }

    /**
     * Update the specified stock_moves in storage.
     *
     * @param int $id
     * @param Updatestock_movesRequest $request
     *
     * @return Response
     */
    public function update($id, Updatestock_movesRequest $request)
    {
        $stockMoves = $this->stockMovesRepository->find($id);

        if (empty($stockMoves)) {
            Flash::error('Stock Moves not found');

            return redirect(route('stockMoves.index'));
        }

        $stockMoves = $this->stockMovesRepository->update($request->all(), $id);

        Flash::success('Stock Moves updated successfully.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha actualizado un usuario bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('stockMoves.index'));
    }

    /**
     * Remove the specified stock_moves from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockMoves = $this->stockMovesRepository->find($id);

        if (empty($stockMoves)) {
            Flash::error('Stock Moves not found');

            return redirect(route('stockMoves.index'));
        }

        $this->stockMovesRepository->delete($id);

        Flash::success('Stock Moves deleted successfully.');

        return redirect(route('stockMoves.index'));
    }
}
