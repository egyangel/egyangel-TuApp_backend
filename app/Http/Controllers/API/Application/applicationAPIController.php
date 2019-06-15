<?php

namespace App\Http\Controllers\API\Application;

use App\Http\Requests\API\Application\CreateapplicationAPIRequest;
use App\Http\Requests\API\Application\UpdateapplicationAPIRequest;
use App\Models\Application\application;
use App\Repositories\Application\applicationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class applicationController
 * @package App\Http\Controllers\API\Application
 */

class applicationAPIController extends AppBaseController
{
    /** @var  applicationRepository */
    private $applicationRepository;

    public function __construct(applicationRepository $applicationRepo)
    {
        $this->applicationRepository = $applicationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/applications",
     *      summary="Get a listing of the applications.",
     *      tags={"application"},
     *      description="Get all applications",
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
     *                  @SWG\Items(ref="#/definitions/application")
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
        $applications = $this->applicationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($applications->toArray(), 'Applications retrieved successfully');
    }

    /**
     * @param CreateapplicationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/applications",
     *      summary="Store a newly created application in storage",
     *      tags={"application"},
     *      description="Store application",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="application that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/application")
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
     *                  ref="#/definitions/application"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateapplicationAPIRequest $request)
    {
        
        $input = $request->all();
        
        $application = $this->applicationRepository->create($input);

        return $this->sendResponse($application->toArray(), 'Application saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/applications/{id}",
     *      summary="Display the specified application",
     *      tags={"application"},
     *      description="Get application",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of application",
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
     *                  ref="#/definitions/application"
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
        /** @var application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        return $this->sendResponse($application->toArray(), 'Application retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateapplicationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/applications/{id}",
     *      summary="Update the specified application in storage",
     *      tags={"application"},
     *      description="Update application",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of application",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="application that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/application")
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
     *                  ref="#/definitions/application"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateapplicationAPIRequest $request)
    {
        $input = $request->all();

        /** @var application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        $application = $this->applicationRepository->update($input, $id);

        return $this->sendResponse($application->toArray(), 'application updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/applications/{id}",
     *      summary="Remove the specified application from storage",
     *      tags={"application"},
     *      description="Delete application",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of application",
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
        /** @var application $application */
        $application = $this->applicationRepository->find($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        $application->delete();

        return $this->sendResponse($id, 'Application deleted successfully');
    }
}
