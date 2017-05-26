<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetrianguloAPIRequest;
use App\Http\Requests\API\UpdatetrianguloAPIRequest;
use App\Models\triangulo;
use App\Repositories\trianguloRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class trianguloController
 * @package App\Http\Controllers\API
 */

class trianguloAPIController extends AppBaseController
{
    /** @var  trianguloRepository */
    private $trianguloRepository;

    public function __construct(trianguloRepository $trianguloRepo)
    {
        $this->trianguloRepository = $trianguloRepo;
    }

    /**
     * Display a listing of the triangulo.
     * GET|HEAD /triangulos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->trianguloRepository->pushCriteria(new RequestCriteria($request));
        $this->trianguloRepository->pushCriteria(new LimitOffsetCriteria($request));
        $triangulos = $this->trianguloRepository->all();

        return $this->sendResponse($triangulos->toArray(), 'Triangulos retrieved successfully');
    }

    /**
     * Store a newly created triangulo in storage.
     * POST /triangulos
     *
     * @param CreatetrianguloAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatetrianguloAPIRequest $request)
    {
        $input = $request->all();

        $triangulos = $this->trianguloRepository->create($input);

        return $this->sendResponse($triangulos->toArray(), 'Triangulo saved successfully');
    }

    /**
     * Display the specified triangulo.
     * GET|HEAD /triangulos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var triangulo $triangulo */
        $triangulo = $this->trianguloRepository->findWithoutFail($id);

        if (empty($triangulo)) {
            return $this->sendError('Triangulo not found');
        }

        return $this->sendResponse($triangulo->toArray(), 'Triangulo retrieved successfully');
    }

    /**
     * Update the specified triangulo in storage.
     * PUT/PATCH /triangulos/{id}
     *
     * @param  int $id
     * @param UpdatetrianguloAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetrianguloAPIRequest $request)
    {
        $input = $request->all();

        /** @var triangulo $triangulo */
        $triangulo = $this->trianguloRepository->findWithoutFail($id);

        if (empty($triangulo)) {
            return $this->sendError('Triangulo not found');
        }

        $triangulo = $this->trianguloRepository->update($input, $id);

        return $this->sendResponse($triangulo->toArray(), 'triangulo updated successfully');
    }

    /**
     * Remove the specified triangulo from storage.
     * DELETE /triangulos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var triangulo $triangulo */
        $triangulo = $this->trianguloRepository->findWithoutFail($id);

        if (empty($triangulo)) {
            return $this->sendError('Triangulo not found');
        }

        $triangulo->delete();

        return $this->sendResponse($id, 'Triangulo deleted successfully');
    }
}
