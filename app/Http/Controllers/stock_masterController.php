<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createstock_masterRequest;
use App\Http\Requests\Updatestock_masterRequest;
use App\Repositories\stock_masterRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\locationsRepository;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use App\Models\stock_master;
use App\Models\loc_stock;
use App\Models\Locations;
use App\Models\item_codes;
use App\Models\log;

use App\Models\chart_master;
use Illuminate\Support\Collection;
use App\Http\Requests\Createchart_masterRequest;
use App\Http\Requests\Updatechart_masterRequest;
use App\Repositories\chart_masterRepository;

class stock_masterController extends AppBaseController
{
    /** @var  stock_masterRepository */
    private $stockMasterRepository;

    public function __construct(stock_masterRepository $stockMasterRepo)
    {
        $this->stockMasterRepository = $stockMasterRepo;
    }

    /**
     * Display a listing of the stock_master.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $stockMasters = stock_master::paginate(15);

        return view('stock_masters.index')
            ->with('stockMasters', $stockMasters);
    }

    /**
     * Show the form for creating a new stock_master.
     *
     * @return Response
     */
    public function create()
    {
        $chartMaster = new Collection([]);

        $chartMaster->put('0','Seleccione');
        $chartMaster = chart_master::pluck('account_name','account_code');

        return view('stock_masters.create')
            ->with('chartMaster', $chartMaster);
    }

    /**
     * Store a newly created stock_master in storage.
     *
     * @param Createstock_masterRequest $request
     *
     * @return Response
     */
    public function store(Createstock_masterRequest $request)
    {
        $input = $request->all();

        $stockMaster = new stock_master;

        $stockMaster->stock_id = $request->stock_id;
        $stockMaster->category_id = 1;
        $stockMaster->tax_type_id = 1;
        $stockMaster->description = $request->description;
        $stockMaster->long_description  = '';
        $stockMaster->units = 'each';
        $stockMaster->mb_flag = 'B';
        $stockMaster->sales_account = 4010;
        $stockMaster->cogs_account = 5010;
        $stockMaster->inventory_account = $request->inventory_account;
        $stockMaster->adjustment_account = $request->adjustment_account;
        $stockMaster->wip_account = 1530;
        $stockMaster->dimension_id = 0;
        $stockMaster->dimension2_id = 0;
        $stockMaster->purchase_cost = 0;
        $stockMaster->material_cost = $request->material_cost;
        $stockMaster->labour_cost = 0;
        $stockMaster->overhead_cost = 0;
        $stockMaster->inactive = 0;
        $stockMaster->no_sale = 0;
        $stockMaster->no_purchase = 0;
        $stockMaster->editable = 0;
        $stockMaster->depreciation_method = '';
        $stockMaster->depreciation_rate = 0;
        $stockMaster->depreciation_factor = 0;
        $stockMaster->depreciation_start = date('Y-m-d');
        $stockMaster->depreciation_date = date('Y-m-d');
        $stockMaster->fa_class_id = '';

        $stockMaster->save();   

        $locations = locations::all();

        foreach ($locations as $loc) {

            $lockStock = new loc_stock;
            
            $lockStock->loc_code = $loc->loc_code;
            $lockStock->stock_id = $request->stock_id;
            $lockStock->save();
        }

        $itemCode = new item_codes;

        $itemCode->item_code = $request->stock_id;
        $itemCode->stock_id = $request->stock_id;
        $itemCode->description = $request->description;
        $itemCode->category_id = 1;
        $itemCode->quantity = 1;
        $itemCode->is_foreign = 0;

        $itemCode->save();

        DB::table('0_stock_master')
            ->where('stock_id', $request->stock_id)
            ->update([
                'material_cost' => $request->material_cost,
                'labour_cost' => 0,
                'overhead_cost' => 0

        ]);

        Flash::success('Item guardado correctamente');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha creado un nuevo item.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('stockMasters.index'));
    }

    /**
     * Display the specified stock_master.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockMaster = $this->stockMasterRepository->find($id);

        if (empty($stockMaster)) {
            Flash::error('Stock Master not found');

            return redirect(route('stockMasters.index'));
        }

        return view('stock_masters.show')->with('stockMaster', $stockMaster);
    }

    /**
     * Show the form for editing the specified stock_master.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockMaster = $this->stockMasterRepository->find($id);

        $chartMaster = new Collection([]);

        $chartMaster->put('0','Seleccione');
        $chartMaster = chart_master::pluck('account_name','account_code');

        if (empty($stockMaster)) {
            Flash::error('Stock Master not found');

            return redirect(route('stockMasters.index'));
        }

        return view('stock_masters.edit', compact('chartMaster'))->with('stockMaster', $stockMaster);
    }

    /**
     * Update the specified stock_master in storage.
     *
     * @param int $id
     * @param Updatestock_masterRequest $request
     *
     * @return Response
     */
    public function update($id, Updatestock_masterRequest $request)
    {
        $stockMaster = $this->stockMasterRepository->find($id);

        if (empty($stockMaster)) {
            Flash::error('Stock Master not found');

            return redirect(route('stockMasters.index'));
        }

        $stockMaster = $this->stockMasterRepository->update($request->all(), $id);

        Flash::success('Stock Master updated successfully.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha actulizado un nuevo item.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('stockMasters.index'));
    }

    /**
     * Remove the specified stock_master from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockMaster = $this->stockMasterRepository->find($id);

        if (empty($stockMaster)) {
            Flash::error('Stock Master not found');

            return redirect(route('stockMasters.index'));
        }

        $this->stockMasterRepository->delete($id);

        Flash::success('Stock Master eliminado.');

        return redirect(route('stockMasters.index'));
    }
}
