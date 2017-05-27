<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMunicipioAPIRequest;
use App\Http\Requests\API\UpdateMunicipioAPIRequest;
use App\Models\Municipio;
use App\Repositories\MunicipioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MunicipioController
 * @package App\Http\Controllers\API
 */

class MunicipioAPIController extends AppBaseController
{
    /** @var  MunicipioRepository */
    private $municipioRepository;

    public function __construct(MunicipioRepository $municipioRepo)
    {
        $this->municipioRepository = $municipioRepo;
    }

    /**
     * Muestra lista del modelo Municipio.
     * GET|HEAD /municipios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->municipioRepository->pushCriteria(new RequestCriteria($request));
        $this->municipioRepository->pushCriteria(new LimitOffsetCriteria($request));
        $municipios = $this->municipioRepository->all();

        return $this->sendResponse($municipios->toArray(), 'Municipios retrieved successfully');
    }

    /**
     * Alamacena el  Municipio registrado.
     * POST /municipios
     *
     * @param CreateMunicipioAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMunicipioAPIRequest $request)
    {
        $input = $request->all();

        $municipios = $this->municipioRepository->create($input);

        return $this->sendResponse($municipios->toArray(), 'Municipio saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Municipio.
     * GET|HEAD /municipios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Municipio $municipio */
        $municipio = $this->municipioRepository->findWithoutFail($id);

        if (empty($municipio)) {
            return $this->sendError('Municipio not found');
        }

        return $this->sendResponse($municipio->toArray(), 'Municipio retrieved successfully');
    }

    /**
     * Actualiza el Municipio segun su id.
     * PUT/PATCH /municipios/{id}
     *
     * @param  int $id
     * @param UpdateMunicipioAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMunicipioAPIRequest $request)
    {
        $input = $request->all();

        /** @var Municipio $municipio */
        $municipio = $this->municipioRepository->findWithoutFail($id);

        if (empty($municipio)) {
            return $this->sendError('Municipio not found');
        }

        $municipio = $this->municipioRepository->update($input, $id);

        return $this->sendResponse($municipio->toArray(), 'Municipio updated successfully');
    }

    /**
     * Elimina el Municipio especificado del almacenamiento.
     * DELETE /municipios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Municipio $municipio */
        $municipio = $this->municipioRepository->findWithoutFail($id);

        if (empty($municipio)) {
            return $this->sendError('Municipio not found');
        }

        $municipio->delete();

        return $this->sendResponse($id, 'Municipio deleted successfully');
    }
}
