<?php

namespace App\Http\Controllers;

use App\Http\Requests\Creategl_transRequest;
use App\Http\Requests\Updategl_transRequest;
use App\Repositories\gl_transRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class gl_transController extends AppBaseController
{
    /** @var  gl_transRepository */
    private $glTransRepository;

    public function __construct(gl_transRepository $glTransRepo)
    {
        $this->glTransRepository = $glTransRepo;
    }

    /**
     * Display a listing of the gl_trans.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $glTrans = $this->glTransRepository->all();

        return view('gl_trans.index')
            ->with('glTrans', $glTrans);
    }

    /**
     * Show the form for creating a new gl_trans.
     *
     * @return Response
     */
    public function create()
    {
        return view('gl_trans.create');
    }

    /**
     * Store a newly created gl_trans in storage.
     *
     * @param Creategl_transRequest $request
     *
     * @return Response
     */
    public function store(Creategl_transRequest $request)
    {
        $input = $request->all();

        $glTrans = $this->glTransRepository->create($input);

        Flash::success('Gl Trans saved successfully.');

        return redirect(route('glTrans.index'));
    }

    /**
     * Display the specified gl_trans.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $glTrans = $this->glTransRepository->find($id);

        if (empty($glTrans)) {
            Flash::error('Gl Trans not found');

            return redirect(route('glTrans.index'));
        }

        return view('gl_trans.show')->with('glTrans', $glTrans);
    }

    /**
     * Show the form for editing the specified gl_trans.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $glTrans = $this->glTransRepository->find($id);

        if (empty($glTrans)) {
            Flash::error('Gl Trans not found');

            return redirect(route('glTrans.index'));
        }

        return view('gl_trans.edit')->with('glTrans', $glTrans);
    }

    /**
     * Update the specified gl_trans in storage.
     *
     * @param int $id
     * @param Updategl_transRequest $request
     *
     * @return Response
     */
    public function update($id, Updategl_transRequest $request)
    {
        $glTrans = $this->glTransRepository->find($id);

        if (empty($glTrans)) {
            Flash::error('Gl Trans not found');

            return redirect(route('glTrans.index'));
        }

        $glTrans = $this->glTransRepository->update($request->all(), $id);

        Flash::success('Gl Trans updated successfully.');

        return redirect(route('glTrans.index'));
    }

    /**
     * Remove the specified gl_trans from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $glTrans = $this->glTransRepository->find($id);

        if (empty($glTrans)) {
            Flash::error('Gl Trans not found');

            return redirect(route('glTrans.index'));
        }

        $this->glTransRepository->delete($id);

        Flash::success('Gl Trans deleted successfully.');

        return redirect(route('glTrans.index'));
    }
}
