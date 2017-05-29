<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTecnicomecanicaAPIRequest;
use App\Http\Requests\API\UpdateTecnicomecanicaAPIRequest;
use App\Models\Tecnicomecanica;
use App\Repositories\TecnicomecanicaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TecnicomecanicaController
 * @package App\Http\Controllers\API
 */

class TecnicomecanicaAPIController extends AppBaseController
{
    /** @var  TecnicomecanicaRepository */
    private $tecnicomecanicaRepository;

    public function __construct(TecnicomecanicaRepository $tecnicomecanicaRepo)
    {
        $this->tecnicomecanicaRepository = $tecnicomecanicaRepo;
    }

    /**
     * Muestra lista del modelo Tecnicomecanica.
     * GET|HEAD /tecnicomecanicas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tecnicomecanicaRepository->pushCriteria(new RequestCriteria($request));
        $this->tecnicomecanicaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tecnicomecanicas = $this->tecnicomecanicaRepository->all();

        return $this->sendResponse($tecnicomecanicas->toArray(), 'Tecnicomecanicas retrieved successfully');
    }

    /**
     * Alamacena el  Tecnicomecanica registrado.
     * POST /tecnicomecanicas
     *
     * @param CreateTecnicomecanicaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTecnicomecanicaAPIRequest $request)
    {
        $input = $request->all();

        $tecnicomecanicas = $this->tecnicomecanicaRepository->create($input);

        return $this->sendResponse($tecnicomecanicas->toArray(), 'Tecnicomecanica saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Tecnicomecanica.
     * GET|HEAD /tecnicomecanicas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Tecnicomecanica $tecnicomecanica */
        $tecnicomecanica = $this->tecnicomecanicaRepository->findWithoutFail($id);

        if (empty($tecnicomecanica)) {
            return $this->sendError('Tecnicomecanica not found');
        }

        return $this->sendResponse($tecnicomecanica->toArray(), 'Tecnicomecanica retrieved successfully');
    }

    /**
     * Actualiza el Tecnicomecanica segun su id.
     * PUT/PATCH /tecnicomecanicas/{id}
     *
     * @param  int $id
     * @param UpdateTecnicomecanicaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTecnicomecanicaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Tecnicomecanica $tecnicomecanica */
        $tecnicomecanica = $this->tecnicomecanicaRepository->findWithoutFail($id);

        if (empty($tecnicomecanica)) {
            return $this->sendError('Tecnicomecanica not found');
        }

        $tecnicomecanica = $this->tecnicomecanicaRepository->update($input, $id);

        return $this->sendResponse($tecnicomecanica->toArray(), 'Tecnicomecanica updated successfully');
    }

    /**
     * Elimina el Tecnicomecanica especificado del almacenamiento.
     * DELETE /tecnicomecanicas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Tecnicomecanica $tecnicomecanica */
        $tecnicomecanica = $this->tecnicomecanicaRepository->findWithoutFail($id);

        if (empty($tecnicomecanica)) {
            return $this->sendError('Tecnicomecanica not found');
        }

        $tecnicomecanica->delete();

        return $this->sendResponse($id, 'Tecnicomecanica deleted successfully');
    }
}
