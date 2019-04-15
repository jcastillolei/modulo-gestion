<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreaterefsRequest;
use App\Http\Requests\UpdaterefsRequest;
use App\Repositories\refsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class refsController extends AppBaseController
{
    /** @var  refsRepository */
    private $refsRepository;

    public function __construct(refsRepository $refsRepo)
    {
        $this->refsRepository = $refsRepo;
    }

    /**
     * Display a listing of the refs.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $refs = $this->refsRepository->all();

        return view('refs.index')
            ->with('refs', $refs);
    }

    /**
     * Show the form for creating a new refs.
     *
     * @return Response
     */
    public function create()
    {
        return view('refs.create');
    }

    /**
     * Store a newly created refs in storage.
     *
     * @param CreaterefsRequest $request
     *
     * @return Response
     */
    public function store(CreaterefsRequest $request)
    {
        $input = $request->all();

        $refs = $this->refsRepository->create($input);

        Flash::success('Refs saved successfully.');

        return redirect(route('refs.index'));
    }

    /**
     * Display the specified refs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $refs = $this->refsRepository->find($id);

        if (empty($refs)) {
            Flash::error('Refs not found');

            return redirect(route('refs.index'));
        }

        return view('refs.show')->with('refs', $refs);
    }

    /**
     * Show the form for editing the specified refs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $refs = $this->refsRepository->find($id);

        if (empty($refs)) {
            Flash::error('Refs not found');

            return redirect(route('refs.index'));
        }

        return view('refs.edit')->with('refs', $refs);
    }

    /**
     * Update the specified refs in storage.
     *
     * @param int $id
     * @param UpdaterefsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterefsRequest $request)
    {
        $refs = $this->refsRepository->find($id);

        if (empty($refs)) {
            Flash::error('Refs not found');

            return redirect(route('refs.index'));
        }

        $refs = $this->refsRepository->update($request->all(), $id);

        Flash::success('Refs updated successfully.');

        return redirect(route('refs.index'));
    }

    /**
     * Remove the specified refs from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $refs = $this->refsRepository->find($id);

        if (empty($refs)) {
            Flash::error('Refs not found');

            return redirect(route('refs.index'));
        }

        $this->refsRepository->delete($id);

        Flash::success('Refs deleted successfully.');

        return redirect(route('refs.index'));
    }
}
