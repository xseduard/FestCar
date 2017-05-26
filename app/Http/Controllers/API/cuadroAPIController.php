<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecuadroAPIRequest;
use App\Http\Requests\API\UpdatecuadroAPIRequest;
use App\Models\cuadro;
use App\Repositories\cuadroRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class cuadroController
 * @package App\Http\Controllers\API
 */

class cuadroAPIController extends AppBaseController
{
    /** @var  cuadroRepository */
    private $cuadroRepository;

    public function __construct(cuadroRepository $cuadroRepo)
    {
        $this->cuadroRepository = $cuadroRepo;
    }

    /**
     * Display a listing of the cuadro.
     * GET|HEAD /cuadros
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->cuadroRepository->pushCriteria(new RequestCriteria($request));
        $this->cuadroRepository->pushCriteria(new LimitOffsetCriteria($request));
        $cuadros = $this->cuadroRepository->all();

        return $this->sendResponse($cuadros->toArray(), 'Cuadros retrieved successfully');
    }

    /**
     * Store a newly created cuadro in storage.
     * POST /cuadros
     *
     * @param CreatecuadroAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecuadroAPIRequest $request)
    {
        $input = $request->all();

        $cuadros = $this->cuadroRepository->create($input);

        return $this->sendResponse($cuadros->toArray(), 'Cuadro saved successfully');
    }

    /**
     * Display the specified cuadro.
     * GET|HEAD /cuadros/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var cuadro $cuadro */
        $cuadro = $this->cuadroRepository->findWithoutFail($id);

        if (empty($cuadro)) {
            return $this->sendError('Cuadro not found');
        }

        return $this->sendResponse($cuadro->toArray(), 'Cuadro retrieved successfully');
    }

    /**
     * Update the specified cuadro in storage.
     * PUT/PATCH /cuadros/{id}
     *
     * @param  int $id
     * @param UpdatecuadroAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecuadroAPIRequest $request)
    {
        $input = $request->all();

        /** @var cuadro $cuadro */
        $cuadro = $this->cuadroRepository->findWithoutFail($id);

        if (empty($cuadro)) {
            return $this->sendError('Cuadro not found');
        }

        $cuadro = $this->cuadroRepository->update($input, $id);

        return $this->sendResponse($cuadro->toArray(), 'cuadro updated successfully');
    }

    /**
     * Remove the specified cuadro from storage.
     * DELETE /cuadros/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var cuadro $cuadro */
        $cuadro = $this->cuadroRepository->findWithoutFail($id);

        if (empty($cuadro)) {
            return $this->sendError('Cuadro not found');
        }

        $cuadro->delete();

        return $this->sendResponse($id, 'Cuadro deleted successfully');
    }
}
