<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReciboDetalleAPIRequest;
use App\Http\Requests\API\UpdateReciboDetalleAPIRequest;
use App\Models\ReciboDetalle;
use App\Repositories\ReciboDetalleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ReciboDetalleController
 * @package App\Http\Controllers\API
 */

class ReciboDetalleAPIController extends AppBaseController
{
    /** @var  ReciboDetalleRepository */
    private $reciboDetalleRepository;

    public function __construct(ReciboDetalleRepository $reciboDetalleRepo)
    {
        $this->reciboDetalleRepository = $reciboDetalleRepo;
    }

    /**
     * Muestra lista del modelo ReciboDetalle.
     * GET|HEAD /reciboDetalles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->reciboDetalleRepository->pushCriteria(new RequestCriteria($request));
        $this->reciboDetalleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $reciboDetalles = $this->reciboDetalleRepository->all();

        return $this->sendResponse($reciboDetalles->toArray(), 'Recibo Detalles retrieved successfully');
    }

    /**
     * Alamacena el  ReciboDetalle registrado.
     * POST /reciboDetalles
     *
     * @param CreateReciboDetalleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReciboDetalleAPIRequest $request)
    {
        $input = $request->all();

        $reciboDetalles = $this->reciboDetalleRepository->create($input);

        return $this->sendResponse($reciboDetalles->toArray(), 'Recibo Detalle saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo ReciboDetalle.
     * GET|HEAD /reciboDetalles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ReciboDetalle $reciboDetalle */
        $reciboDetalle = $this->reciboDetalleRepository->findWithoutFail($id);

        if (empty($reciboDetalle)) {
            return $this->sendError('Recibo Detalle not found');
        }

        return $this->sendResponse($reciboDetalle->toArray(), 'Recibo Detalle retrieved successfully');
    }

    /**
     * Actualiza el ReciboDetalle segun su id.
     * PUT/PATCH /reciboDetalles/{id}
     *
     * @param  int $id
     * @param UpdateReciboDetalleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReciboDetalleAPIRequest $request)
    {
        $input = $request->all();

        /** @var ReciboDetalle $reciboDetalle */
        $reciboDetalle = $this->reciboDetalleRepository->findWithoutFail($id);

        if (empty($reciboDetalle)) {
            return $this->sendError('Recibo Detalle not found');
        }

        $reciboDetalle = $this->reciboDetalleRepository->update($input, $id);

        return $this->sendResponse($reciboDetalle->toArray(), 'ReciboDetalle updated successfully');
    }

    /**
     * Elimina el ReciboDetalle especificado del almacenamiento.
     * DELETE /reciboDetalles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ReciboDetalle $reciboDetalle */
        $reciboDetalle = $this->reciboDetalleRepository->findWithoutFail($id);

        if (empty($reciboDetalle)) {
            return $this->sendError('Recibo Detalle not found');
        }

        $reciboDetalle->delete();

        return $this->sendResponse($id, 'Recibo Detalle deleted successfully');
    }
}
