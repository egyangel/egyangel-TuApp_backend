<?php

namespace App\Http\Controllers\Service;

use App\DataTables\Service\serviceDataTable;
use App\Http\Requests\Service;
use App\Http\Requests\Service\CreateserviceRequest;
use App\Http\Requests\Service\UpdateserviceRequest;
use App\Repositories\Service\serviceRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class serviceController extends AppBaseController
{
    /** @var  serviceRepository */
    private $serviceRepository;

    public function __construct(serviceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
    }

    /**
     * Display a listing of the service.
     *
     * @param serviceDataTable $serviceDataTable
     * @return Response
     */
    public function index(serviceDataTable $serviceDataTable)
    {
        return $serviceDataTable->render('service.services.index');
    }

    /**
     * Show the form for creating a new service.
     *
     * @return Response
     */
    public function create()
    {
        return view('service.services.create');
    }

    /**
     * Store a newly created service in storage.
     *
     * @param CreateserviceRequest $request
     *
     * @return Response
     */
    public function store(CreateserviceRequest $request)
    {
        $input = $request->all();

        $service = $this->serviceRepository->create($input);

        Flash::success('Service saved successfully.');

        return redirect(route('service.services.index'));
    }

    /**
     * Display the specified service.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('service.services.index'));
        }

        return view('service.services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified service.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('service.services.index'));
        }

        return view('service.services.edit')->with('service', $service);
    }

    /**
     * Update the specified service in storage.
     *
     * @param  int              $id
     * @param UpdateserviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateserviceRequest $request)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('service.services.index'));
        }

        $service = $this->serviceRepository->update($request->all(), $id);

        Flash::success('Service updated successfully.');

        return redirect(route('service.services.index'));
    }

    /**
     * Remove the specified service from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('service.services.index'));
        }

        $this->serviceRepository->delete($id);

        Flash::success('Service deleted successfully.');

        return redirect(route('service.services.index'));
    }
}
