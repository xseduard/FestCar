<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNaturalAPIRequest;
use App\Http\Requests\API\UpdateNaturalAPIRequest;
use App\Models\Natural;
use App\Repositories\NaturalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class NaturalController
 * @package App\Http\Controllers\API
 */

class NaturalAPIController extends AppBaseController
{
    /** @var  NaturalRepository */
    private $naturalRepository;

    public function __construct(NaturalRepository $naturalRepo)
    {
        $this->naturalRepository = $naturalRepo;
    }

    /**
     * Muestra lista del modelo Natural.
     * GET|HEAD /naturals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->naturalRepository->pushCriteria(new RequestCriteria($request));
        $this->naturalRepository->pushCriteria(new LimitOffsetCriteria($request));
        $naturals = $this->naturalRepository->all();

        return $this->sendResponse($naturals->toArray(), 'Naturals retrieved successfully');
    }

    /**
     * Alamacena el  Natural registrado.
     * POST /naturals
     *
     * @param CreateNaturalAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateNaturalAPIRequest $request)
    {
        $input = $request->all();

        $naturals = $this->naturalRepository->create($input);

        return $this->sendResponse($naturals->toArray(), 'Natural saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Natural.
     * GET|HEAD /naturals/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Natural $natural */
        $natural = $this->naturalRepository->findWithoutFail($id);

        if (empty($natural)) {
            return $this->sendError('Natural not found');
        }

        return $this->sendResponse($natural->toArray(), 'Natural retrieved successfully');
    }

    /**
     * Actualiza el Natural segun su id.
     * PUT/PATCH /naturals/{id}
     *
     * @param  int $id
     * @param UpdateNaturalAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNaturalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Natural $natural */
        $natural = $this->naturalRepository->findWithoutFail($id);

        if (empty($natural)) {
            return $this->sendError('Natural not found');
        }

        $natural = $this->naturalRepository->update($input, $id);

        return $this->sendResponse($natural->toArray(), 'Natural updated successfully');
    }

    /**
     * Elimina el Natural especificado del almacenamiento.
     * DELETE /naturals/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Natural $natural */
        $natural = $this->naturalRepository->findWithoutFail($id);

        if (empty($natural)) {
            return $this->sendError('Natural not found');
        }

        $natural->delete();

        return $this->sendResponse($id, 'Natural deleted successfully');
    }
}
