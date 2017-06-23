<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExtractoRequest;
use App\Http\Requests\UpdateExtractoRequest;
use App\Repositories\ExtractoRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\Models\Extracto;
USE DB;


class ExtractoController extends AppBaseController
{
    /** @var  ExtractoRepository */
    private $extractoRepository;
    private $centralRepository;

    public function __construct(ExtractoRepository $extractoRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->extractoRepository = $extractoRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Extracto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->extractoRepository->pushCriteria(new RequestCriteria($request));
        $extractos = $this->extractoRepository->orderBy('updated_at', 'desc')->paginate(15);

        /**
         * $extractos = $this->extractoRepository->all();
         */

        return view('extractos.index')
            ->with('extractos', $extractos);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['ContratoPrestacionServicio_id'] = $this->centralRepository->ContratoPrestacionServicio_id();
        $selectores['conductor_id'] = $this->centralRepository->conductor_id();
        $selectores['vehiculo_id'] = $this->centralRepository->vehiculo_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new Extracto.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        if (empty($selectores['ContratoPrestacionServicio_id'])) {
           Flash::error('No Existen contratos de prestacion de servicios Vigentes');           
             return Redirect::back()->withInput(Input::all());
        }
        return view('extractos.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Extracto in storage.
     *
     * @param CreateExtractoRequest $request
     *
     * @return Response
     */
    public function store(CreateExtractoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        if ($this->centralRepository->validar_numero_interno($input['vehiculo_id'])) {                     
             return Redirect::back()->withInput(Input::all());
        }

        $validar_documentos_vehiculo = $this->centralRepository->validar_documentos_vehiculo($input['vehiculo_id']);

        if ($validar_documentos_vehiculo['error']) {  
            Flash::error($validar_documentos_vehiculo['mensaje']);           
             return Redirect::back()->withInput(Input::all());
        }

        if($this->centralRepository->validar_conductores_duplicados($input)) {
            return Redirect::back()->withInput(Input::all());
        }
        
        $input['tarjetaoperacion_id']       = $validar_documentos_vehiculo['tarjetaoperacion']->id;
        $input['soat_id']                   = $validar_documentos_vehiculo['soat']->id;
        $input['polizaresponsabilidad_id']  = $validar_documentos_vehiculo['polizaresponsabilidad']->id;

        if ($validar_documentos_vehiculo['tecnicomecanica'] != 'Vehiculo nuevo') {                 
            $input['tecnicomecanica_id']    = $validar_documentos_vehiculo['tecnicomecanica']->id;
        }
        if (!empty($input['conductor_uno'])) {
            $input['f_licencia_uno'] = $this->centralRepository->buscar_licencia($input['conductor_uno'])->format('d-m-Y');
        }
        if (!empty($input['conductor_dos'])) {
            $input['f_licencia_dos'] = $this->centralRepository->buscar_licencia($input['conductor_dos'])->format('d-m-Y');
        }
        if (!empty($input['conductor_tres'])) {
            $input['f_licencia_tres'] = $this->centralRepository->buscar_licencia($input['conductor_tres'])->format('d-m-Y');
        }
        
        $cv = $this->centralRepository->verificar_contrato_vinculacion($input['vehiculo_id']);        
        if ($cv != false) {            
           $input['contratovinculacion_id'] = $cv['id'];
        }
        //$input['contratovinculacion_id']    = '';

       
        $codigo = Extracto::where('ContratoPrestacionServicio_id',$input['ContratoPrestacionServicio_id'])->max('codigo');
        if (is_null($codigo)) {
            $input['codigo'] = 1;
        } else {
            $input['codigo'] = $codigo+1;
        }
        

        $extracto = $this->extractoRepository->create($input);

        //dd(DB::getQueryLog());

        Flash::success('Extracto registrado correctamente.');

        return redirect(route('extractos.index'));
    }

    /**
     * Display the specified Extracto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            Flash::error('Extracto No se encuentra registrado.');

            return redirect(route('extractos.index'));
        }

        return view('extractos.show')->with('extracto', $extracto);
    }

    /**
     * Show the form for editing the specified Extracto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            Flash::error('Extracto No se encuentra registrado.');

            return redirect(route('extractos.index'));
        }

        //validar datos

        $selectores = $this->selectoresComunes();

        return view('extractos.edit')->with(['extracto' => $extracto, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Extracto in storage.
     *
     * @param  int              $id
     * @param UpdateExtractoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExtractoRequest $request)
    {
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            Flash::error('Extracto No se encuentra registrado.');

            return redirect(route('extractos.index'));
        }


        $input = $request->all();
        $input['user_id'] = Auth::id();

        if ($this->centralRepository->validar_numero_interno($input['vehiculo_id'])) {                     
             return Redirect::back()->withInput(Input::all());
        }

        $validar_documentos_vehiculo = $this->centralRepository->validar_documentos_vehiculo($input['vehiculo_id']);

        if ($validar_documentos_vehiculo['error']) {  
            Flash::error($validar_documentos_vehiculo['mensaje']);           
             return Redirect::back()->withInput(Input::all());
        }


        if($this->centralRepository->validar_conductores_duplicados($input)) {
            return Redirect::back()->withInput(Input::all());
        }


        if (!empty($input['conductor_uno'])) {
            $input['f_licencia_uno'] = $this->centralRepository->buscar_licencia($input['conductor_uno'])->format('d-m-Y');
        }
        if (!empty($input['conductor_dos'])) {
            $input['f_licencia_dos'] = $this->centralRepository->buscar_licencia($input['conductor_dos'])->format('d-m-Y');
        }
        if (!empty($input['conductor_tres'])) {
            $input['f_licencia_tres'] = $this->centralRepository->buscar_licencia($input['conductor_tres'])->format('d-m-Y');
        }

        $input['tarjetaoperacion_id']       = $validar_documentos_vehiculo['tarjetaoperacion']->id;
        $input['soat_id']                   = $validar_documentos_vehiculo['soat']->id;
        $input['polizaresponsabilidad_id']  = $validar_documentos_vehiculo['polizaresponsabilidad']->id;

        if ($validar_documentos_vehiculo['tecnicomecanica'] != 'Vehiculo nuevo') {                 
            $input['tecnicomecanica_id']    = $validar_documentos_vehiculo['tecnicomecanica']->id;
        }

        //dd($input);

        $extracto = $this->extractoRepository->update($input, $id);

        Flash::success('Extracto actualizado correctamente.');

        return redirect(route('extractos.index'));
    }

    /**
     * Remove the specified Extracto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            Flash::error('Extracto No se encuentra registrado.');

            return redirect(route('extractos.index'));
        }

        $this->extractoRepository->delete($id);

        Flash::success('Extracto eliminado correctamente.');

        return redirect(route('extractos.index'));
    }
    public function print_space($id)
    {
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            Flash::error('Extracto No se encuentra registrado.');

            return redirect(route('extractos.index'));
        }
       $this->extractoRepository->print_extractos($id);
        
    }
}
