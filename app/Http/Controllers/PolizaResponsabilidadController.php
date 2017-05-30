<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePolizaResponsabilidadRequest;
use App\Http\Requests\UpdatePolizaResponsabilidadRequest;
use App\Repositories\PolizaResponsabilidadRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class PolizaResponsabilidadController extends AppBaseController
{
    /** @var  PolizaResponsabilidadRepository */
    private $polizaResponsabilidadRepository;
    private $centralRepository;

    public function __construct(PolizaResponsabilidadRepository $polizaResponsabilidadRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->polizaResponsabilidadRepository = $polizaResponsabilidadRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the PolizaResponsabilidad.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->polizaResponsabilidadRepository->pushCriteria(new RequestCriteria($request));
        $polizaResponsabilidads = $this->polizaResponsabilidadRepository->paginate(15);
        $fecha_actual = \Carbon\Carbon::now();

        /**
         * $polizaResponsabilidads = $this->polizaResponsabilidadRepository->all();
         */

        return view('poliza_responsabilidads.index')
            ->with(['polizaResponsabilidads' => $polizaResponsabilidads, 'fecha_actual' => $fecha_actual]);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['vehiculo_id'] = $this->centralRepository->vehiculo_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new PolizaResponsabilidad.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('poliza_responsabilidads.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created PolizaResponsabilidad in storage.
     *
     * @param CreatePolizaResponsabilidadRequest $request
     *
     * @return Response
     */
    public function store(CreatePolizaResponsabilidadRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $polizaResponsabilidad = $this->polizaResponsabilidadRepository->create($input);

        Flash::success('Poliza de Responsabilidad registrada correctamente.');

        return redirect(route('polizaResponsabilidads.index'));
    }

    /**
     * Display the specified PolizaResponsabilidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $polizaResponsabilidad = $this->polizaResponsabilidadRepository->findWithoutFail($id);

        if (empty($polizaResponsabilidad)) {
            Flash::error('Poliza de Responsabilidad No se encuentra registrada.');

            return redirect(route('polizaResponsabilidads.index'));
        }

        return view('poliza_responsabilidads.show')->with('polizaResponsabilidad', $polizaResponsabilidad);
    }

    /**
     * Show the form for editing the specified PolizaResponsabilidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $polizaResponsabilidad = $this->polizaResponsabilidadRepository->findWithoutFail($id);

        if (empty($polizaResponsabilidad)) {
            Flash::error('Poliza de Responsabilidad No se encuentra registrada.');

            return redirect(route('polizaResponsabilidads.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('poliza_responsabilidads.edit')->with(['polizaResponsabilidad' => $polizaResponsabilidad, 'selectores' => $selectores]);
    }

    /**
     * Update the specified PolizaResponsabilidad in storage.
     *
     * @param  int              $id
     * @param UpdatePolizaResponsabilidadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePolizaResponsabilidadRequest $request)
    {
        $polizaResponsabilidad = $this->polizaResponsabilidadRepository->findWithoutFail($id);

        if (empty($polizaResponsabilidad)) {
            Flash::error('Poliza de Responsabilidad No se encuentra registrada.');

            return redirect(route('polizaResponsabilidads.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $polizaResponsabilidad = $this->polizaResponsabilidadRepository->update($input, $id);

        Flash::success('Poliza de Responsabilidad actualizada correctamente.');

        return redirect(route('polizaResponsabilidads.index'));
    }

    /**
     * Remove the specified PolizaResponsabilidad from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $polizaResponsabilidad = $this->polizaResponsabilidadRepository->findWithoutFail($id);

        if (empty($polizaResponsabilidad)) {
            Flash::error('Poliza de Responsabilidad No se encuentra registrada.');

            return redirect(route('polizaResponsabilidads.index'));
        }

        $this->polizaResponsabilidadRepository->delete($id);

        Flash::success('Poliza de Responsabilidad eliminada correctamente.');

        return redirect(route('polizaResponsabilidads.index'));
    }
}
