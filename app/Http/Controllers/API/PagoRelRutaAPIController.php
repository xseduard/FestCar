<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePagoRelRutaAPIRequest;
use App\Http\Requests\API\UpdatePagoRelRutaAPIRequest;
use App\Models\PagoRelRuta;
use App\Repositories\PagoRelRutaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PagoRelRutaController
 * @package App\Http\Controllers\API
 */

class PagoRelRutaAPIController extends AppBaseController
{
    /** @var  PagoRelRutaRepository */
    private $pagoRelRutaRepository;

    public function __construct(PagoRelRutaRepository $pagoRelRutaRepo)
    {
        $this->pagoRelRutaRepository = $pagoRelRutaRepo;
    }

    /**
     * Muestra lista del modelo PagoRelRuta.
     * GET|HEAD /pagoRelRutas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pagoRelRutaRepository->pushCriteria(new RequestCriteria($request));
        $this->pagoRelRutaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pagoRelRutas = $this->pagoRelRutaRepository->all();

        return $this->sendResponse($pagoRelRutas->toArray(), 'Pago Rel Rutas retrieved successfully');
    }

    /**
     * Alamacena el  PagoRelRuta registrado.
     * POST /pagoRelRutas
     *
     * @param CreatePagoRelRutaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoRelRutaAPIRequest $request)
    {
        $input = $request->all();

        $pagoRelRutas = $this->pagoRelRutaRepository->create($input);

        return $this->sendResponse($pagoRelRutas->toArray(), 'Pago Rel Ruta saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo PagoRelRuta.
     * GET|HEAD /pagoRelRutas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PagoRelRuta $pagoRelRuta */
        $pagoRelRuta = $this->pagoRelRutaRepository->findWithoutFail($id);

        if (empty($pagoRelRuta)) {
            return $this->sendError('Pago Rel Ruta not found');
        }

        return $this->sendResponse($pagoRelRuta->toArray(), 'Pago Rel Ruta retrieved successfully');
    }

    /**
     * Actualiza el PagoRelRuta segun su id.
     * PUT/PATCH /pagoRelRutas/{id}
     *
     * @param  int $id
     * @param UpdatePagoRelRutaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoRelRutaAPIRequest $request)
    {
        $input = $request->all();

        /** @var PagoRelRuta $pagoRelRuta */
        $pagoRelRuta = $this->pagoRelRutaRepository->findWithoutFail($id);

        if (empty($pagoRelRuta)) {
            return $this->sendError('Pago Rel Ruta not found');
        }

        $pagoRelRuta = $this->pagoRelRutaRepository->update($input, $id);

        return $this->sendResponse($pagoRelRuta->toArray(), 'PagoRelRuta updated successfully');
    }

    /**
     * Elimina el PagoRelRuta especificado del almacenamiento.
     * DELETE /pagoRelRutas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PagoRelRuta $pagoRelRuta */
        $pagoRelRuta = $this->pagoRelRutaRepository->findWithoutFail($id);

        if (empty($pagoRelRuta)) {
            return $this->sendError('Pago Rel Ruta not found');
        }

        $pagoRelRuta->delete();

        return $this->sendResponse($id, 'Pago Rel Ruta deleted successfully');
    }
}
