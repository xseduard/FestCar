<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMunicipioRequest;
use App\Http\Requests\UpdateMunicipioRequest;
use App\Repositories\MunicipioRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MunicipioController extends AppBaseController
{
    /** @var  MunicipioRepository */
    /** vendor laravel-generator templates xs*/
    private $municipioRepository;
    private $centralRepository;

    public function __construct(MunicipioRepository $municipioRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->municipioRepository = $municipioRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Municipio.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->municipioRepository->pushCriteria(new RequestCriteria($request));
        $municipios = $this->municipioRepository->paginate(15);

        /**
         * $municipios = $this->municipioRepository->all();
         */

        return view('municipios.index')
            ->with('municipios', $municipios);
    }
    /**
     * selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        $selectores['id_departamento'] = $this->centralRepository->id_departamento();
        return $selectores;
    }
    /**
     * Show the form for creating a new Municipio.
     *
     * @return Response
     */
    public function create()
    {
        
        $selectores = $this->selectoresComunes();
       
        return view('municipios.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Municipio in storage.
     *
     * @param CreateMunicipioRequest $request
     *
     * @return Response
     */
    public function store(CreateMunicipioRequest $request)
    {
        $input = $request->all();

        $municipio = $this->municipioRepository->create($input);

        Flash::success('Municipio registrado correctamente.');

        return redirect(route('municipios.index'));
    }

    /**
     * Display the specified Municipio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $municipio = $this->municipioRepository->findWithoutFail($id);

        if (empty($municipio)) {
            Flash::error('Municipio No se encuentra en encuentra registrado.');

            return redirect(route('municipios.index'));
        }

        return view('municipios.show')->with('municipio', $municipio);
    }

    /**
     * Show the form for editing the specified Municipio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $municipio = $this->municipioRepository->findWithoutFail($id);

        if (empty($municipio)) {
            Flash::error('Municipio No se encuentra en encuentra registrado.');

            return redirect(route('municipios.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('municipios.edit')->with(['municipio' => $municipio, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Municipio in storage.
     *
     * @param  int              $id
     * @param UpdateMunicipioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMunicipioRequest $request)
    {
        $municipio = $this->municipioRepository->findWithoutFail($id);

        if (empty($municipio)) {
            Flash::error('Municipio No se encuentra en encuentra registrado.');

            return redirect(route('municipios.index'));
        }

        $municipio = $this->municipioRepository->update($request->all(), $id);

        Flash::success('Municipio actualizado correctamente.');

        return redirect(route('municipios.index'));
    }

    /**
     * Remove the specified Municipio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $municipio = $this->municipioRepository->findWithoutFail($id);

        if (empty($municipio)) {
            Flash::error('Municipio No se encuentra en encuentra registrado.');

            return redirect(route('municipios.index'));
        }

        $this->municipioRepository->delete($id);

        Flash::success('Municipio eliminado correctamente.');

        return redirect(route('municipios.index'));
    }
}
