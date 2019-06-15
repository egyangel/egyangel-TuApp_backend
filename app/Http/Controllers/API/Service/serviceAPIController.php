<?php

namespace App\Http\Controllers\API\Service;

use App\Http\Requests\API\Service\CreateserviceAPIRequest;
use App\Http\Requests\API\Service\UpdateserviceAPIRequest;
use App\Models\Service\service;
use App\Repositories\Service\serviceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class serviceController
 * @package App\Http\Controllers\API\Service
 */

class serviceAPIController extends AppBaseController
{
    /** @var  serviceRepository */
    private $serviceRepository;

    public function __construct(serviceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/services",
     *      summary="Get a listing of the services.",
     *      tags={"service"},
     *      description="Get all services",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/service")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $services = $this->serviceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($services->toArray(), 'Services retrieved successfully');
    }

    /**
     * @param CreateserviceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/services",
     *      summary="Store a newly created service in storage",
     *      tags={"service"},
     *      description="Store service",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="service that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/service")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/service"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateserviceAPIRequest $request)
    {
        $input = $request->all();

        $service = $this->serviceRepository->create($input);

        return $this->sendResponse($service->toArray(), 'Service saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/services/{id}",
     *      summary="Display the specified service",
     *      tags={"service"},
     *      description="Get service",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of service",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/service"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var service $service */
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        return $this->sendResponse($service->toArray(), 'Service retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateserviceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/services/{id}",
     *      summary="Update the specified service in storage",
     *      tags={"service"},
     *      description="Update service",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of service",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="service that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/service")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/service"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateserviceAPIRequest $request)
    {
        $input = $request->all();

        /** @var service $service */
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        $service = $this->serviceRepository->update($input, $id);

        return $this->sendResponse($service->toArray(), 'service updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/services/{id}",
     *      summary="Remove the specified service from storage",
     *      tags={"service"},
     *      description="Delete service",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of service",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var service $service */
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        $service->delete();

        return $this->sendResponse($id, 'Service deleted successfully');
    }
}
