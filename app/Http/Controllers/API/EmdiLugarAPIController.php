<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmdiLugarAPIRequest;
use App\Http\Requests\API\UpdateEmdiLugarAPIRequest;
use App\Models\EmdiLugar;
use App\Repositories\EmdiLugarRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EmdiLugarController
 * @package App\Http\Controllers\API
 */

class EmdiLugarAPIController extends AppBaseController
{
    /** @var  EmdiLugarRepository */
    private $emdiLugarRepository;

    public function __construct(EmdiLugarRepository $emdiLugarRepo)
    {
        $this->emdiLugarRepository = $emdiLugarRepo;
    }

    /**
     * Muestra lista del modelo EmdiLugar.
     * GET|HEAD /emdiLugars
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->emdiLugarRepository->pushCriteria(new RequestCriteria($request));
        $this->emdiLugarRepository->pushCriteria(new LimitOffsetCriteria($request));
        $emdiLugars = $this->emdiLugarRepository->all();

        return $this->sendResponse($emdiLugars->toArray(), 'Emdi Lugars retrieved successfully');
    }

    /**
     * Alamacena el  EmdiLugar registrado.
     * POST /emdiLugars
     *
     * @param CreateEmdiLugarAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmdiLugarAPIRequest $request)
    {
        $input = $request->all();

        $emdiLugars = $this->emdiLugarRepository->create($input);

        return $this->sendResponse($emdiLugars->toArray(), 'Emdi Lugar saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo EmdiLugar.
     * GET|HEAD /emdiLugars/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EmdiLugar $emdiLugar */
        $emdiLugar = $this->emdiLugarRepository->findWithoutFail($id);

        if (empty($emdiLugar)) {
            return $this->sendError('Emdi Lugar not found');
        }

        return $this->sendResponse($emdiLugar->toArray(), 'Emdi Lugar retrieved successfully');
    }

    /**
     * Actualiza el EmdiLugar segun su id.
     * PUT/PATCH /emdiLugars/{id}
     *
     * @param  int $id
     * @param UpdateEmdiLugarAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmdiLugarAPIRequest $request)
    {
        $input = $request->all();

        /** @var EmdiLugar $emdiLugar */
        $emdiLugar = $this->emdiLugarRepository->findWithoutFail($id);

        if (empty($emdiLugar)) {
            return $this->sendError('Emdi Lugar not found');
        }

        $emdiLugar = $this->emdiLugarRepository->update($input, $id);

        return $this->sendResponse($emdiLugar->toArray(), 'EmdiLugar updated successfully');
    }

    /**
     * Elimina el EmdiLugar especificado del almacenamiento.
     * DELETE /emdiLugars/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EmdiLugar $emdiLugar */
        $emdiLugar = $this->emdiLugarRepository->findWithoutFail($id);

        if (empty($emdiLugar)) {
            return $this->sendError('Emdi Lugar not found');
        }

        $emdiLugar->delete();

        return $this->sendResponse($id, 'Emdi Lugar deleted successfully');
    }
}
