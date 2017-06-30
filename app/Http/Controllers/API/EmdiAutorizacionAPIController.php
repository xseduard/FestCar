<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmdiAutorizacionAPIRequest;
use App\Http\Requests\API\UpdateEmdiAutorizacionAPIRequest;
use App\Models\EmdiAutorizacion;
use App\Repositories\EmdiAutorizacionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EmdiAutorizacionController
 * @package App\Http\Controllers\API
 */

class EmdiAutorizacionAPIController extends AppBaseController
{
    /** @var  EmdiAutorizacionRepository */
    private $emdiAutorizacionRepository;

    public function __construct(EmdiAutorizacionRepository $emdiAutorizacionRepo)
    {
        $this->emdiAutorizacionRepository = $emdiAutorizacionRepo;
    }

    /**
     * Muestra lista del modelo EmdiAutorizacion.
     * GET|HEAD /emdiAutorizacions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->emdiAutorizacionRepository->pushCriteria(new RequestCriteria($request));
        $this->emdiAutorizacionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $emdiAutorizacions = $this->emdiAutorizacionRepository->all();

        return $this->sendResponse($emdiAutorizacions->toArray(), 'Emdi Autorizacions retrieved successfully');
    }

    /**
     * Alamacena el  EmdiAutorizacion registrado.
     * POST /emdiAutorizacions
     *
     * @param CreateEmdiAutorizacionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmdiAutorizacionAPIRequest $request)
    {
        $input = $request->all();

        $emdiAutorizacions = $this->emdiAutorizacionRepository->create($input);

        return $this->sendResponse($emdiAutorizacions->toArray(), 'Emdi Autorizacion saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo EmdiAutorizacion.
     * GET|HEAD /emdiAutorizacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EmdiAutorizacion $emdiAutorizacion */
        $emdiAutorizacion = $this->emdiAutorizacionRepository->findWithoutFail($id);

        if (empty($emdiAutorizacion)) {
            return $this->sendError('Emdi Autorizacion not found');
        }

        return $this->sendResponse($emdiAutorizacion->toArray(), 'Emdi Autorizacion retrieved successfully');
    }

    /**
     * Actualiza el EmdiAutorizacion segun su id.
     * PUT/PATCH /emdiAutorizacions/{id}
     *
     * @param  int $id
     * @param UpdateEmdiAutorizacionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmdiAutorizacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var EmdiAutorizacion $emdiAutorizacion */
        $emdiAutorizacion = $this->emdiAutorizacionRepository->findWithoutFail($id);

        if (empty($emdiAutorizacion)) {
            return $this->sendError('Emdi Autorizacion not found');
        }

        $emdiAutorizacion = $this->emdiAutorizacionRepository->update($input, $id);

        return $this->sendResponse($emdiAutorizacion->toArray(), 'EmdiAutorizacion updated successfully');
    }

    /**
     * Elimina el EmdiAutorizacion especificado del almacenamiento.
     * DELETE /emdiAutorizacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EmdiAutorizacion $emdiAutorizacion */
        $emdiAutorizacion = $this->emdiAutorizacionRepository->findWithoutFail($id);

        if (empty($emdiAutorizacion)) {
            return $this->sendError('Emdi Autorizacion not found');
        }

        $emdiAutorizacion->delete();

        return $this->sendResponse($id, 'Emdi Autorizacion deleted successfully');
    }
}
