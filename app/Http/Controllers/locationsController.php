<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatelocationsRequest;
use App\Http\Requests\UpdatelocationsRequest;
use App\Repositories\locationsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\loc_stock;
use App\Models\Locations;
use App\Models\item_codes;
use App\Models\stock_master;
use App\Models\log;

class locationsController extends AppBaseController
{
    /** @var  locationsRepository */
    private $locationsRepository;

    public function __construct(locationsRepository $locationsRepo)
    {
        $this->locationsRepository = $locationsRepo;
    }

    /**
     * Display a listing of the locations.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $locations = locations::paginate(15);

        return view('locations.index')
            ->with('locations', $locations);
    }

    /**
     * Show the form for creating a new locations.
     *
     * @return Response
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created locations in storage.
     *
     * @param CreatelocationsRequest $request
     *
     * @return Response
     */
    public function store(CreatelocationsRequest $request)
    {
        $input = $request->all();

        $locations = new locations;

        $locations->loc_code = $request->loc_code;
        $locations->location_name = $request->location_name;
        $locations->delivery_address = $request->delivery_address;
        $locations->phone = $request->phone;
        $locations->phone2  = $request->phone;
        $locations->fax = $request->phone;
        $locations->email = $request->email;
        $locations->contact = $request->contact;
        $locations->fixed_asset = '0';
        $locations->inactive = '0';        

        $locations->save();   

        $stockMaster = stock_master::all();

        foreach ($stockMaster as $sto) {

            $stockM = new loc_stock;
            
            $stockM->loc_code = $request->loc_code;
            $stockM->stock_id = $sto->stock_id;
            $stockM->reorder_level = 0;
            $stockM->save();
        }

        //$locations = $this->locationsRepository->create($input);

        Flash::success('Bodega creada correctamente.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha ingresado una nueva bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('locations.index'));
    }

    /**
     * Display the specified locations.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $locations = $this->locationsRepository->find($id);

        if (empty($locations)) {
            Flash::error('Locations not found');

            return redirect(route('locations.index'));
        }

        return view('locations.show')->with('locations', $locations);
    }

    /**
     * Show the form for editing the specified locations.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        
        $locations = $this->locationsRepository->find($id);

        if (empty($locations)) {
            Flash::error('Locations not found');

            return redirect(route('locations.index'));
        }

        return view('locations.edit')->with('locations', $locations);
    }

    /**
     * Update the specified locations in storage.
     *
     * @param int $id
     * @param UpdatelocationsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatelocationsRequest $request)
    {
        $locations = $this->locationsRepository->find($id);

        if (empty($locations)) {
            Flash::error('Locations not found');

            return redirect(route('locations.index'));
        }

        $locations = $this->locationsRepository->update($request->all(), $id);

        Flash::success('Bodega actualizado correctamente.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha actualizado una  bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('locations.index'));
    }

    /**
     * Remove the specified locations from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $locations = $this->locationsRepository->find($id);

        if (empty($locations)) {
            Flash::error('Locations not found');

            return redirect(route('locations.index'));
        }

        $this->locationsRepository->delete($id);

        Flash::success('Locations eliminado.');

        return redirect(route('locations.index'));
    }
}
