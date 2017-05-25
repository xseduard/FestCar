<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePruebaunoAPIRequest;
use App\Http\Requests\API\UpdatePruebaunoAPIRequest;
use App\Models\Pruebauno;
use App\Repositories\PruebaunoRepository;
use Illuminate\Http\Request;
use InfyOm\Generator\Controller\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PruebaunoController
 * @package App\Http\Controllers\API
 */

class PruebaunoAPIController extends AppBaseController
{
    /** @var  PruebaunoRepository */
    private $pruebaunoRepository;

    function __construct(PruebaunoRepository $pruebaunoRepo)
    {
        $this->pruebaunoRepository = $pruebaunoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/pruebaunos",
     *      summary="Get a listing of the Pruebaunos.",
     *      tags={"Pruebauno"},
     *      description="Get all Pruebaunos",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Pruebauno")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->pruebaunoRepository->pushCriteria(new RequestCriteria($request));
        $this->pruebaunoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pruebaunos = $this->pruebaunoRepository->all();

        return $this->sendResponse($pruebaunos->toArray(), "Pruebaunos retrieved successfully");
    }

    /**
     * @param CreatePruebaunoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/pruebaunos",
     *      summary="Store a newly created Pruebauno in storage",
     *      tags={"Pruebauno"},
     *      description="Store Pruebauno",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Pruebauno that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Pruebauno")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Pruebauno"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePruebaunoAPIRequest $request)
    {
        $input = $request->all();

        $pruebaunos = $this->pruebaunoRepository->create($input);

        return $this->sendResponse($pruebaunos->toArray(), "Pruebauno saved successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/pruebaunos/{id}",
     *      summary="Display the specified Pruebauno",
     *      tags={"Pruebauno"},
     *      description="Get Pruebauno",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pruebauno",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Pruebauno"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Pruebauno $pruebauno */
        $pruebauno = $this->pruebaunoRepository->find($id);

        if(empty($pruebauno)) {
            return Response::json(ResponseUtil::makeError("Pruebauno not found"), 400);
        }

        return $this->sendResponse($pruebauno->toArray(), "Pruebauno retrieved successfully");
    }

    /**
     * @param int $id
     * @param UpdatePruebaunoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/pruebaunos/{id}",
     *      summary="Update the specified Pruebauno in storage",
     *      tags={"Pruebauno"},
     *      description="Update Pruebauno",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pruebauno",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Pruebauno that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Pruebauno")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Pruebauno"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePruebaunoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pruebauno $pruebauno */
        $pruebauno = $this->pruebaunoRepository->find($id);

        if (empty($pruebauno)) {
            return Response::json(ResponseUtil::makeError("Pruebauno not found"), 400);
        }

        $pruebauno = $this->pruebaunoRepository->update($input, $id);

        return $this->sendResponse($pruebauno->toArray(), "Pruebauno updated successfully");
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/pruebaunos/{id}",
     *      summary="Remove the specified Pruebauno from storage",
     *      tags={"Pruebauno"},
     *      description="Delete Pruebauno",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Pruebauno",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Pruebauno $pruebauno */
        $pruebauno = $this->pruebaunoRepository->find($id);

        if(empty($pruebauno)) {
            return Response::json(ResponseUtil::makeError("Pruebauno not found"), 400);
        }

        $pruebauno->delete();

        return $this->sendResponse($id, "Pruebauno deleted successfully");
    }
}
