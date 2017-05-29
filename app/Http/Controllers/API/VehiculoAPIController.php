<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVehiculoAPIRequest;
use App\Http\Requests\API\UpdateVehiculoAPIRequest;
use App\Models\Vehiculo;
use App\Repositories\VehiculoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class VehiculoController
 * @package App\Http\Controllers\API
 */

class VehiculoAPIController extends AppBaseController
{
    /** @var  VehiculoRepository */
    private $vehiculoRepository;

    public function __construct(VehiculoRepository $vehiculoRepo)
    {
        $this->vehiculoRepository = $vehiculoRepo;
    }

    /**
     * Muestra lista del modelo Vehiculo.
     * GET|HEAD /vehiculos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->vehiculoRepository->pushCriteria(new RequestCriteria($request));
        $this->vehiculoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $vehiculos = $this->vehiculoRepository->all();

        return $this->sendResponse($vehiculos->toArray(), 'Vehiculos retrieved successfully');
    }

    /**
     * Alamacena el  Vehiculo registrado.
     * POST /vehiculos
     *
     * @param CreateVehiculoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateVehiculoAPIRequest $request)
    {
        $input = $request->all();

        $vehiculos = $this->vehiculoRepository->create($input);

        return $this->sendResponse($vehiculos->toArray(), 'Vehiculo saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Vehiculo.
     * GET|HEAD /vehiculos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Vehiculo $vehiculo */
        $vehiculo = $this->vehiculoRepository->findWithoutFail($id);

        if (empty($vehiculo)) {
            return $this->sendError('Vehiculo not found');
        }

        return $this->sendResponse($vehiculo->toArray(), 'Vehiculo retrieved successfully');
    }

    /**
     * Actualiza el Vehiculo segun su id.
     * PUT/PATCH /vehiculos/{id}
     *
     * @param  int $id
     * @param UpdateVehiculoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVehiculoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Vehiculo $vehiculo */
        $vehiculo = $this->vehiculoRepository->findWithoutFail($id);

        if (empty($vehiculo)) {
            return $this->sendError('Vehiculo not found');
        }

        $vehiculo = $this->vehiculoRepository->update($input, $id);

        return $this->sendResponse($vehiculo->toArray(), 'Vehiculo updated successfully');
    }

    /**
     * Elimina el Vehiculo especificado del almacenamiento.
     * DELETE /vehiculos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Vehiculo $vehiculo */
        $vehiculo = $this->vehiculoRepository->findWithoutFail($id);

        if (empty($vehiculo)) {
            return $this->sendError('Vehiculo not found');
        }

        $vehiculo->delete();

        return $this->sendResponse($id, 'Vehiculo deleted successfully');
    }
}
