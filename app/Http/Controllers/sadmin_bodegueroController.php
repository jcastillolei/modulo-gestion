<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createsadmin_bodegueroRequest;
use App\Http\Requests\Updatesadmin_bodegueroRequest;
use App\Repositories\sadmin_bodegueroRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class sadmin_bodegueroController extends AppBaseController
{
    /** @var  sadmin_bodegueroRepository */
    private $sadminBodegueroRepository;

    public function __construct(sadmin_bodegueroRepository $sadminBodegueroRepo)
    {
        $this->sadminBodegueroRepository = $sadminBodegueroRepo;
    }

    /**
     * Display a listing of the sadmin_bodeguero.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sadminBodegueros = $this->sadminBodegueroRepository->all();

        return view('sadmin_bodegueros.index')
            ->with('sadminBodegueros', $sadminBodegueros);
    }

    /**
     * Show the form for creating a new sadmin_bodeguero.
     *
     * @return Response
     */
    public function create()
    {
        return view('sadmin_bodegueros.create');
    }

    /**
     * Store a newly created sadmin_bodeguero in storage.
     *
     * @param Createsadmin_bodegueroRequest $request
     *
     * @return Response
     */
    public function store(Createsadmin_bodegueroRequest $request)
    {
        $input = $request->all();

        $sadminBodeguero = $this->sadminBodegueroRepository->create($input);

        Flash::success('Sadmin Bodeguero saved successfully.');

        return redirect(route('sadminBodegueros.index'));
    }

    /**
     * Display the specified sadmin_bodeguero.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sadminBodeguero = $this->sadminBodegueroRepository->find($id);

        if (empty($sadminBodeguero)) {
            Flash::error('Sadmin Bodeguero not found');

            return redirect(route('sadminBodegueros.index'));
        }

        return view('sadmin_bodegueros.show')->with('sadminBodeguero', $sadminBodeguero);
    }

    /**
     * Show the form for editing the specified sadmin_bodeguero.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sadminBodeguero = $this->sadminBodegueroRepository->find($id);

        if (empty($sadminBodeguero)) {
            Flash::error('Sadmin Bodeguero not found');

            return redirect(route('sadminBodegueros.index'));
        }

        return view('sadmin_bodegueros.edit')->with('sadminBodeguero', $sadminBodeguero);
    }

    /**
     * Update the specified sadmin_bodeguero in storage.
     *
     * @param int $id
     * @param Updatesadmin_bodegueroRequest $request
     *
     * @return Response
     */
    public function update($id, Updatesadmin_bodegueroRequest $request)
    {
        $sadminBodeguero = $this->sadminBodegueroRepository->find($id);

        if (empty($sadminBodeguero)) {
            Flash::error('Sadmin Bodeguero not found');

            return redirect(route('sadminBodegueros.index'));
        }

        $sadminBodeguero = $this->sadminBodegueroRepository->update($request->all(), $id);

        Flash::success('Sadmin Bodeguero updated successfully.');

        return redirect(route('sadminBodegueros.index'));
    }

    /**
     * Remove the specified sadmin_bodeguero from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sadminBodeguero = $this->sadminBodegueroRepository->find($id);

        if (empty($sadminBodeguero)) {
            Flash::error('Sadmin Bodeguero not found');

            return redirect(route('sadminBodegueros.index'));
        }

        $this->sadminBodegueroRepository->delete($id);

        Flash::success('Sadmin Bodeguero deleted successfully.');

        return redirect(route('sadminBodegueros.index'));
    }
}
