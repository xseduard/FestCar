<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmpresaAPIRequest;
use App\Http\Requests\API\UpdateEmpresaAPIRequest;
use App\Models\Empresa;
use App\Repositories\EmpresaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EmpresaController
 * @package App\Http\Controllers\API
 */

class EmpresaAPIController extends AppBaseController
{
    /** @var  EmpresaRepository */
    private $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepo)
    {
        $this->empresaRepository = $empresaRepo;
    }

    /**
     * Muestra lista del modelo Empresa.
     * GET|HEAD /empresas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->empresaRepository->pushCriteria(new RequestCriteria($request));
        $this->empresaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $empresas = $this->empresaRepository->all();

        return $this->sendResponse($empresas->toArray(), 'Empresas retrieved successfully');
    }

    /**
     * Alamacena el  Empresa registrado.
     * POST /empresas
     *
     * @param CreateEmpresaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmpresaAPIRequest $request)
    {
        $input = $request->all();

        $empresas = $this->empresaRepository->create($input);

        return $this->sendResponse($empresas->toArray(), 'Empresa saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo Empresa.
     * GET|HEAD /empresas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Empresa $empresa */
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            return $this->sendError('Empresa not found');
        }

        return $this->sendResponse($empresa->toArray(), 'Empresa retrieved successfully');
    }

    /**
     * Actualiza el Empresa segun su id.
     * PUT/PATCH /empresas/{id}
     *
     * @param  int $id
     * @param UpdateEmpresaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmpresaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Empresa $empresa */
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            return $this->sendError('Empresa not found');
        }

        $empresa = $this->empresaRepository->update($input, $id);

        return $this->sendResponse($empresa->toArray(), 'Empresa updated successfully');
    }

    /**
     * Elimina el Empresa especificado del almacenamiento.
     * DELETE /empresas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Empresa $empresa */
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            return $this->sendError('Empresa not found');
        }

        $empresa->delete();

        return $this->sendResponse($id, 'Empresa deleted successfully');
    }
}
