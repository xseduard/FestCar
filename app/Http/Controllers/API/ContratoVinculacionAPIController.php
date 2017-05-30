<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContratoVinculacionAPIRequest;
use App\Http\Requests\API\UpdateContratoVinculacionAPIRequest;
use App\Models\ContratoVinculacion;
use App\Repositories\ContratoVinculacionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ContratoVinculacionController
 * @package App\Http\Controllers\API
 */

class ContratoVinculacionAPIController extends AppBaseController
{
    /** @var  ContratoVinculacionRepository */
    private $contratoVinculacionRepository;

    public function __construct(ContratoVinculacionRepository $contratoVinculacionRepo)
    {
        $this->contratoVinculacionRepository = $contratoVinculacionRepo;
    }

    /**
     * Muestra lista del modelo ContratoVinculacion.
     * GET|HEAD /contratoVinculacions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contratoVinculacionRepository->pushCriteria(new RequestCriteria($request));
        $this->contratoVinculacionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $contratoVinculacions = $this->contratoVinculacionRepository->all();

        return $this->sendResponse($contratoVinculacions->toArray(), 'Contrato Vinculacions retrieved successfully');
    }

    /**
     * Alamacena el  ContratoVinculacion registrado.
     * POST /contratoVinculacions
     *
     * @param CreateContratoVinculacionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateContratoVinculacionAPIRequest $request)
    {
        $input = $request->all();

        $contratoVinculacions = $this->contratoVinculacionRepository->create($input);

        return $this->sendResponse($contratoVinculacions->toArray(), 'Contrato Vinculacion saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo ContratoVinculacion.
     * GET|HEAD /contratoVinculacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ContratoVinculacion $contratoVinculacion */
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            return $this->sendError('Contrato Vinculacion not found');
        }

        return $this->sendResponse($contratoVinculacion->toArray(), 'Contrato Vinculacion retrieved successfully');
    }

    /**
     * Actualiza el ContratoVinculacion segun su id.
     * PUT/PATCH /contratoVinculacions/{id}
     *
     * @param  int $id
     * @param UpdateContratoVinculacionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContratoVinculacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContratoVinculacion $contratoVinculacion */
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            return $this->sendError('Contrato Vinculacion not found');
        }

        $contratoVinculacion = $this->contratoVinculacionRepository->update($input, $id);

        return $this->sendResponse($contratoVinculacion->toArray(), 'ContratoVinculacion updated successfully');
    }

    /**
     * Elimina el ContratoVinculacion especificado del almacenamiento.
     * DELETE /contratoVinculacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ContratoVinculacion $contratoVinculacion */
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            return $this->sendError('Contrato Vinculacion not found');
        }

        $contratoVinculacion->delete();

        return $this->sendResponse($id, 'Contrato Vinculacion deleted successfully');
    }
}
