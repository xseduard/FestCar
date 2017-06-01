<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLicenciaConduccionAPIRequest;
use App\Http\Requests\API\UpdateLicenciaConduccionAPIRequest;
use App\Models\LicenciaConduccion;
use App\Repositories\LicenciaConduccionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LicenciaConduccionController
 * @package App\Http\Controllers\API
 */

class LicenciaConduccionAPIController extends AppBaseController
{
    /** @var  LicenciaConduccionRepository */
    private $licenciaConduccionRepository;

    public function __construct(LicenciaConduccionRepository $licenciaConduccionRepo)
    {
        $this->licenciaConduccionRepository = $licenciaConduccionRepo;
    }

    /**
     * Muestra lista del modelo LicenciaConduccion.
     * GET|HEAD /licenciaConduccions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->licenciaConduccionRepository->pushCriteria(new RequestCriteria($request));
        $this->licenciaConduccionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $licenciaConduccions = $this->licenciaConduccionRepository->all();

        return $this->sendResponse($licenciaConduccions->toArray(), 'Licencia Conduccions retrieved successfully');
    }

    /**
     * Alamacena el  LicenciaConduccion registrado.
     * POST /licenciaConduccions
     *
     * @param CreateLicenciaConduccionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLicenciaConduccionAPIRequest $request)
    {
        $input = $request->all();

        $licenciaConduccions = $this->licenciaConduccionRepository->create($input);

        return $this->sendResponse($licenciaConduccions->toArray(), 'Licencia Conduccion saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo LicenciaConduccion.
     * GET|HEAD /licenciaConduccions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var LicenciaConduccion $licenciaConduccion */
        $licenciaConduccion = $this->licenciaConduccionRepository->findWithoutFail($id);

        if (empty($licenciaConduccion)) {
            return $this->sendError('Licencia Conduccion not found');
        }

        return $this->sendResponse($licenciaConduccion->toArray(), 'Licencia Conduccion retrieved successfully');
    }

    /**
     * Actualiza el LicenciaConduccion segun su id.
     * PUT/PATCH /licenciaConduccions/{id}
     *
     * @param  int $id
     * @param UpdateLicenciaConduccionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLicenciaConduccionAPIRequest $request)
    {
        $input = $request->all();

        /** @var LicenciaConduccion $licenciaConduccion */
        $licenciaConduccion = $this->licenciaConduccionRepository->findWithoutFail($id);

        if (empty($licenciaConduccion)) {
            return $this->sendError('Licencia Conduccion not found');
        }

        $licenciaConduccion = $this->licenciaConduccionRepository->update($input, $id);

        return $this->sendResponse($licenciaConduccion->toArray(), 'LicenciaConduccion updated successfully');
    }

    /**
     * Elimina el LicenciaConduccion especificado del almacenamiento.
     * DELETE /licenciaConduccions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var LicenciaConduccion $licenciaConduccion */
        $licenciaConduccion = $this->licenciaConduccionRepository->findWithoutFail($id);

        if (empty($licenciaConduccion)) {
            return $this->sendError('Licencia Conduccion not found');
        }

        $licenciaConduccion->delete();

        return $this->sendResponse($id, 'Licencia Conduccion deleted successfully');
    }
}
