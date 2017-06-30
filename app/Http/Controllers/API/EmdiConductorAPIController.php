<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmdiConductorAPIRequest;
use App\Http\Requests\API\UpdateEmdiConductorAPIRequest;
use App\Models\EmdiConductor;
use App\Repositories\EmdiConductorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EmdiConductorController
 * @package App\Http\Controllers\API
 */

class EmdiConductorAPIController extends AppBaseController
{
    /** @var  EmdiConductorRepository */
    private $emdiConductorRepository;

    public function __construct(EmdiConductorRepository $emdiConductorRepo)
    {
        $this->emdiConductorRepository = $emdiConductorRepo;
    }

    /**
     * Muestra lista del modelo EmdiConductor.
     * GET|HEAD /emdiConductors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->emdiConductorRepository->pushCriteria(new RequestCriteria($request));
        $this->emdiConductorRepository->pushCriteria(new LimitOffsetCriteria($request));
        $emdiConductors = $this->emdiConductorRepository->all();

        return $this->sendResponse($emdiConductors->toArray(), 'Emdi Conductors retrieved successfully');
    }

    /**
     * Alamacena el  EmdiConductor registrado.
     * POST /emdiConductors
     *
     * @param CreateEmdiConductorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmdiConductorAPIRequest $request)
    {
        $input = $request->all();

        $emdiConductors = $this->emdiConductorRepository->create($input);

        return $this->sendResponse($emdiConductors->toArray(), 'Emdi Conductor saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo EmdiConductor.
     * GET|HEAD /emdiConductors/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EmdiConductor $emdiConductor */
        $emdiConductor = $this->emdiConductorRepository->findWithoutFail($id);

        if (empty($emdiConductor)) {
            return $this->sendError('Emdi Conductor not found');
        }

        return $this->sendResponse($emdiConductor->toArray(), 'Emdi Conductor retrieved successfully');
    }

    /**
     * Actualiza el EmdiConductor segun su id.
     * PUT/PATCH /emdiConductors/{id}
     *
     * @param  int $id
     * @param UpdateEmdiConductorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmdiConductorAPIRequest $request)
    {
        $input = $request->all();

        /** @var EmdiConductor $emdiConductor */
        $emdiConductor = $this->emdiConductorRepository->findWithoutFail($id);

        if (empty($emdiConductor)) {
            return $this->sendError('Emdi Conductor not found');
        }

        $emdiConductor = $this->emdiConductorRepository->update($input, $id);

        return $this->sendResponse($emdiConductor->toArray(), 'EmdiConductor updated successfully');
    }

    /**
     * Elimina el EmdiConductor especificado del almacenamiento.
     * DELETE /emdiConductors/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EmdiConductor $emdiConductor */
        $emdiConductor = $this->emdiConductorRepository->findWithoutFail($id);

        if (empty($emdiConductor)) {
            return $this->sendError('Emdi Conductor not found');
        }

        $emdiConductor->delete();

        return $this->sendResponse($id, 'Emdi Conductor deleted successfully');
    }
}
