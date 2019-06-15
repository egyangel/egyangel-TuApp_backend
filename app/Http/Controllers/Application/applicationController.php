<?php

namespace App\Http\Controllers\Application;

use App\DataTables\Application\applicationDataTable;
use App\Http\Requests\Application;
use App\Http\Requests\Application\CreateapplicationRequest;
use App\Http\Requests\Application\UpdateapplicationRequest;
use App\Repositories\Application\applicationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class applicationController extends AppBaseController
{
    /** @var  applicationRepository */
    private $applicationRepository;

    public function __construct(applicationRepository $applicationRepo)
    {
        $this->applicationRepository = $applicationRepo;
    }

    /**
     * Display a listing of the application.
     *
     * @param applicationDataTable $applicationDataTable
     * @return Response
     */
    public function index(applicationDataTable $applicationDataTable)
    {
        return $applicationDataTable->render('application.applications.index');
    }

    /**
     * Show the form for creating a new application.
     *
     * @return Response
     */
    public function create()
    {
        return view('application.applications.create');
    }

    /**
     * Store a newly created application in storage.
     *
     * @param CreateapplicationRequest $request
     *
     * @return Response
     */
    public function store(CreateapplicationRequest $request)
    {
        $input = $request->all();

        $application = $this->applicationRepository->create($input);

        Flash::success('Application saved successfully.');

        return redirect(route('application.applications.index'));
    }

    /**
     * Display the specified application.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            Flash::error('Application not found');

            return redirect(route('application.applications.index'));
        }

        return view('application.applications.show')->with('application', $application);
    }

    /**
     * Show the form for editing the specified application.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            Flash::error('Application not found');

            return redirect(route('application.applications.index'));
        }

        return view('application.applications.edit')->with('application', $application);
    }

    /**
     * Update the specified application in storage.
     *
     * @param  int              $id
     * @param UpdateapplicationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateapplicationRequest $request)
    {
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            Flash::error('Application not found');

            return redirect(route('application.applications.index'));
        }

        $application = $this->applicationRepository->update($request->all(), $id);

        Flash::success('Application updated successfully.');

        return redirect(route('application.applications.index'));
    }

    /**
     * Remove the specified application from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            Flash::error('Application not found');

            return redirect(route('application.applications.index'));
        }

        $this->applicationRepository->delete($id);

        Flash::success('Application deleted successfully.');

        return redirect(route('application.applications.index'));
    }
}
