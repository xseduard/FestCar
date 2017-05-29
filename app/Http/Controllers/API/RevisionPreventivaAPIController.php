<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRevisionPreventivaAPIRequest;
use App\Http\Requests\API\UpdateRevisionPreventivaAPIRequest;
use App\Models\RevisionPreventiva;
use App\Repositories\RevisionPreventivaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RevisionPreventivaController
 * @package App\Http\Controllers\API
 */

class RevisionPreventivaAPIController extends AppBaseController
{
    /** @var  RevisionPreventivaRepository */
    private $revisionPreventivaRepository;

    public function __construct(RevisionPreventivaRepository $revisionPreventivaRepo)
    {
        $this->revisionPreventivaRepository = $revisionPreventivaRepo;
    }

    /**
     * Muestra lista del modelo RevisionPreventiva.
     * GET|HEAD /revisionPreventivas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->revisionPreventivaRepository->pushCriteria(new RequestCriteria($request));
        $this->revisionPreventivaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $revisionPreventivas = $this->revisionPreventivaRepository->all();

        return $this->sendResponse($revisionPreventivas->toArray(), 'Revision Preventivas retrieved successfully');
    }

    /**
     * Alamacena el  RevisionPreventiva registrado.
     * POST /revisionPreventivas
     *
     * @param CreateRevisionPreventivaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRevisionPreventivaAPIRequest $request)
    {
        $input = $request->all();

        $revisionPreventivas = $this->revisionPreventivaRepository->create($input);

        return $this->sendResponse($revisionPreventivas->toArray(), 'Revision Preventiva saved successfully');
    }

    /**
     * Muestra de forma detallada el modelo RevisionPreventiva.
     * GET|HEAD /revisionPreventivas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RevisionPreventiva $revisionPreventiva */
        $revisionPreventiva = $this->revisionPreventivaRepository->findWithoutFail($id);

        if (empty($revisionPreventiva)) {
            return $this->sendError('Revision Preventiva not found');
        }

        return $this->sendResponse($revisionPreventiva->toArray(), 'Revision Preventiva retrieved successfully');
    }

    /**
     * Actualiza el RevisionPreventiva segun su id.
     * PUT/PATCH /revisionPreventivas/{id}
     *
     * @param  int $id
     * @param UpdateRevisionPreventivaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRevisionPreventivaAPIRequest $request)
    {
        $input = $request->all();

        /** @var RevisionPreventiva $revisionPreventiva */
        $revisionPreventiva = $this->revisionPreventivaRepository->findWithoutFail($id);

        if (empty($revisionPreventiva)) {
            return $this->sendError('Revision Preventiva not found');
        }

        $revisionPreventiva = $this->revisionPreventivaRepository->update($input, $id);

        return $this->sendResponse($revisionPreventiva->toArray(), 'RevisionPreventiva updated successfully');
    }

    /**
     * Elimina el RevisionPreventiva especificado del almacenamiento.
     * DELETE /revisionPreventivas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RevisionPreventiva $revisionPreventiva */
        $revisionPreventiva = $this->revisionPreventivaRepository->findWithoutFail($id);

        if (empty($revisionPreventiva)) {
            return $this->sendError('Revision Preventiva not found');
        }

        $revisionPreventiva->delete();

        return $this->sendResponse($id, 'Revision Preventiva deleted successfully');
    }
}
