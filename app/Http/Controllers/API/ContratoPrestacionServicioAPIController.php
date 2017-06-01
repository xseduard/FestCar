<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContratoPrestacionServicioAPIRequest;
use App\Http\Requests\API\UpdateContratoPrestacionServicioAPIRequest;
use App\Models\ContratoPrestacionServicio;
use App\Repositories\ContratoPrestacionServicioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ContratoPrestacionServicioController
 * @package App\Http\Controllers\API
 */

class ContratoPrestacionServicioAPIController extends AppBaseController
{
    /** @var  ContratoPrestacionServicioRepository */
    private $contratoPrestacionServicioRepository;

    public function __construct(ContratoPrestacionServicioRepository $contratoPrestacionServicioRepo)
    {
        $this->contratoPrestacionServicioRepository = $contratoPrestacionServicioRepo;
    }

    /**
     * Muestra lista del modelo ContratoPrestacionServicio.
     * GET|HEAD /contratoPrestacionServicios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contratoPrestacionServicioRepository->pushCriteria(new RequestCriteria($request));
        $this->contratoPrestacionServicioRepository->pushCriteria(new LimitOffsetCriteria($request));
        $contratoPrestacionServicios = $this->contratoPrestacionServicioRepository->all();

        return $this->sendResponse($contratoPrestacionServicios->toArray(), 'Contrato Prestacion Servicios retrieved successfully');
    }

    /**
     * Alamacena el  ContratoPrestacionServicio registrado.
     * POST /contratoPrestacionServicios
     *
     * @param CreateContratoPrestacionServicioAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateContratoPrestacionServicioAPIRequest $request)
    {
        $input = $request->all();

        $contratoPrestacionServicios = $this->contratoPrestacionServicioRepository->create($input);

        return $this->sendResponse($contratoPrestacionServicios->toArray(), 'Contrato Prestacion Servicio saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo ContratoPrestacionServicio.
     * GET|HEAD /contratoPrestacionServicios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ContratoPrestacionServicio $contratoPrestacionServicio */
        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->findWithoutFail($id);

        if (empty($contratoPrestacionServicio)) {
            return $this->sendError('Contrato Prestacion Servicio not found');
        }

        return $this->sendResponse($contratoPrestacionServicio->toArray(), 'Contrato Prestacion Servicio retrieved successfully');
    }

    /**
     * Actualiza el ContratoPrestacionServicio segun su id.
     * PUT/PATCH /contratoPrestacionServicios/{id}
     *
     * @param  int $id
     * @param UpdateContratoPrestacionServicioAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContratoPrestacionServicioAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContratoPrestacionServicio $contratoPrestacionServicio */
        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->findWithoutFail($id);

        if (empty($contratoPrestacionServicio)) {
            return $this->sendError('Contrato Prestacion Servicio not found');
        }

        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->update($input, $id);

        return $this->sendResponse($contratoPrestacionServicio->toArray(), 'ContratoPrestacionServicio updated successfully');
    }

    /**
     * Elimina el ContratoPrestacionServicio especificado del almacenamiento.
     * DELETE /contratoPrestacionServicios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ContratoPrestacionServicio $contratoPrestacionServicio */
        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->findWithoutFail($id);

        if (empty($contratoPrestacionServicio)) {
            return $this->sendError('Contrato Prestacion Servicio not found');
        }

        $contratoPrestacionServicio->delete();

        return $this->sendResponse($id, 'Contrato Prestacion Servicio deleted successfully');
    }
}
