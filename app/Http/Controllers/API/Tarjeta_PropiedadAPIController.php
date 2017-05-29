<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTarjeta_PropiedadAPIRequest;
use App\Http\Requests\API\UpdateTarjeta_PropiedadAPIRequest;
use App\Models\Tarjeta_Propiedad;
use App\Repositories\Tarjeta_PropiedadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class Tarjeta_PropiedadController
 * @package App\Http\Controllers\API
 */

class Tarjeta_PropiedadAPIController extends AppBaseController
{
    /** @var  Tarjeta_PropiedadRepository */
    private $tarjetaPropiedadRepository;

    public function __construct(Tarjeta_PropiedadRepository $tarjetaPropiedadRepo)
    {
        $this->tarjetaPropiedadRepository = $tarjetaPropiedadRepo;
    }

    /**
     * Muestra lista del modelo Tarjeta_Propiedad.
     * GET|HEAD /tarjetaPropiedads
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tarjetaPropiedadRepository->pushCriteria(new RequestCriteria($request));
        $this->tarjetaPropiedadRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tarjetaPropiedads = $this->tarjetaPropiedadRepository->all();

        return $this->sendResponse($tarjetaPropiedads->toArray(), 'Tarjeta  Propiedads retrieved successfully');
    }

    /**
     * Alamacena el  Tarjeta_Propiedad registrado.
     * POST /tarjetaPropiedads
     *
     * @param CreateTarjeta_PropiedadAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTarjeta_PropiedadAPIRequest $request)
    {
        $input = $request->all();

        $tarjetaPropiedads = $this->tarjetaPropiedadRepository->create($input);

        return $this->sendResponse($tarjetaPropiedads->toArray(), 'Tarjeta  Propiedad saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Tarjeta_Propiedad.
     * GET|HEAD /tarjetaPropiedads/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Tarjeta_Propiedad $tarjetaPropiedad */
        $tarjetaPropiedad = $this->tarjetaPropiedadRepository->findWithoutFail($id);

        if (empty($tarjetaPropiedad)) {
            return $this->sendError('Tarjeta  Propiedad not found');
        }

        return $this->sendResponse($tarjetaPropiedad->toArray(), 'Tarjeta  Propiedad retrieved successfully');
    }

    /**
     * Actualiza el Tarjeta_Propiedad segun su id.
     * PUT/PATCH /tarjetaPropiedads/{id}
     *
     * @param  int $id
     * @param UpdateTarjeta_PropiedadAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTarjeta_PropiedadAPIRequest $request)
    {
        $input = $request->all();

        /** @var Tarjeta_Propiedad $tarjetaPropiedad */
        $tarjetaPropiedad = $this->tarjetaPropiedadRepository->findWithoutFail($id);

        if (empty($tarjetaPropiedad)) {
            return $this->sendError('Tarjeta  Propiedad not found');
        }

        $tarjetaPropiedad = $this->tarjetaPropiedadRepository->update($input, $id);

        return $this->sendResponse($tarjetaPropiedad->toArray(), 'Tarjeta_Propiedad updated successfully');
    }

    /**
     * Elimina el Tarjeta_Propiedad especificado del almacenamiento.
     * DELETE /tarjetaPropiedads/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Tarjeta_Propiedad $tarjetaPropiedad */
        $tarjetaPropiedad = $this->tarjetaPropiedadRepository->findWithoutFail($id);

        if (empty($tarjetaPropiedad)) {
            return $this->sendError('Tarjeta  Propiedad not found');
        }

        $tarjetaPropiedad->delete();

        return $this->sendResponse($id, 'Tarjeta  Propiedad deleted successfully');
    }
}
