<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetrianguloRequest;
use App\Http\Requests\UpdatetrianguloRequest;
use App\Repositories\trianguloRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class trianguloController extends AppBaseController
{
    /** @var  trianguloRepository */
    /** vendor laravel-generator templates xs*/
    private $trianguloRepository;

    public function __construct(trianguloRepository $trianguloRepo)
    {
        $this->trianguloRepository = $trianguloRepo;
    }

    /**
     * Display a listing of the triangulo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->trianguloRepository->pushCriteria(new RequestCriteria($request));
        $triangulos = $this->trianguloRepository->all();

        return view('triangulos.index')
            ->with('triangulos', $triangulos);
    }

    /**
     * Show the form for creating a new triangulo.
     *
     * @return Response
     */
    public function create()
    {
        return view('triangulos.create');
    }

    /**
     * Store a newly created triangulo in storage.
     *
     * @param CreatetrianguloRequest $request
     *
     * @return Response
     */
    public function store(CreatetrianguloRequest $request)
    {
        $input = $request->all();

        $triangulo = $this->trianguloRepository->create($input);

        Flash::success('Triangulo saved successfully.');

        return redirect(route('triangulos.index'));
    }

    /**
     * Display the specified triangulo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $triangulo = $this->trianguloRepository->findWithoutFail($id);

        if (empty($triangulo)) {
            Flash::error('Triangulo not found');

            return redirect(route('triangulos.index'));
        }

        return view('triangulos.show')->with('triangulo', $triangulo);
    }

    /**
     * Show the form for editing the specified triangulo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $triangulo = $this->trianguloRepository->findWithoutFail($id);

        if (empty($triangulo)) {
            Flash::error('Triangulo not found');

            return redirect(route('triangulos.index'));
        }

        return view('triangulos.edit')->with('triangulo', $triangulo);
    }

    /**
     * Update the specified triangulo in storage.
     *
     * @param  int              $id
     * @param UpdatetrianguloRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetrianguloRequest $request)
    {
        $triangulo = $this->trianguloRepository->findWithoutFail($id);

        if (empty($triangulo)) {
            Flash::error('Triangulo not found');

            return redirect(route('triangulos.index'));
        }

        $triangulo = $this->trianguloRepository->update($request->all(), $id);

        Flash::success('Triangulo updated successfully.');

        return redirect(route('triangulos.index'));
    }

    /**
     * Remove the specified triangulo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $triangulo = $this->trianguloRepository->findWithoutFail($id);

        if (empty($triangulo)) {
            Flash::error('Triangulo not found');

            return redirect(route('triangulos.index'));
        }

        $this->trianguloRepository->delete($id);

        Flash::success('Triangulo deleted successfully.');

        return redirect(route('triangulos.index'));
    }
}
