<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSimuladorGastoAPIRequest;
use App\Http\Requests\API\UpdateSimuladorGastoAPIRequest;
use App\Models\SimuladorGasto;
use App\Repositories\SimuladorGastoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SimuladorGastoController
 * @package App\Http\Controllers\API
 */

class SimuladorGastoAPIController extends AppBaseController
{
    /** @var  SimuladorGastoRepository */
    private $simuladorGastoRepository;

    public function __construct(SimuladorGastoRepository $simuladorGastoRepo)
    {
        $this->simuladorGastoRepository = $simuladorGastoRepo;
    }

    /**
     * Muestra lista del modelo SimuladorGasto.
     * GET|HEAD /simuladorGastos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->simuladorGastoRepository->pushCriteria(new RequestCriteria($request));
        $this->simuladorGastoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $simuladorGastos = $this->simuladorGastoRepository->all();

        return $this->sendResponse($simuladorGastos->toArray(), 'Simulador Gastos retrieved successfully');
    }

    /**
     * Alamacena el  SimuladorGasto registrado.
     * POST /simuladorGastos
     *
     * @param CreateSimuladorGastoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSimuladorGastoAPIRequest $request)
    {
        $input = $request->all();

        $simuladorGastos = $this->simuladorGastoRepository->create($input);

        return $this->sendResponse($simuladorGastos->toArray(), 'Simulador Gasto saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo SimuladorGasto.
     * GET|HEAD /simuladorGastos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SimuladorGasto $simuladorGasto */
        $simuladorGasto = $this->simuladorGastoRepository->findWithoutFail($id);

        if (empty($simuladorGasto)) {
            return $this->sendError('Simulador Gasto not found');
        }

        return $this->sendResponse($simuladorGasto->toArray(), 'Simulador Gasto retrieved successfully');
    }

    /**
     * Actualiza el SimuladorGasto segun su id.
     * PUT/PATCH /simuladorGastos/{id}
     *
     * @param  int $id
     * @param UpdateSimuladorGastoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSimuladorGastoAPIRequest $request)
    {
        $input = $request->all();

        /** @var SimuladorGasto $simuladorGasto */
        $simuladorGasto = $this->simuladorGastoRepository->findWithoutFail($id);

        if (empty($simuladorGasto)) {
            return $this->sendError('Simulador Gasto not found');
        }

        $simuladorGasto = $this->simuladorGastoRepository->update($input, $id);

        return $this->sendResponse($simuladorGasto->toArray(), 'SimuladorGasto updated successfully');
    }

    /**
     * Elimina el SimuladorGasto especificado del almacenamiento.
     * DELETE /simuladorGastos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SimuladorGasto $simuladorGasto */
        $simuladorGasto = $this->simuladorGastoRepository->findWithoutFail($id);

        if (empty($simuladorGasto)) {
            return $this->sendError('Simulador Gasto not found');
        }

        $simuladorGasto->delete();

        return $this->sendResponse($id, 'Simulador Gasto deleted successfully');
    }
}
