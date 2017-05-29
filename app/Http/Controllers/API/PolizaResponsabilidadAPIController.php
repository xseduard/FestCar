<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePolizaResponsabilidadAPIRequest;
use App\Http\Requests\API\UpdatePolizaResponsabilidadAPIRequest;
use App\Models\PolizaResponsabilidad;
use App\Repositories\PolizaResponsabilidadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PolizaResponsabilidadController
 * @package App\Http\Controllers\API
 */

class PolizaResponsabilidadAPIController extends AppBaseController
{
    /** @var  PolizaResponsabilidadRepository */
    private $polizaResponsabilidadRepository;

    public function __construct(PolizaResponsabilidadRepository $polizaResponsabilidadRepo)
    {
        $this->polizaResponsabilidadRepository = $polizaResponsabilidadRepo;
    }

    /**
     * Muestra lista del modelo PolizaResponsabilidad.
     * GET|HEAD /polizaResponsabilidads
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->polizaResponsabilidadRepository->pushCriteria(new RequestCriteria($request));
        $this->polizaResponsabilidadRepository->pushCriteria(new LimitOffsetCriteria($request));
        $polizaResponsabilidads = $this->polizaResponsabilidadRepository->all();

        return $this->sendResponse($polizaResponsabilidads->toArray(), 'Poliza Responsabilidads retrieved successfully');
    }

    /**
     * Alamacena el  PolizaResponsabilidad registrado.
     * POST /polizaResponsabilidads
     *
     * @param CreatePolizaResponsabilidadAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePolizaResponsabilidadAPIRequest $request)
    {
        $input = $request->all();

        $polizaResponsabilidads = $this->polizaResponsabilidadRepository->create($input);

        return $this->sendResponse($polizaResponsabilidads->toArray(), 'Poliza Responsabilidad saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo PolizaResponsabilidad.
     * GET|HEAD /polizaResponsabilidads/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PolizaResponsabilidad $polizaResponsabilidad */
        $polizaResponsabilidad = $this->polizaResponsabilidadRepository->findWithoutFail($id);

        if (empty($polizaResponsabilidad)) {
            return $this->sendError('Poliza Responsabilidad not found');
        }

        return $this->sendResponse($polizaResponsabilidad->toArray(), 'Poliza Responsabilidad retrieved successfully');
    }

    /**
     * Actualiza el PolizaResponsabilidad segun su id.
     * PUT/PATCH /polizaResponsabilidads/{id}
     *
     * @param  int $id
     * @param UpdatePolizaResponsabilidadAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePolizaResponsabilidadAPIRequest $request)
    {
        $input = $request->all();

        /** @var PolizaResponsabilidad $polizaResponsabilidad */
        $polizaResponsabilidad = $this->polizaResponsabilidadRepository->findWithoutFail($id);

        if (empty($polizaResponsabilidad)) {
            return $this->sendError('Poliza Responsabilidad not found');
        }

        $polizaResponsabilidad = $this->polizaResponsabilidadRepository->update($input, $id);

        return $this->sendResponse($polizaResponsabilidad->toArray(), 'PolizaResponsabilidad updated successfully');
    }

    /**
     * Elimina el PolizaResponsabilidad especificado del almacenamiento.
     * DELETE /polizaResponsabilidads/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PolizaResponsabilidad $polizaResponsabilidad */
        $polizaResponsabilidad = $this->polizaResponsabilidadRepository->findWithoutFail($id);

        if (empty($polizaResponsabilidad)) {
            return $this->sendError('Poliza Responsabilidad not found');
        }

        $polizaResponsabilidad->delete();

        return $this->sendResponse($id, 'Poliza Responsabilidad deleted successfully');
    }
}
