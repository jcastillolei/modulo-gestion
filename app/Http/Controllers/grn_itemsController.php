<?php

namespace App\Http\Controllers;

use App\Http\Requests\Creategrn_itemsRequest;
use App\Http\Requests\Updategrn_itemsRequest;
use App\Repositories\grn_itemsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class grn_itemsController extends AppBaseController
{
    /** @var  grn_itemsRepository */
    private $grnItemsRepository;

    public function __construct(grn_itemsRepository $grnItemsRepo)
    {
        $this->grnItemsRepository = $grnItemsRepo;
    }

    /**
     * Display a listing of the grn_items.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $grnItems = $this->grnItemsRepository->all();

        return view('grn_items.index')
            ->with('grnItems', $grnItems);
    }

    /**
     * Show the form for creating a new grn_items.
     *
     * @return Response
     */
    public function create()
    {
        return view('grn_items.create');
    }

    /**
     * Store a newly created grn_items in storage.
     *
     * @param Creategrn_itemsRequest $request
     *
     * @return Response
     */
    public function store(Creategrn_itemsRequest $request)
    {
        $input = $request->all();

        $grnItems = $this->grnItemsRepository->create($input);

        Flash::success('Grn Items saved successfully.');

        return redirect(route('grnItems.index'));
    }

    /**
     * Display the specified grn_items.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $grnItems = $this->grnItemsRepository->find($id);

        if (empty($grnItems)) {
            Flash::error('Grn Items not found');

            return redirect(route('grnItems.index'));
        }

        return view('grn_items.show')->with('grnItems', $grnItems);
    }

    /**
     * Show the form for editing the specified grn_items.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $grnItems = $this->grnItemsRepository->find($id);

        if (empty($grnItems)) {
            Flash::error('Grn Items not found');

            return redirect(route('grnItems.index'));
        }

        return view('grn_items.edit')->with('grnItems', $grnItems);
    }

    /**
     * Update the specified grn_items in storage.
     *
     * @param int $id
     * @param Updategrn_itemsRequest $request
     *
     * @return Response
     */
    public function update($id, Updategrn_itemsRequest $request)
    {
        $grnItems = $this->grnItemsRepository->find($id);

        if (empty($grnItems)) {
            Flash::error('Grn Items not found');

            return redirect(route('grnItems.index'));
        }

        $grnItems = $this->grnItemsRepository->update($request->all(), $id);

        Flash::success('Grn Items updated successfully.');

        return redirect(route('grnItems.index'));
    }

    /**
     * Remove the specified grn_items from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $grnItems = $this->grnItemsRepository->find($id);

        if (empty($grnItems)) {
            Flash::error('Grn Items not found');

            return redirect(route('grnItems.index'));
        }

        $this->grnItemsRepository->delete($id);

        Flash::success('Grn Items deleted successfully.');

        return redirect(route('grnItems.index'));
    }
}
