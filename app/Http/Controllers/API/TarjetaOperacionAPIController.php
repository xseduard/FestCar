<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTarjetaOperacionAPIRequest;
use App\Http\Requests\API\UpdateTarjetaOperacionAPIRequest;
use App\Models\TarjetaOperacion;
use App\Repositories\TarjetaOperacionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TarjetaOperacionController
 * @package App\Http\Controllers\API
 */

class TarjetaOperacionAPIController extends AppBaseController
{
    /** @var  TarjetaOperacionRepository */
    private $tarjetaOperacionRepository;

    public function __construct(TarjetaOperacionRepository $tarjetaOperacionRepo)
    {
        $this->tarjetaOperacionRepository = $tarjetaOperacionRepo;
    }

    /**
     * Muestra lista del modelo TarjetaOperacion.
     * GET|HEAD /tarjetaOperacions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tarjetaOperacionRepository->pushCriteria(new RequestCriteria($request));
        $this->tarjetaOperacionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tarjetaOperacions = $this->tarjetaOperacionRepository->all();

        return $this->sendResponse($tarjetaOperacions->toArray(), 'Tarjeta Operacions retrieved successfully');
    }

    /**
     * Alamacena el  TarjetaOperacion registrado.
     * POST /tarjetaOperacions
     *
     * @param CreateTarjetaOperacionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTarjetaOperacionAPIRequest $request)
    {
        $input = $request->all();

        $tarjetaOperacions = $this->tarjetaOperacionRepository->create($input);

        return $this->sendResponse($tarjetaOperacions->toArray(), 'Tarjeta Operacion saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo TarjetaOperacion.
     * GET|HEAD /tarjetaOperacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TarjetaOperacion $tarjetaOperacion */
        $tarjetaOperacion = $this->tarjetaOperacionRepository->findWithoutFail($id);

        if (empty($tarjetaOperacion)) {
            return $this->sendError('Tarjeta Operacion not found');
        }

        return $this->sendResponse($tarjetaOperacion->toArray(), 'Tarjeta Operacion retrieved successfully');
    }

    /**
     * Actualiza el TarjetaOperacion segun su id.
     * PUT/PATCH /tarjetaOperacions/{id}
     *
     * @param  int $id
     * @param UpdateTarjetaOperacionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTarjetaOperacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var TarjetaOperacion $tarjetaOperacion */
        $tarjetaOperacion = $this->tarjetaOperacionRepository->findWithoutFail($id);

        if (empty($tarjetaOperacion)) {
            return $this->sendError('Tarjeta Operacion not found');
        }

        $tarjetaOperacion = $this->tarjetaOperacionRepository->update($input, $id);

        return $this->sendResponse($tarjetaOperacion->toArray(), 'TarjetaOperacion updated successfully');
    }

    /**
     * Elimina el TarjetaOperacion especificado del almacenamiento.
     * DELETE /tarjetaOperacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TarjetaOperacion $tarjetaOperacion */
        $tarjetaOperacion = $this->tarjetaOperacionRepository->findWithoutFail($id);

        if (empty($tarjetaOperacion)) {
            return $this->sendError('Tarjeta Operacion not found');
        }

        $tarjetaOperacion->delete();

        return $this->sendResponse($id, 'Tarjeta Operacion deleted successfully');
    }
}
