<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDescuentoAPIRequest;
use App\Http\Requests\API\UpdateDescuentoAPIRequest;
use App\Models\Descuento;
use App\Repositories\DescuentoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DescuentoController
 * @package App\Http\Controllers\API
 */

class DescuentoAPIController extends AppBaseController
{
    /** @var  DescuentoRepository */
    private $descuentoRepository;

    public function __construct(DescuentoRepository $descuentoRepo)
    {
        $this->descuentoRepository = $descuentoRepo;
    }

    /**
     * Muestra lista del modelo Descuento.
     * GET|HEAD /descuentos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->descuentoRepository->pushCriteria(new RequestCriteria($request));
        $this->descuentoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $descuentos = $this->descuentoRepository->all();

        return $this->sendResponse($descuentos->toArray(), 'Descuentos retrieved successfully');
    }

    /**
     * Alamacena el  Descuento registrado.
     * POST /descuentos
     *
     * @param CreateDescuentoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDescuentoAPIRequest $request)
    {
        $input = $request->all();

        $descuentos = $this->descuentoRepository->create($input);

        return $this->sendResponse($descuentos->toArray(), 'Descuento saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Descuento.
     * GET|HEAD /descuentos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Descuento $descuento */
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            return $this->sendError('Descuento not found');
        }

        return $this->sendResponse($descuento->toArray(), 'Descuento retrieved successfully');
    }

    /**
     * Actualiza el Descuento segun su id.
     * PUT/PATCH /descuentos/{id}
     *
     * @param  int $id
     * @param UpdateDescuentoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDescuentoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Descuento $descuento */
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            return $this->sendError('Descuento not found');
        }

        $descuento = $this->descuentoRepository->update($input, $id);

        return $this->sendResponse($descuento->toArray(), 'Descuento updated successfully');
    }

    /**
     * Elimina el Descuento especificado del almacenamiento.
     * DELETE /descuentos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Descuento $descuento */
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            return $this->sendError('Descuento not found');
        }

        $descuento->delete();

        return $this->sendResponse($id, 'Descuento deleted successfully');
    }
}
