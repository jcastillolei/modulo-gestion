<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatelogRequest;
use App\Http\Requests\UpdatelogRequest;
use App\Repositories\logRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;


class logController extends AppBaseController
{
    /** @var  logRepository */
    private $logRepository;

    public function __construct(logRepository $logRepo)
    {
        $this->logRepository = $logRepo;
    }

    /**
     * Display a listing of the log.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logs = $this->logRepository->all();

        return view('logs.index')
            ->with('logs', $logs);
    }

    /**
     * Show the form for creating a new log.
     *
     * @return Response
     */
    public function create()
    {
        return view('logs.create');
    }

    /**
     * Store a newly created log in storage.
     *
     * @param CreatelogRequest $request
     *
     * @return Response
     */
    public function store(CreatelogRequest $request)
    {
        $input = $request->all();

        $log = $this->logRepository->create($input);

        Flash::success('Log creado correctamente.');

        return redirect(route('logs.index'));
    }

    /**
     * Display the specified log.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $log = $this->logRepository->find($id);

        if (empty($log)) {
            Flash::error('Log not found');

            return redirect(route('logs.index'));
        }

        return view('logs.show')->with('log', $log);
    }

    /**
     * Show the form for editing the specified log.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $log = $this->logRepository->find($id);

        if (empty($log)) {
            Flash::error('Log not found');

            return redirect(route('logs.index'));
        }

        return view('logs.edit')->with('log', $log);
    }

    /**
     * Update the specified log in storage.
     *
     * @param int $id
     * @param UpdatelogRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatelogRequest $request)
    {
        $log = $this->logRepository->find($id);

        if (empty($log)) {
            Flash::error('Log not found');

            return redirect(route('logs.index'));
        }

        $log = $this->logRepository->update($request->all(), $id);

        Flash::success('Log actualizado correctamente.');

        return redirect(route('logs.index'));
    }

    /**
     * Remove the specified log from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $log = $this->logRepository->find($id);

        if (empty($log)) {
            Flash::error('Log not found');

            return redirect(route('logs.index'));
        }

        $this->logRepository->delete($id);

        Flash::success('Log eliminado.');

        return redirect(route('logs.index'));
    }
}
