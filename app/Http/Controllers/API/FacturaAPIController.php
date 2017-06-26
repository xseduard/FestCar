<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFacturaAPIRequest;
use App\Http\Requests\API\UpdateFacturaAPIRequest;
use App\Models\Factura;
use App\Repositories\FacturaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FacturaController
 * @package App\Http\Controllers\API
 */

class FacturaAPIController extends AppBaseController
{
    /** @var  FacturaRepository */
    private $facturaRepository;

    public function __construct(FacturaRepository $facturaRepo)
    {
        $this->facturaRepository = $facturaRepo;
    }

    /**
     * Muestra lista del modelo Factura.
     * GET|HEAD /facturas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->facturaRepository->pushCriteria(new RequestCriteria($request));
        $this->facturaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $facturas = $this->facturaRepository->all();

        return $this->sendResponse($facturas->toArray(), 'Facturas retrieved successfully');
    }

    /**
     * Alamacena el  Factura registrado.
     * POST /facturas
     *
     * @param CreateFacturaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFacturaAPIRequest $request)
    {
        $input = $request->all();

        $facturas = $this->facturaRepository->create($input);

        return $this->sendResponse($facturas->toArray(), 'Factura saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Factura.
     * GET|HEAD /facturas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Factura $factura */
        $factura = $this->facturaRepository->findWithoutFail($id);

        if (empty($factura)) {
            return $this->sendError('Factura not found');
        }

        return $this->sendResponse($factura->toArray(), 'Factura retrieved successfully');
    }

    /**
     * Actualiza el Factura segun su id.
     * PUT/PATCH /facturas/{id}
     *
     * @param  int $id
     * @param UpdateFacturaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFacturaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Factura $factura */
        $factura = $this->facturaRepository->findWithoutFail($id);

        if (empty($factura)) {
            return $this->sendError('Factura not found');
        }

        $factura = $this->facturaRepository->update($input, $id);

        return $this->sendResponse($factura->toArray(), 'Factura updated successfully');
    }

    /**
     * Elimina el Factura especificado del almacenamiento.
     * DELETE /facturas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Factura $factura */
        $factura = $this->facturaRepository->findWithoutFail($id);

        if (empty($factura)) {
            return $this->sendError('Factura not found');
        }

        $factura->delete();

        return $this->sendResponse($id, 'Factura deleted successfully');
    }
}
