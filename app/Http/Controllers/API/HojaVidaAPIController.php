<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHojaVidaAPIRequest;
use App\Http\Requests\API\UpdateHojaVidaAPIRequest;
use App\Models\HojaVida;
use App\Repositories\HojaVidaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class HojaVidaController
 * @package App\Http\Controllers\API
 */

class HojaVidaAPIController extends AppBaseController
{
    /** @var  HojaVidaRepository */
    private $hojaVidaRepository;

    public function __construct(HojaVidaRepository $hojaVidaRepo)
    {
        $this->hojaVidaRepository = $hojaVidaRepo;
    }

    /**
     * Muestra lista del modelo HojaVida.
     * GET|HEAD /hojaVidas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hojaVidaRepository->pushCriteria(new RequestCriteria($request));
        $this->hojaVidaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $hojaVidas = $this->hojaVidaRepository->all();

        return $this->sendResponse($hojaVidas->toArray(), 'Hoja Vidas retrieved successfully');
    }

    /**
     * Alamacena el  HojaVida registrado.
     * POST /hojaVidas
     *
     * @param CreateHojaVidaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHojaVidaAPIRequest $request)
    {
        $input = $request->all();

        $hojaVidas = $this->hojaVidaRepository->create($input);

        return $this->sendResponse($hojaVidas->toArray(), 'Hoja Vida saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo HojaVida.
     * GET|HEAD /hojaVidas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HojaVida $hojaVida */
        $hojaVida = $this->hojaVidaRepository->findWithoutFail($id);

        if (empty($hojaVida)) {
            return $this->sendError('Hoja Vida not found');
        }

        return $this->sendResponse($hojaVida->toArray(), 'Hoja Vida retrieved successfully');
    }

    /**
     * Actualiza el HojaVida segun su id.
     * PUT/PATCH /hojaVidas/{id}
     *
     * @param  int $id
     * @param UpdateHojaVidaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHojaVidaAPIRequest $request)
    {
        $input = $request->all();

        /** @var HojaVida $hojaVida */
        $hojaVida = $this->hojaVidaRepository->findWithoutFail($id);

        if (empty($hojaVida)) {
            return $this->sendError('Hoja Vida not found');
        }

        $hojaVida = $this->hojaVidaRepository->update($input, $id);

        return $this->sendResponse($hojaVida->toArray(), 'HojaVida updated successfully');
    }

    /**
     * Elimina el HojaVida especificado del almacenamiento.
     * DELETE /hojaVidas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HojaVida $hojaVida */
        $hojaVida = $this->hojaVidaRepository->findWithoutFail($id);

        if (empty($hojaVida)) {
            return $this->sendError('Hoja Vida not found');
        }

        $hojaVida->delete();

        return $this->sendResponse($id, 'Hoja Vida deleted successfully');
    }
}
