<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createloc_stockRequest;
use App\Http\Requests\Updateloc_stockRequest;
use App\Repositories\loc_stockRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\log;

class loc_stockController extends AppBaseController
{
    /** @var  loc_stockRepository */
    private $locStockRepository;

    public function __construct(loc_stockRepository $locStockRepo)
    {
        $this->locStockRepository = $locStockRepo;
    }

    /**
     * Display a listing of the loc_stock.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $locStocks = $this->locStockRepository->all();

        return view('loc_stocks.index')
            ->with('locStocks', $locStocks);
    }

    /**
     * Show the form for creating a new loc_stock.
     *
     * @return Response
     */
    public function create()
    {
        return view('loc_stocks.create');
    }

    /**
     * Store a newly created loc_stock in storage.
     *
     * @param Createloc_stockRequest $request
     *
     * @return Response
     */
    public function store(Createloc_stockRequest $request)
    {
        $input = $request->all();

        $locStock = $this->locStockRepository->create($input);

        Flash::success('Loc Stock creado correctamente..');



        return redirect(route('locStocks.index'));
    }

    /**
     * Display the specified loc_stock.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $locStock = $this->locStockRepository->find($id);

        if (empty($locStock)) {
            Flash::error('Loc Stock not found');

            return redirect(route('locStocks.index'));
        }

        return view('loc_stocks.show')->with('locStock', $locStock);
    }

    /**
     * Show the form for editing the specified loc_stock.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $locStock = $this->locStockRepository->find($id);

        if (empty($locStock)) {
            Flash::error('Loc Stock not found');

            return redirect(route('locStocks.index'));
        }

        return view('loc_stocks.edit')->with('locStock', $locStock);
    }

    /**
     * Update the specified loc_stock in storage.
     *
     * @param int $id
     * @param Updateloc_stockRequest $request
     *
     * @return Response
     */
    public function update($id, Updateloc_stockRequest $request)
    {
        $locStock = $this->locStockRepository->find($id);

        if (empty($locStock)) {
            Flash::error('Loc Stock not found');

            return redirect(route('locStocks.index'));
        }

        $locStock = $this->locStockRepository->update($request->all(), $id);

        Flash::success('Loc Stock actualizado correctamente.');

        return redirect(route('locStocks.index'));
    }

    /**
     * Remove the specified loc_stock from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $locStock = $this->locStockRepository->find($id);

        if (empty($locStock)) {
            Flash::error('Loc Stock not found');

            return redirect(route('locStocks.index'));
        }

        $this->locStockRepository->delete($id);

        Flash::success('Loc Stock eliminado.');

        return redirect(route('locStocks.index'));
    }
}
