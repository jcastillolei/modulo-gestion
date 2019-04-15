<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createsales_posRequest;
use App\Http\Requests\Updatesales_posRequest;
use App\Repositories\sales_posRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class sales_posController extends AppBaseController
{
    /** @var  sales_posRepository */
    private $salesPosRepository;

    public function __construct(sales_posRepository $salesPosRepo)
    {
        $this->salesPosRepository = $salesPosRepo;
    }

    /**
     * Display a listing of the sales_pos.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $salesPos = $this->salesPosRepository->all();

        return view('sales_pos.index')
            ->with('salesPos', $salesPos);
    }

    /**
     * Show the form for creating a new sales_pos.
     *
     * @return Response
     */
    public function create()
    {
        return view('sales_pos.create');
    }

    /**
     * Store a newly created sales_pos in storage.
     *
     * @param Createsales_posRequest $request
     *
     * @return Response
     */
    public function store(Createsales_posRequest $request)
    {
        $input = $request->all();

        $salesPos = $this->salesPosRepository->create($input);

        Flash::success('Sales Pos saved successfully.');

        return redirect(route('salesPos.index'));
    }

    /**
     * Display the specified sales_pos.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $salesPos = $this->salesPosRepository->find($id);

        if (empty($salesPos)) {
            Flash::error('Sales Pos not found');

            return redirect(route('salesPos.index'));
        }

        return view('sales_pos.show')->with('salesPos', $salesPos);
    }

    /**
     * Show the form for editing the specified sales_pos.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $salesPos = $this->salesPosRepository->find($id);

        if (empty($salesPos)) {
            Flash::error('Sales Pos not found');

            return redirect(route('salesPos.index'));
        }

        return view('sales_pos.edit')->with('salesPos', $salesPos);
    }

    /**
     * Update the specified sales_pos in storage.
     *
     * @param int $id
     * @param Updatesales_posRequest $request
     *
     * @return Response
     */
    public function update($id, Updatesales_posRequest $request)
    {
        $salesPos = $this->salesPosRepository->find($id);

        if (empty($salesPos)) {
            Flash::error('Sales Pos not found');

            return redirect(route('salesPos.index'));
        }

        $salesPos = $this->salesPosRepository->update($request->all(), $id);

        Flash::success('Sales Pos updated successfully.');

        return redirect(route('salesPos.index'));
    }

    /**
     * Remove the specified sales_pos from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $salesPos = $this->salesPosRepository->find($id);

        if (empty($salesPos)) {
            Flash::error('Sales Pos not found');

            return redirect(route('salesPos.index'));
        }

        $this->salesPosRepository->delete($id);

        Flash::success('Sales Pos deleted successfully.');

        return redirect(route('salesPos.index'));
    }
}
