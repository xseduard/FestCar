<?php

namespace App\Http\Controllers;

use App\DataTables\cuadroDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecuadroRequest;
use App\Http\Requests\UpdatecuadroRequest;
use App\Repositories\cuadroRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class cuadroController extends AppBaseController
{
    /** @var  cuadroRepository */
    private $cuadroRepository;

    public function __construct(cuadroRepository $cuadroRepo)
    {
        $this->cuadroRepository = $cuadroRepo;
    }

    /**
     * Display a listing of the cuadro.
     *
     * @param cuadroDataTable $cuadroDataTable
     * @return Response
     */
    public function index(cuadroDataTable $cuadroDataTable)
    {
        return $cuadroDataTable->render('cuadros.index');
    }

    /**
     * Show the form for creating a new cuadro.
     *
     * @return Response
     */
    public function create()
    {
        return view('cuadros.create');
    }

    /**
     * Store a newly created cuadro in storage.
     *
     * @param CreatecuadroRequest $request
     *
     * @return Response
     */
    public function store(CreatecuadroRequest $request)
    {
        $input = $request->all();

        $cuadro = $this->cuadroRepository->create($input);

        Flash::success('Cuadro saved successfully.');

        return redirect(route('cuadros.index'));
    }

    /**
     * Display the specified cuadro.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cuadro = $this->cuadroRepository->findWithoutFail($id);

        if (empty($cuadro)) {
            Flash::error('Cuadro not found');

            return redirect(route('cuadros.index'));
        }

        return view('cuadros.show')->with('cuadro', $cuadro);
    }

    /**
     * Show the form for editing the specified cuadro.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cuadro = $this->cuadroRepository->findWithoutFail($id);

        if (empty($cuadro)) {
            Flash::error('Cuadro not found');

            return redirect(route('cuadros.index'));
        }

        return view('cuadros.edit')->with('cuadro', $cuadro);
    }

    /**
     * Update the specified cuadro in storage.
     *
     * @param  int              $id
     * @param UpdatecuadroRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecuadroRequest $request)
    {
        $cuadro = $this->cuadroRepository->findWithoutFail($id);

        if (empty($cuadro)) {
            Flash::error('Cuadro not found');

            return redirect(route('cuadros.index'));
        }

        $cuadro = $this->cuadroRepository->update($request->all(), $id);

        Flash::success('Cuadro updated successfully.');

        return redirect(route('cuadros.index'));
    }

    /**
     * Remove the specified cuadro from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cuadro = $this->cuadroRepository->findWithoutFail($id);

        if (empty($cuadro)) {
            Flash::error('Cuadro not found');

            return redirect(route('cuadros.index'));
        }

        $this->cuadroRepository->delete($id);

        Flash::success('Cuadro deleted successfully.');

        return redirect(route('cuadros.index'));
    }
}
