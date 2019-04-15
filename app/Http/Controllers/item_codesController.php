<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createitem_codesRequest;
use App\Http\Requests\Updateitem_codesRequest;
use App\Repositories\item_codesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\log;

class item_codesController extends AppBaseController
{
    /** @var  item_codesRepository */
    private $itemCodesRepository;

    public function __construct(item_codesRepository $itemCodesRepo)
    {
        $this->itemCodesRepository = $itemCodesRepo;
    }

    /**
     * Display a listing of the item_codes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $itemCodes = $this->itemCodesRepository->all();

        return view('item_codes.index')
            ->with('itemCodes', $itemCodes);
    }

    /**
     * Show the form for creating a new item_codes.
     *
     * @return Response
     */
    public function create()
    {
        return view('item_codes.create');
    }

    /**
     * Store a newly created item_codes in storage.
     *
     * @param Createitem_codesRequest $request
     *
     * @return Response
     */
    public function store(Createitem_codesRequest $request)
    {
        $input = $request->all();

        $itemCodes = $this->itemCodesRepository->create($input);

        Flash::success('Item Codes saved successfully.');

        return redirect(route('itemCodes.index'));
    }

    /**
     * Display the specified item_codes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $itemCodes = $this->itemCodesRepository->find($id);

        if (empty($itemCodes)) {
            Flash::error('Item Codes not found');

            return redirect(route('itemCodes.index'));
        }

        return view('item_codes.show')->with('itemCodes', $itemCodes);
    }

    /**
     * Show the form for editing the specified item_codes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $itemCodes = $this->itemCodesRepository->find($id);

        if (empty($itemCodes)) {
            Flash::error('Item Codes not found');

            return redirect(route('itemCodes.index'));
        }

        return view('item_codes.edit')->with('itemCodes', $itemCodes);
    }

    /**
     * Update the specified item_codes in storage.
     *
     * @param int $id
     * @param Updateitem_codesRequest $request
     *
     * @return Response
     */
    public function update($id, Updateitem_codesRequest $request)
    {
        $itemCodes = $this->itemCodesRepository->find($id);

        if (empty($itemCodes)) {
            Flash::error('Item Codes not found');

            return redirect(route('itemCodes.index'));
        }

        $itemCodes = $this->itemCodesRepository->update($request->all(), $id);

        Flash::success('Item Codes updated successfully.');

        return redirect(route('itemCodes.index'));
    }

    /**
     * Remove the specified item_codes from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $itemCodes = $this->itemCodesRepository->find($id);

        if (empty($itemCodes)) {
            Flash::error('Item Codes not found');

            return redirect(route('itemCodes.index'));
        }

        $this->itemCodesRepository->delete($id);

        Flash::success('Item Codes deleted successfully.');

        return redirect(route('itemCodes.index'));
    }
}
