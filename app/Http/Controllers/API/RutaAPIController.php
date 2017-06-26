<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRutaAPIRequest;
use App\Http\Requests\API\UpdateRutaAPIRequest;
use App\Models\Ruta;
use App\Repositories\RutaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RutaController
 * @package App\Http\Controllers\API
 */

class RutaAPIController extends AppBaseController
{
    /** @var  RutaRepository */
    private $rutaRepository;

    public function __construct(RutaRepository $rutaRepo)
    {
        $this->rutaRepository = $rutaRepo;
    }

    /**
     * Muestra lista del modelo Ruta.
     * GET|HEAD /rutas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->rutaRepository->pushCriteria(new RequestCriteria($request));
        $this->rutaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $rutas = $this->rutaRepository->all();

        return $this->sendResponse($rutas->toArray(), 'Rutas retrieved successfully');
    }

    /**
     * Alamacena el  Ruta registrado.
     * POST /rutas
     *
     * @param CreateRutaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRutaAPIRequest $request)
    {
        $input = $request->all();

        $rutas = $this->rutaRepository->create($input);

        return $this->sendResponse($rutas->toArray(), 'Ruta saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Ruta.
     * GET|HEAD /rutas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Ruta $ruta */
        $ruta = $this->rutaRepository->findWithoutFail($id);

        if (empty($ruta)) {
            return $this->sendError('Ruta not found');
        }

        return $this->sendResponse($ruta->toArray(), 'Ruta retrieved successfully');
    }

    /**
     * Actualiza el Ruta segun su id.
     * PUT/PATCH /rutas/{id}
     *
     * @param  int $id
     * @param UpdateRutaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRutaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Ruta $ruta */
        $ruta = $this->rutaRepository->findWithoutFail($id);

        if (empty($ruta)) {
            return $this->sendError('Ruta not found');
        }

        $ruta = $this->rutaRepository->update($input, $id);

        return $this->sendResponse($ruta->toArray(), 'Ruta updated successfully');
    }

    /**
     * Elimina el Ruta especificado del almacenamiento.
     * DELETE /rutas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Ruta $ruta */
        $ruta = $this->rutaRepository->findWithoutFail($id);

        if (empty($ruta)) {
            return $this->sendError('Ruta not found');
        }

        $ruta->delete();

        return $this->sendResponse($id, 'Ruta deleted successfully');
    }
}
