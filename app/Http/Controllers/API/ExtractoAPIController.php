<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExtractoAPIRequest;
use App\Http\Requests\API\UpdateExtractoAPIRequest;
use App\Models\Extracto;
use App\Repositories\ExtractoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ExtractoController
 * @package App\Http\Controllers\API
 */

class ExtractoAPIController extends AppBaseController
{
    /** @var  ExtractoRepository */
    private $extractoRepository;

    public function __construct(ExtractoRepository $extractoRepo)
    {
        $this->extractoRepository = $extractoRepo;
    }

    /**
     * Muestra lista del modelo Extracto.
     * GET|HEAD /extractos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->extractoRepository->pushCriteria(new RequestCriteria($request));
        $this->extractoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $extractos = $this->extractoRepository->all();

        return $this->sendResponse($extractos->toArray(), 'Extractos retrieved successfully');
    }

    /**
     * Alamacena el  Extracto registrado.
     * POST /extractos
     *
     * @param CreateExtractoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateExtractoAPIRequest $request)
    {
        $input = $request->all();

        $extractos = $this->extractoRepository->create($input);

        return $this->sendResponse($extractos->toArray(), 'Extracto saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Extracto.
     * GET|HEAD /extractos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Extracto $extracto */
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            return $this->sendError('Extracto not found');
        }

        return $this->sendResponse($extracto->toArray(), 'Extracto retrieved successfully');
    }

    /**
     * Actualiza el Extracto segun su id.
     * PUT/PATCH /extractos/{id}
     *
     * @param  int $id
     * @param UpdateExtractoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExtractoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Extracto $extracto */
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            return $this->sendError('Extracto not found');
        }

        $extracto = $this->extractoRepository->update($input, $id);

        return $this->sendResponse($extracto->toArray(), 'Extracto updated successfully');
    }

    /**
     * Elimina el Extracto especificado del almacenamiento.
     * DELETE /extractos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Extracto $extracto */
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            return $this->sendError('Extracto not found');
        }

        $extracto->delete();

        return $this->sendResponse($id, 'Extracto deleted successfully');
    }
}
