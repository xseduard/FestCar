<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSoatAPIRequest;
use App\Http\Requests\API\UpdateSoatAPIRequest;
use App\Models\Soat;
use App\Repositories\SoatRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SoatController
 * @package App\Http\Controllers\API
 */

class SoatAPIController extends AppBaseController
{
    /** @var  SoatRepository */
    private $soatRepository;

    public function __construct(SoatRepository $soatRepo)
    {
        $this->soatRepository = $soatRepo;
    }

    /**
     * Muestra lista del modelo Soat.
     * GET|HEAD /soats
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->soatRepository->pushCriteria(new RequestCriteria($request));
        $this->soatRepository->pushCriteria(new LimitOffsetCriteria($request));
        $soats = $this->soatRepository->all();

        return $this->sendResponse($soats->toArray(), 'Soats retrieved successfully');
    }

    /**
     * Alamacena el  Soat registrado.
     * POST /soats
     *
     * @param CreateSoatAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSoatAPIRequest $request)
    {
        $input = $request->all();

        $soats = $this->soatRepository->create($input);

        return $this->sendResponse($soats->toArray(), 'Soat saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Soat.
     * GET|HEAD /soats/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Soat $soat */
        $soat = $this->soatRepository->findWithoutFail($id);

        if (empty($soat)) {
            return $this->sendError('Soat not found');
        }

        return $this->sendResponse($soat->toArray(), 'Soat retrieved successfully');
    }

    /**
     * Actualiza el Soat segun su id.
     * PUT/PATCH /soats/{id}
     *
     * @param  int $id
     * @param UpdateSoatAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSoatAPIRequest $request)
    {
        $input = $request->all();

        /** @var Soat $soat */
        $soat = $this->soatRepository->findWithoutFail($id);

        if (empty($soat)) {
            return $this->sendError('Soat not found');
        }

        $soat = $this->soatRepository->update($input, $id);

        return $this->sendResponse($soat->toArray(), 'Soat updated successfully');
    }

    /**
     * Elimina el Soat especificado del almacenamiento.
     * DELETE /soats/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Soat $soat */
        $soat = $this->soatRepository->findWithoutFail($id);

        if (empty($soat)) {
            return $this->sendError('Soat not found');
        }

        $soat->delete();

        return $this->sendResponse($id, 'Soat deleted successfully');
    }
}
