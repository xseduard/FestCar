<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePagoRelFacturaAPIRequest;
use App\Http\Requests\API\UpdatePagoRelFacturaAPIRequest;
use App\Models\PagoRelFactura;
use App\Repositories\PagoRelFacturaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PagoRelFacturaController
 * @package App\Http\Controllers\API
 */

class PagoRelFacturaAPIController extends AppBaseController
{
    /** @var  PagoRelFacturaRepository */
    private $pagoRelFacturaRepository;

    public function __construct(PagoRelFacturaRepository $pagoRelFacturaRepo)
    {
        $this->pagoRelFacturaRepository = $pagoRelFacturaRepo;
    }

    /**
     * Muestra lista del modelo PagoRelFactura.
     * GET|HEAD /pagoRelFacturas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pagoRelFacturaRepository->pushCriteria(new RequestCriteria($request));
        $this->pagoRelFacturaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pagoRelFacturas = $this->pagoRelFacturaRepository->all();

        return $this->sendResponse($pagoRelFacturas->toArray(), 'Pago Rel Facturas retrieved successfully');
    }

    /**
     * Alamacena el  PagoRelFactura registrado.
     * POST /pagoRelFacturas
     *
     * @param CreatePagoRelFacturaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoRelFacturaAPIRequest $request)
    {
        $input = $request->all();

        $pagoRelFacturas = $this->pagoRelFacturaRepository->create($input);

        return $this->sendResponse($pagoRelFacturas->toArray(), 'Pago Rel Factura saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo PagoRelFactura.
     * GET|HEAD /pagoRelFacturas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PagoRelFactura $pagoRelFactura */
        $pagoRelFactura = $this->pagoRelFacturaRepository->findWithoutFail($id);

        if (empty($pagoRelFactura)) {
            return $this->sendError('Pago Rel Factura not found');
        }

        return $this->sendResponse($pagoRelFactura->toArray(), 'Pago Rel Factura retrieved successfully');
    }

    /**
     * Actualiza el PagoRelFactura segun su id.
     * PUT/PATCH /pagoRelFacturas/{id}
     *
     * @param  int $id
     * @param UpdatePagoRelFacturaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoRelFacturaAPIRequest $request)
    {
        $input = $request->all();

        /** @var PagoRelFactura $pagoRelFactura */
        $pagoRelFactura = $this->pagoRelFacturaRepository->findWithoutFail($id);

        if (empty($pagoRelFactura)) {
            return $this->sendError('Pago Rel Factura not found');
        }

        $pagoRelFactura = $this->pagoRelFacturaRepository->update($input, $id);

        return $this->sendResponse($pagoRelFactura->toArray(), 'PagoRelFactura updated successfully');
    }

    /**
     * Elimina el PagoRelFactura especificado del almacenamiento.
     * DELETE /pagoRelFacturas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PagoRelFactura $pagoRelFactura */
        $pagoRelFactura = $this->pagoRelFacturaRepository->findWithoutFail($id);

        if (empty($pagoRelFactura)) {
            return $this->sendError('Pago Rel Factura not found');
        }

        $pagoRelFactura->delete();

        return $this->sendResponse($id, 'Pago Rel Factura deleted successfully');
    }
}
