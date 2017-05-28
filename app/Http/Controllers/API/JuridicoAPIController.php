<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJuridicoAPIRequest;
use App\Http\Requests\API\UpdateJuridicoAPIRequest;
use App\Models\Juridico;
use App\Repositories\JuridicoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class JuridicoController
 * @package App\Http\Controllers\API
 */

class JuridicoAPIController extends AppBaseController
{
    /** @var  JuridicoRepository */
    private $juridicoRepository;

    public function __construct(JuridicoRepository $juridicoRepo)
    {
        $this->juridicoRepository = $juridicoRepo;
    }

    /**
     * Muestra lista del modelo Juridico.
     * GET|HEAD /juridicos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->juridicoRepository->pushCriteria(new RequestCriteria($request));
        $this->juridicoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $juridicos = $this->juridicoRepository->all();

        return $this->sendResponse($juridicos->toArray(), 'Juridicos retrieved successfully');
    }

    /**
     * Alamacena el  Juridico registrado.
     * POST /juridicos
     *
     * @param CreateJuridicoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateJuridicoAPIRequest $request)
    {
        $input = $request->all();

        $juridicos = $this->juridicoRepository->create($input);

        return $this->sendResponse($juridicos->toArray(), 'Juridico saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Juridico.
     * GET|HEAD /juridicos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Juridico $juridico */
        $juridico = $this->juridicoRepository->findWithoutFail($id);

        if (empty($juridico)) {
            return $this->sendError('Juridico not found');
        }

        return $this->sendResponse($juridico->toArray(), 'Juridico retrieved successfully');
    }

    /**
     * Actualiza el Juridico segun su id.
     * PUT/PATCH /juridicos/{id}
     *
     * @param  int $id
     * @param UpdateJuridicoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJuridicoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Juridico $juridico */
        $juridico = $this->juridicoRepository->findWithoutFail($id);

        if (empty($juridico)) {
            return $this->sendError('Juridico not found');
        }

        $juridico = $this->juridicoRepository->update($input, $id);

        return $this->sendResponse($juridico->toArray(), 'Juridico updated successfully');
    }

    /**
     * Elimina el Juridico especificado del almacenamiento.
     * DELETE /juridicos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Juridico $juridico */
        $juridico = $this->juridicoRepository->findWithoutFail($id);

        if (empty($juridico)) {
            return $this->sendError('Juridico not found');
        }

        $juridico->delete();

        return $this->sendResponse($id, 'Juridico deleted successfully');
    }
}
