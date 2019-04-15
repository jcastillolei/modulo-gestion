<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createitem_bodegaRequest;
use App\Http\Requests\Updateitem_bodegaRequest;
use App\Repositories\item_bodegaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;

use App\Models\stock_master;
use App\Models\locations;
use App\Models\item_bodega;
use App\Models\log;

class item_bodegaController extends AppBaseController
{
    /** @var  item_bodegaRepository */
    private $itemBodegaRepository;

    public function __construct(item_bodegaRepository $itemBodegaRepo)
    {
        $this->itemBodegaRepository = $itemBodegaRepo;
    }

    /**
     * Display a listing of the item_bodega.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        return view('item_bodegas.index');
    }

    /**
     * Show the form for creating a new item_bodega.
     *
     * @return Response
     */
    public function create()
    {
        $items = stock_master::pluck('description','stock_id');
        $bodegas = locations::pluck('location_name','loc_code');

        return view('item_bodegas.create', compact('items','bodegas'));
    }

    /**
     * Store a newly created item_bodega in storage.
     *
     * @param Createitem_bodegaRequest $request
     *
     * @return Response
     */
    public function store(Createitem_bodegaRequest $request)
    {
        $input = $request->all();

        $itemBodega = $this->itemBodegaRepository->create($input);

        Flash::success('Item Bodega saved successfully.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha asignado un item a una bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('itemBodegas.index'));
    }

    /**
     * Display the specified item_bodega.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $itemBodega = $this->itemBodegaRepository->find($id);

        if (empty($itemBodega)) {
            Flash::error('Item Bodega not found');

            return redirect(route('itemBodegas.index'));
        }

        return view('item_bodegas.show')->with('itemBodega', $itemBodega);
    }

    /**
     * Show the form for editing the specified item_bodega.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $itemBodega = $this->itemBodegaRepository->find($id);

        if (empty($itemBodega)) {
            Flash::error('Item Bodega not found');

            return redirect(route('itemBodegas.index'));
        }

        return view('item_bodegas.edit')->with('itemBodega', $itemBodega);
    }

    /**
     * Update the specified item_bodega in storage.
     *
     * @param int $id
     * @param Updateitem_bodegaRequest $request
     *
     * @return Response
     */
    public function update($id, Updateitem_bodegaRequest $request)
    {
        $itemBodega = $this->itemBodegaRepository->find($id);

        if (empty($itemBodega)) {
            Flash::error('Item Bodega not found');

            return redirect(route('itemBodegas.index'));
        }

        $itemBodega = $this->itemBodegaRepository->update($request->all(), $id);

        Flash::success('Item Bodega updated successfully.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha actualizado item a una bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('itemBodegas.index'));
    }

    /**
     * Remove the specified item_bodega from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $itemBodega = $this->itemBodegaRepository->find($id);

        if (empty($itemBodega)) {
            Flash::error('Item Bodega not found');

            return redirect(route('itemBodegas.index'));
        }

        $this->itemBodegaRepository->delete($id);

        Flash::success('Item Bodega deleted successfully.');

        return redirect(route('itemBodegas.index'));
    }
}


