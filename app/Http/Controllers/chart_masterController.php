<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createchart_masterRequest;
use App\Http\Requests\Updatechart_masterRequest;
use App\Repositories\chart_masterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class chart_masterController extends AppBaseController
{
    /** @var  chart_masterRepository */
    private $chartMasterRepository;

    public function __construct(chart_masterRepository $chartMasterRepo)
    {
        $this->chartMasterRepository = $chartMasterRepo;
    }

    /**
     * Display a listing of the chart_master.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $chartMasters = $this->chartMasterRepository->all();

        return view('chart_masters.index')
            ->with('chartMasters', $chartMasters);
    }

    /**
     * Show the form for creating a new chart_master.
     *
     * @return Response
     */
    public function create()
    {
        return view('chart_masters.create');
    }

    /**
     * Store a newly created chart_master in storage.
     *
     * @param Createchart_masterRequest $request
     *
     * @return Response
     */
    public function store(Createchart_masterRequest $request)
    {
        $input = $request->all();

        $chartMaster = $this->chartMasterRepository->create($input);

        Flash::success('Chart Master saved successfully.');

        return redirect(route('chartMasters.index'));
    }

    /**
     * Display the specified chart_master.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $chartMaster = $this->chartMasterRepository->find($id);

        if (empty($chartMaster)) {
            Flash::error('Chart Master not found');

            return redirect(route('chartMasters.index'));
        }

        return view('chart_masters.show')->with('chartMaster', $chartMaster);
    }

    /**
     * Show the form for editing the specified chart_master.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $chartMaster = $this->chartMasterRepository->find($id);

        if (empty($chartMaster)) {
            Flash::error('Chart Master not found');

            return redirect(route('chartMasters.index'));
        }

        return view('chart_masters.edit')->with('chartMaster', $chartMaster);
    }

    /**
     * Update the specified chart_master in storage.
     *
     * @param int $id
     * @param Updatechart_masterRequest $request
     *
     * @return Response
     */
    public function update($id, Updatechart_masterRequest $request)
    {
        $chartMaster = $this->chartMasterRepository->find($id);

        if (empty($chartMaster)) {
            Flash::error('Chart Master not found');

            return redirect(route('chartMasters.index'));
        }

        $chartMaster = $this->chartMasterRepository->update($request->all(), $id);

        Flash::success('Chart Master updated successfully.');

        return redirect(route('chartMasters.index'));
    }

    /**
     * Remove the specified chart_master from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $chartMaster = $this->chartMasterRepository->find($id);

        if (empty($chartMaster)) {
            Flash::error('Chart Master not found');

            return redirect(route('chartMasters.index'));
        }

        $this->chartMasterRepository->delete($id);

        Flash::success('Chart Master deleted successfully.');

        return redirect(route('chartMasters.index'));
    }
}
