<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReciboProductoAPIRequest;
use App\Http\Requests\API\UpdateReciboProductoAPIRequest;
use App\Models\ReciboProducto;
use App\Repositories\ReciboProductoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ReciboProductoController
 * @package App\Http\Controllers\API
 */

class ReciboProductoAPIController extends AppBaseController
{
    /** @var  ReciboProductoRepository */
    private $reciboProductoRepository;

    public function __construct(ReciboProductoRepository $reciboProductoRepo)
    {
        $this->reciboProductoRepository = $reciboProductoRepo;
    }

    /**
     * Muestra lista del modelo ReciboProducto.
     * GET|HEAD /reciboProductos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->reciboProductoRepository->pushCriteria(new RequestCriteria($request));
        $this->reciboProductoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $reciboProductos = $this->reciboProductoRepository->all();

        return $this->sendResponse($reciboProductos->toArray(), 'Recibo Productos retrieved successfully');
    }

    /**
     * Alamacena el  ReciboProducto registrado.
     * POST /reciboProductos
     *
     * @param CreateReciboProductoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReciboProductoAPIRequest $request)
    {
        $input = $request->all();

        $reciboProductos = $this->reciboProductoRepository->create($input);

        return $this->sendResponse($reciboProductos->toArray(), 'Recibo Producto saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo ReciboProducto.
     * GET|HEAD /reciboProductos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ReciboProducto $reciboProducto */
        $reciboProducto = $this->reciboProductoRepository->findWithoutFail($id);

        if (empty($reciboProducto)) {
            return $this->sendError('Recibo Producto not found');
        }

        return $this->sendResponse($reciboProducto->toArray(), 'Recibo Producto retrieved successfully');
    }

    /**
     * Actualiza el ReciboProducto segun su id.
     * PUT/PATCH /reciboProductos/{id}
     *
     * @param  int $id
     * @param UpdateReciboProductoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReciboProductoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ReciboProducto $reciboProducto */
        $reciboProducto = $this->reciboProductoRepository->findWithoutFail($id);

        if (empty($reciboProducto)) {
            return $this->sendError('Recibo Producto not found');
        }

        $reciboProducto = $this->reciboProductoRepository->update($input, $id);

        return $this->sendResponse($reciboProducto->toArray(), 'ReciboProducto updated successfully');
    }

    /**
     * Elimina el ReciboProducto especificado del almacenamiento.
     * DELETE /reciboProductos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ReciboProducto $reciboProducto */
        $reciboProducto = $this->reciboProductoRepository->findWithoutFail($id);

        if (empty($reciboProducto)) {
            return $this->sendError('Recibo Producto not found');
        }

        $reciboProducto->delete();

        return $this->sendResponse($id, 'Recibo Producto deleted successfully');
    }
}
