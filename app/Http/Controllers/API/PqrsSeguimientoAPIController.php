<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePqrsSeguimientoAPIRequest;
use App\Http\Requests\API\UpdatePqrsSeguimientoAPIRequest;
use App\Models\PqrsSeguimiento;
use App\Repositories\PqrsSeguimientoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PqrsSeguimientoController
 * @package App\Http\Controllers\API
 */

class PqrsSeguimientoAPIController extends AppBaseController
{
    /** @var  PqrsSeguimientoRepository */
    private $pqrsSeguimientoRepository;

    public function __construct(PqrsSeguimientoRepository $pqrsSeguimientoRepo)
    {
        $this->pqrsSeguimientoRepository = $pqrsSeguimientoRepo;
    }

    /**
     * Muestra lista del modelo PqrsSeguimiento.
     * GET|HEAD /pqrsSeguimientos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pqrsSeguimientoRepository->pushCriteria(new RequestCriteria($request));
        $this->pqrsSeguimientoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pqrsSeguimientos = $this->pqrsSeguimientoRepository->all();

        return $this->sendResponse($pqrsSeguimientos->toArray(), 'Pqrs Seguimientos retrieved successfully');
    }

    /**
     * Alamacena el  PqrsSeguimiento registrado.
     * POST /pqrsSeguimientos
     *
     * @param CreatePqrsSeguimientoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePqrsSeguimientoAPIRequest $request)
    {
        $input = $request->all();

        $pqrsSeguimientos = $this->pqrsSeguimientoRepository->create($input);

        return $this->sendResponse($pqrsSeguimientos->toArray(), 'Pqrs Seguimiento saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo PqrsSeguimiento.
     * GET|HEAD /pqrsSeguimientos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PqrsSeguimiento $pqrsSeguimiento */
        $pqrsSeguimiento = $this->pqrsSeguimientoRepository->findWithoutFail($id);

        if (empty($pqrsSeguimiento)) {
            return $this->sendError('Pqrs Seguimiento not found');
        }

        return $this->sendResponse($pqrsSeguimiento->toArray(), 'Pqrs Seguimiento retrieved successfully');
    }

    /**
     * Actualiza el PqrsSeguimiento segun su id.
     * PUT/PATCH /pqrsSeguimientos/{id}
     *
     * @param  int $id
     * @param UpdatePqrsSeguimientoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePqrsSeguimientoAPIRequest $request)
    {
        $input = $request->all();

        /** @var PqrsSeguimiento $pqrsSeguimiento */
        $pqrsSeguimiento = $this->pqrsSeguimientoRepository->findWithoutFail($id);

        if (empty($pqrsSeguimiento)) {
            return $this->sendError('Pqrs Seguimiento not found');
        }

        $pqrsSeguimiento = $this->pqrsSeguimientoRepository->update($input, $id);

        return $this->sendResponse($pqrsSeguimiento->toArray(), 'PqrsSeguimiento updated successfully');
    }

    /**
     * Elimina el PqrsSeguimiento especificado del almacenamiento.
     * DELETE /pqrsSeguimientos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PqrsSeguimiento $pqrsSeguimiento */
        $pqrsSeguimiento = $this->pqrsSeguimientoRepository->findWithoutFail($id);

        if (empty($pqrsSeguimiento)) {
            return $this->sendError('Pqrs Seguimiento not found');
        }

        $pqrsSeguimiento->delete();

        return $this->sendResponse($id, 'Pqrs Seguimiento deleted successfully');
    }
}
