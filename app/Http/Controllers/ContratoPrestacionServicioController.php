<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContratoPrestacionServicioRequest;
use App\Http\Requests\UpdateContratoPrestacionServicioRequest;
use App\Repositories\ContratoPrestacionServicioRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;
use Carbon\Carbon;

class ContratoPrestacionServicioController extends AppBaseController
{
    /** @var  ContratoPrestacionServicioRepository */
    private $contratoPrestacionServicioRepository;
    private $centralRepository;

    public function __construct(ContratoPrestacionServicioRepository $contratoPrestacionServicioRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->contratoPrestacionServicioRepository = $contratoPrestacionServicioRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the ContratoPrestacionServicio.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contratoPrestacionServicioRepository->pushCriteria(new RequestCriteria($request));
        $contratoPrestacionServicios = $this->contratoPrestacionServicioRepository->paginate(15);

        /**
         * $contratoPrestacionServicios = $this->contratoPrestacionServicioRepository->all();
         */

        return view('contrato_prestacion_servicios.index')
            ->with('contratoPrestacionServicios', $contratoPrestacionServicios);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['municipio_id'] = $this->centralRepository->municipio_id();
        $selectores['natural_id'] = $this->centralRepository->natural_id();
        $selectores['juridico_id'] = $this->centralRepository->juridico_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new ContratoPrestacionServicio.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('contrato_prestacion_servicios.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created ContratoPrestacionServicio in storage.
     *
     * @param CreateContratoPrestacionServicioRequest $request
     *
     * @return Response
     */
    public function store(CreateContratoPrestacionServicioRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
    
        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->create($input);

        Flash::success('Contrato Prestacion Servicio registrado correctamente.');

        return redirect(route('contratoPrestacionServicios.index'));
    }

    /**
     * Display the specified ContratoPrestacionServicio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->findWithoutFail($id);

        if (empty($contratoPrestacionServicio)) {
            Flash::error('Contrato Prestacion Servicio No se encuentra registrado.');

            return redirect(route('contratoPrestacionServicios.index'));
        }

        return view('contrato_prestacion_servicios.show')->with('contratoPrestacionServicio', $contratoPrestacionServicio);
    }

    /**
     * Show the form for editing the specified ContratoPrestacionServicio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->findWithoutFail($id);

        if (empty($contratoPrestacionServicio)) {
            Flash::error('Contrato Prestacion Servicio No se encuentra registrado.');

            return redirect(route('contratoPrestacionServicios.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('contrato_prestacion_servicios.edit')->with(['contratoPrestacionServicio' => $contratoPrestacionServicio, 'selectores' => $selectores]);
    }

    /**
     * Update the specified ContratoPrestacionServicio in storage.
     *
     * @param  int              $id
     * @param UpdateContratoPrestacionServicioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContratoPrestacionServicioRequest $request)
    {
        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->findWithoutFail($id);

        if (empty($contratoPrestacionServicio)) {
            Flash::error('Contrato Prestacion Servicio No se encuentra registrado.');

            return redirect(route('contratoPrestacionServicios.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();


        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->update($input, $id);

        Flash::success('Contrato Prestacion Servicio actualizado correctamente.');

        return redirect(route('contratoPrestacionServicios.index'));
    }

    /**
     * Remove the specified ContratoPrestacionServicio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->findWithoutFail($id);

        if (empty($contratoPrestacionServicio)) {
            Flash::error('Contrato Prestacion Servicio No se encuentra registrado.');

            return redirect(route('contratoPrestacionServicios.index'));
        }

        $this->contratoPrestacionServicioRepository->delete($id);

        Flash::success('Contrato Prestacion Servicio eliminado correctamente.');

        return redirect(route('contratoPrestacionServicios.index'));
    }
     public function print_space($id)
    {
        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->findWithoutFail($id);

        if (empty($contratoPrestacionServicio)) {
            Flash::error('Contrato prestación de servicios No se encuentra registrado.');

            return redirect(route('contratoPrestacionServicios.index'));
        }
       
       $this->contratoPrestacionServicioRepository->print_contratos($id);
        
    }

     public function aprobar($id)
    {
        $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->findWithoutFail($id);

        if (empty($contratoPrestacionServicio)) {
            Flash::error('Contrato de prestación de servicios No se encuentra registrado.');

            return redirect(route('contratoPrestacionServicios.index'));
        }

        if (Auth::user()->role == 'gerencia' || Auth::user()->role == 'administrador') {
           
            $input = [];
            $input['aprobado'] = true;
            $input['fecha_aprobacion'] = Carbon::now();
            $input['usuario_aprobacion'] = Auth::id();
           
           $contratoPrestacionServicio = $this->contratoPrestacionServicioRepository->update($input, $id);
           
           Flash::success('Contrato de Vinculación Aprobado correctamente.');

            return redirect(route('contratoPrestacionServicios.index'));
        } else {
             Flash::error('Su cuenta de usuario no posee el nivel de autorización requerida para efectuar esta acción.');

            return redirect(route('contratoPrestacionServicios.index'));
        }
    }
}
