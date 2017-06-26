<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePagoRelDescuentoAPIRequest;
use App\Http\Requests\API\UpdatePagoRelDescuentoAPIRequest;
use App\Models\PagoRelDescuento;
use App\Repositories\PagoRelDescuentoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PagoRelDescuentoController
 * @package App\Http\Controllers\API
 */

class PagoRelDescuentoAPIController extends AppBaseController
{
    /** @var  PagoRelDescuentoRepository */
    private $pagoRelDescuentoRepository;

    public function __construct(PagoRelDescuentoRepository $pagoRelDescuentoRepo)
    {
        $this->pagoRelDescuentoRepository = $pagoRelDescuentoRepo;
    }

    /**
     * Muestra lista del modelo PagoRelDescuento.
     * GET|HEAD /pagoRelDescuentos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pagoRelDescuentoRepository->pushCriteria(new RequestCriteria($request));
        $this->pagoRelDescuentoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pagoRelDescuentos = $this->pagoRelDescuentoRepository->all();

        return $this->sendResponse($pagoRelDescuentos->toArray(), 'Pago Rel Descuentos retrieved successfully');
    }

    /**
     * Alamacena el  PagoRelDescuento registrado.
     * POST /pagoRelDescuentos
     *
     * @param CreatePagoRelDescuentoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoRelDescuentoAPIRequest $request)
    {
        $input = $request->all();

        $pagoRelDescuentos = $this->pagoRelDescuentoRepository->create($input);

        return $this->sendResponse($pagoRelDescuentos->toArray(), 'Pago Rel Descuento saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo PagoRelDescuento.
     * GET|HEAD /pagoRelDescuentos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PagoRelDescuento $pagoRelDescuento */
        $pagoRelDescuento = $this->pagoRelDescuentoRepository->findWithoutFail($id);

        if (empty($pagoRelDescuento)) {
            return $this->sendError('Pago Rel Descuento not found');
        }

        return $this->sendResponse($pagoRelDescuento->toArray(), 'Pago Rel Descuento retrieved successfully');
    }

    /**
     * Actualiza el PagoRelDescuento segun su id.
     * PUT/PATCH /pagoRelDescuentos/{id}
     *
     * @param  int $id
     * @param UpdatePagoRelDescuentoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoRelDescuentoAPIRequest $request)
    {
        $input = $request->all();

        /** @var PagoRelDescuento $pagoRelDescuento */
        $pagoRelDescuento = $this->pagoRelDescuentoRepository->findWithoutFail($id);

        if (empty($pagoRelDescuento)) {
            return $this->sendError('Pago Rel Descuento not found');
        }

        $pagoRelDescuento = $this->pagoRelDescuentoRepository->update($input, $id);

        return $this->sendResponse($pagoRelDescuento->toArray(), 'PagoRelDescuento updated successfully');
    }

    /**
     * Elimina el PagoRelDescuento especificado del almacenamiento.
     * DELETE /pagoRelDescuentos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PagoRelDescuento $pagoRelDescuento */
        $pagoRelDescuento = $this->pagoRelDescuentoRepository->findWithoutFail($id);

        if (empty($pagoRelDescuento)) {
            return $this->sendError('Pago Rel Descuento not found');
        }

        $pagoRelDescuento->delete();

        return $this->sendResponse($id, 'Pago Rel Descuento deleted successfully');
    }
}
