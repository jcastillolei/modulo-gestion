<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createaudit_trailRequest;
use App\Http\Requests\Updateaudit_trailRequest;
use App\Repositories\audit_trailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class audit_trailController extends AppBaseController
{
    /** @var  audit_trailRepository */
    private $auditTrailRepository;

    public function __construct(audit_trailRepository $auditTrailRepo)
    {
        $this->auditTrailRepository = $auditTrailRepo;
    }

    /**
     * Display a listing of the audit_trail.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $auditTrails = $this->auditTrailRepository->all();

        return view('audit_trails.index')
            ->with('auditTrails', $auditTrails);
    }

    /**
     * Show the form for creating a new audit_trail.
     *
     * @return Response
     */
    public function create()
    {
        return view('audit_trails.create');
    }

    /**
     * Store a newly created audit_trail in storage.
     *
     * @param Createaudit_trailRequest $request
     *
     * @return Response
     */
    public function store(Createaudit_trailRequest $request)
    {
        $input = $request->all();

        $auditTrail = $this->auditTrailRepository->create($input);

        Flash::success('Audit Trail saved successfully.');

        return redirect(route('auditTrails.index'));
    }

    /**
     * Display the specified audit_trail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $auditTrail = $this->auditTrailRepository->find($id);

        if (empty($auditTrail)) {
            Flash::error('Audit Trail not found');

            return redirect(route('auditTrails.index'));
        }

        return view('audit_trails.show')->with('auditTrail', $auditTrail);
    }

    /**
     * Show the form for editing the specified audit_trail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $auditTrail = $this->auditTrailRepository->find($id);

        if (empty($auditTrail)) {
            Flash::error('Audit Trail not found');

            return redirect(route('auditTrails.index'));
        }

        return view('audit_trails.edit')->with('auditTrail', $auditTrail);
    }

    /**
     * Update the specified audit_trail in storage.
     *
     * @param int $id
     * @param Updateaudit_trailRequest $request
     *
     * @return Response
     */
    public function update($id, Updateaudit_trailRequest $request)
    {
        $auditTrail = $this->auditTrailRepository->find($id);

        if (empty($auditTrail)) {
            Flash::error('Audit Trail not found');

            return redirect(route('auditTrails.index'));
        }

        $auditTrail = $this->auditTrailRepository->update($request->all(), $id);

        Flash::success('Audit Trail updated successfully.');

        return redirect(route('auditTrails.index'));
    }

    /**
     * Remove the specified audit_trail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $auditTrail = $this->auditTrailRepository->find($id);

        if (empty($auditTrail)) {
            Flash::error('Audit Trail not found');

            return redirect(route('auditTrails.index'));
        }

        $this->auditTrailRepository->delete($id);

        Flash::success('Audit Trail deleted successfully.');

        return redirect(route('auditTrails.index'));
    }
}
