<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePqrsWebAPIRequest;
use App\Http\Requests\API\UpdatePqrsWebAPIRequest;
use App\Models\PqrsWeb;
use App\Repositories\PqrsWebRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PqrsWebController
 * @package App\Http\Controllers\API
 */

class PqrsWebAPIController extends AppBaseController
{
    /** @var  PqrsWebRepository */
    private $pqrsWebRepository;

    public function __construct(PqrsWebRepository $pqrsWebRepo)
    {
        $this->pqrsWebRepository = $pqrsWebRepo;
    }

    /**
     * Muestra lista del modelo PqrsWeb.
     * GET|HEAD /pqrsWebs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pqrsWebRepository->pushCriteria(new RequestCriteria($request));
        $this->pqrsWebRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pqrsWebs = $this->pqrsWebRepository->all();

        return $this->sendResponse($pqrsWebs->toArray(), 'Pqrs Webs retrieved successfully');
    }

    /**
     * Alamacena el  PqrsWeb registrado.
     * POST /pqrsWebs
     *
     * @param CreatePqrsWebAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePqrsWebAPIRequest $request)
    {
        $input = $request->all();

        $pqrsWebs = $this->pqrsWebRepository->create($input);

        return $this->sendResponse($pqrsWebs->toArray(), 'Pqrs Web saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo PqrsWeb.
     * GET|HEAD /pqrsWebs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PqrsWeb $pqrsWeb */
        $pqrsWeb = $this->pqrsWebRepository->findWithoutFail($id);

        if (empty($pqrsWeb)) {
            return $this->sendError('Pqrs Web not found');
        }

        return $this->sendResponse($pqrsWeb->toArray(), 'Pqrs Web retrieved successfully');
    }

    /**
     * Actualiza el PqrsWeb segun su id.
     * PUT/PATCH /pqrsWebs/{id}
     *
     * @param  int $id
     * @param UpdatePqrsWebAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePqrsWebAPIRequest $request)
    {
        $input = $request->all();

        /** @var PqrsWeb $pqrsWeb */
        $pqrsWeb = $this->pqrsWebRepository->findWithoutFail($id);

        if (empty($pqrsWeb)) {
            return $this->sendError('Pqrs Web not found');
        }

        $pqrsWeb = $this->pqrsWebRepository->update($input, $id);

        return $this->sendResponse($pqrsWeb->toArray(), 'PqrsWeb updated successfully');
    }

    /**
     * Elimina el PqrsWeb especificado del almacenamiento.
     * DELETE /pqrsWebs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PqrsWeb $pqrsWeb */
        $pqrsWeb = $this->pqrsWebRepository->findWithoutFail($id);

        if (empty($pqrsWeb)) {
            return $this->sendError('Pqrs Web not found');
        }

        $pqrsWeb->delete();

        return $this->sendResponse($id, 'Pqrs Web deleted successfully');
    }
}
