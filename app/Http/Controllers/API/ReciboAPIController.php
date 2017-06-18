<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReciboAPIRequest;
use App\Http\Requests\API\UpdateReciboAPIRequest;
use App\Models\Recibo;
use App\Repositories\ReciboRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ReciboController
 * @package App\Http\Controllers\API
 */

class ReciboAPIController extends AppBaseController
{
    /** @var  ReciboRepository */
    private $reciboRepository;

    public function __construct(ReciboRepository $reciboRepo)
    {
        $this->reciboRepository = $reciboRepo;
    }

    /**
     * Muestra lista del modelo Recibo.
     * GET|HEAD /recibos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->reciboRepository->pushCriteria(new RequestCriteria($request));
        $this->reciboRepository->pushCriteria(new LimitOffsetCriteria($request));
        $recibos = $this->reciboRepository->all();

        return $this->sendResponse($recibos->toArray(), 'Recibos retrieved successfully');
    }

    /**
     * Alamacena el  Recibo registrado.
     * POST /recibos
     *
     * @param CreateReciboAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReciboAPIRequest $request)
    {
        $input = $request->all();

        $recibos = $this->reciboRepository->create($input);

        return $this->sendResponse($recibos->toArray(), 'Recibo saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Recibo.
     * GET|HEAD /recibos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Recibo $recibo */
        $recibo = $this->reciboRepository->findWithoutFail($id);

        if (empty($recibo)) {
            return $this->sendError('Recibo not found');
        }

        return $this->sendResponse($recibo->toArray(), 'Recibo retrieved successfully');
    }

    /**
     * Actualiza el Recibo segun su id.
     * PUT/PATCH /recibos/{id}
     *
     * @param  int $id
     * @param UpdateReciboAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReciboAPIRequest $request)
    {
        $input = $request->all();

        /** @var Recibo $recibo */
        $recibo = $this->reciboRepository->findWithoutFail($id);

        if (empty($recibo)) {
            return $this->sendError('Recibo not found');
        }

        $recibo = $this->reciboRepository->update($input, $id);

        return $this->sendResponse($recibo->toArray(), 'Recibo updated successfully');
    }

    /**
     * Elimina el Recibo especificado del almacenamiento.
     * DELETE /recibos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Recibo $recibo */
        $recibo = $this->reciboRepository->findWithoutFail($id);

        if (empty($recibo)) {
            return $this->sendError('Recibo not found');
        }

        $recibo->delete();

        return $this->sendResponse($id, 'Recibo deleted successfully');
    }
}
