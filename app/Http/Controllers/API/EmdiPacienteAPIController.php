<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmdiPacienteAPIRequest;
use App\Http\Requests\API\UpdateEmdiPacienteAPIRequest;
use App\Models\EmdiPaciente;
use App\Repositories\EmdiPacienteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EmdiPacienteController
 * @package App\Http\Controllers\API
 */

class EmdiPacienteAPIController extends AppBaseController
{
    /** @var  EmdiPacienteRepository */
    private $emdiPacienteRepository;

    public function __construct(EmdiPacienteRepository $emdiPacienteRepo)
    {
        $this->emdiPacienteRepository = $emdiPacienteRepo;
    }

    /**
     * Muestra lista del modelo EmdiPaciente.
     * GET|HEAD /emdiPacientes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->emdiPacienteRepository->pushCriteria(new RequestCriteria($request));
        $this->emdiPacienteRepository->pushCriteria(new LimitOffsetCriteria($request));
        $emdiPacientes = $this->emdiPacienteRepository->all();

        return $this->sendResponse($emdiPacientes->toArray(), 'Emdi Pacientes retrieved successfully');
    }

    /**
     * Alamacena el  EmdiPaciente registrado.
     * POST /emdiPacientes
     *
     * @param CreateEmdiPacienteAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmdiPacienteAPIRequest $request)
    {
        $input = $request->all();

        $emdiPacientes = $this->emdiPacienteRepository->create($input);

        return $this->sendResponse($emdiPacientes->toArray(), 'Emdi Paciente saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo EmdiPaciente.
     * GET|HEAD /emdiPacientes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EmdiPaciente $emdiPaciente */
        $emdiPaciente = $this->emdiPacienteRepository->findWithoutFail($id);

        if (empty($emdiPaciente)) {
            return $this->sendError('Emdi Paciente not found');
        }

        return $this->sendResponse($emdiPaciente->toArray(), 'Emdi Paciente retrieved successfully');
    }

    /**
     * Actualiza el EmdiPaciente segun su id.
     * PUT/PATCH /emdiPacientes/{id}
     *
     * @param  int $id
     * @param UpdateEmdiPacienteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmdiPacienteAPIRequest $request)
    {
        $input = $request->all();

        /** @var EmdiPaciente $emdiPaciente */
        $emdiPaciente = $this->emdiPacienteRepository->findWithoutFail($id);

        if (empty($emdiPaciente)) {
            return $this->sendError('Emdi Paciente not found');
        }

        $emdiPaciente = $this->emdiPacienteRepository->update($input, $id);

        return $this->sendResponse($emdiPaciente->toArray(), 'EmdiPaciente updated successfully');
    }

    /**
     * Elimina el EmdiPaciente especificado del almacenamiento.
     * DELETE /emdiPacientes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EmdiPaciente $emdiPaciente */
        $emdiPaciente = $this->emdiPacienteRepository->findWithoutFail($id);

        if (empty($emdiPaciente)) {
            return $this->sendError('Emdi Paciente not found');
        }

        $emdiPaciente->delete();

        return $this->sendResponse($id, 'Emdi Paciente deleted successfully');
    }
}
