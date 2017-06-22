<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContratoVinculacionRequest;
use App\Http\Requests\UpdateContratoVinculacionRequest;
use App\Repositories\ContratoVinculacionRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Models\Empresa;
use App\Models\ContratoVinculacion;

 

class ContratoVinculacionController extends AppBaseController
{
    /** @var  ContratoVinculacionRepository */
    private $contratoVinculacionRepository;
    private $centralRepository;

    public function __construct(ContratoVinculacionRepository $contratoVinculacionRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->contratoVinculacionRepository = $contratoVinculacionRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the ContratoVinculacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contratoVinculacionRepository->pushCriteria(new RequestCriteria($request));
        $contratoVinculacions = $this->contratoVinculacionRepository->orderBy('updated_at', 'desc')->paginate(15);

        /**
         * $contratoVinculacions = $this->contratoVinculacionRepository->all();
         */

        return view('contrato_vinculacions.index')
            ->with('contratoVinculacions', $contratoVinculacions);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['vehiculo_id'] = $this->centralRepository->vehiculo_con_tarjeta_propiedad();
        $selectores['natural_id'] = $this->centralRepository->natural_id();
        $selectores['juridico_id'] = $this->centralRepository->juridico_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new ContratoVinculacion.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('contrato_vinculacions.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created ContratoVinculacion in storage.
     *
     * @param CreateContratoVinculacionRequest $request
     *
     * @return Response
     */
    public function store(CreateContratoVinculacionRequest $request)
    {
        
        $input = $request->all();        

        if ($input['tipo_contrato'] == 'CP' and $input['tipo_proveedor'] == 'Juridico') {
                    Flash::error("Contratos de tipo Proveedor (CP) solo pueden registrarse con personas Naturales");
                    return Redirect::back()->withInput(Input::all());
                } 

        $contratos_duplicados = ContratoVinculacion::where('vehiculo_id',$input['vehiculo_id'])->get();       
        if (!$contratos_duplicados->isEmpty()) {
                foreach ($contratos_duplicados->toArray() as $key => $value) {
                    if ($value['fecha_inicio'] <=  Carbon::now() && $value['fecha_final'] >= Carbon::now()) {                     
                         Flash::error("Ya existe un  <a href='contratoVinculacions/print/".$value['id']."'  target='_blank'> Contrato </a> Vigente para el vehículo ingresado");
                         return Redirect::back()->withInput(Input::all());
                    }               
                }               
        }      
        

        if ($this->centralRepository->validar_numero_interno($input['vehiculo_id'])) {                     
             return Redirect::back()->withInput(Input::all());
        }

        $validar_documentos_vehiculo = $this->centralRepository->validar_documentos_vehiculo($input['vehiculo_id']);

        if ($validar_documentos_vehiculo['error']) {  
            Flash::error($validar_documentos_vehiculo['mensaje']);           
             return Redirect::back()->withInput(Input::all());
        }

        $empresa = Empresa::first();
        $input['user_id']       = Auth::id();
        $input['rl_id']         = $empresa->rte_cedula;
        $input['rl_id_ref']     = $empresa->lugar_expedicion;
        $input['rl_name']       = $empresa->rte_nombre;
        $input['rl_lastname']   = $empresa->rte_apellido;

        $contratoVinculacion = $this->contratoVinculacionRepository->create($input);

        Flash::success('Contrato de Vinculación registrado correctamente.');

        return redirect(route('contratoVinculacions.index'));
    }

    /**
     * Display the specified ContratoVinculacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }

        return view('contrato_vinculacions.show')->with('contratoVinculacion', $contratoVinculacion);
    }

    /**
     * Show the form for editing the specified ContratoVinculacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('contrato_vinculacions.edit')->with(['contratoVinculacion' => $contratoVinculacion, 'selectores' => $selectores]);
    }

    /**
     * Update the specified ContratoVinculacion in storage.
     *
     * @param  int              $id
     * @param UpdateContratoVinculacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContratoVinculacionRequest $request)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }
        $input = $request->all();

        if ($input['tipo_contrato'] == 'CP' and $input['tipo_proveedor'] == 'Juridico') {
                    Flash::error("Contratos de tipo Proveedor (CP) solo pueden registrarse con personas Naturales");
                    return Redirect::back()->withInput(Input::all());
                }

        $contratos_duplicados = ContratoVinculacion::where('vehiculo_id',$input['vehiculo_id'])->where('id', '=!', $id)->get();  //se agrega segundo where para que no se encuentre a si mismo      
        if (!$contratos_duplicados->isEmpty()) {
                foreach ($contratos_duplicados->toArray() as $key => $value) {
                    if ($value['fecha_inicio'] <=  Carbon::now() && $value['fecha_final'] >= Carbon::now()) {                     
                         Flash::error("Ya existe un  <a href='contratoVinculacions/print/".$value['id']."'  target='_blank'> Contrato </a> Vigente para el vehículo ingresado");
                         return Redirect::back()->withInput(Input::all());
                    }               
                }               
        }

        $input['user_id'] = Auth::id();

        if ($this->centralRepository->validar_numero_interno($input['vehiculo_id'])) {                     
             return Redirect::back()->withInput(Input::all());
        }

        $validar_documentos_vehiculo = $this->centralRepository->validar_documentos_vehiculo($input['vehiculo_id']);

        if ($validar_documentos_vehiculo['error']) {  
            Flash::error($validar_documentos_vehiculo['mensaje']);           
             return Redirect::back()->withInput(Input::all());
        }  
        $contratoVinculacion = $this->contratoVinculacionRepository->update($input, $id);

        Flash::success('Contrato de Vinculación actualizado correctamente.');

        return redirect(route('contratoVinculacions.index'));
    }

    /**
     * Remove the specified ContratoVinculacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }

        $this->contratoVinculacionRepository->delete($id);

        Flash::success('Contrato de Vinculación eliminado correctamente.');

        return redirect(route('contratoVinculacions.index'));
    }
     public function print_space($id)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }
       
       $this->contratoVinculacionRepository->print_contratos($id);
        
    }
    public function aprobar($id)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }

        if (Auth::user()->role == 'gerencia' || Auth::user()->role == 'administrador') {
           
            $input = [];
            $input['aprobado'] = true;
            $input['fecha_aprobacion'] = Carbon::now();
            $input['usuario_aprobacion'] = Auth::id();
           
           $contratoVinculacion = $this->contratoVinculacionRepository->update($input, $id);
           
           Flash::success('Contrato de Vinculación Aprobado correctamente.');

            return redirect(route('contratoVinculacions.index'));
        } else {
             Flash::error('Su cuenta de usuario no posee el nivel de autorización requerida para efectuar esta acción.');

            return redirect(route('contratoVinculacions.index'));
        }
    }
}