<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateProyectoInvestigacionRequest;
use App\Http\Requests\UpdateProyectoInvestigacionRequest;
use App\Repositories\ProyectoInvestigacionRepository;
use App\Repositories\PaisRepository;
use Illuminate\Http\Request;
use Flash;
use InfyOm\Generator\Controller\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\ProyectoInvestigacion;
use App\Models\Nodo;
use App\Models\Universidades;
use App\Models\Semilleros;
use App\Models\ProyectoCategoria;
use App\Models\EStudiantes;
use App\Models\Nivelformacion;
use App\Models\Asignaturas;
use App\Models\Areainvestigacion;
use App\Models\Subarea;

class ProyectoInvestigacionController extends AppBaseController
{
    /** @var  ProyectoInvestigacionRepository */
    private $proyectoInvestigacionRepository;
    private $paisRepository;

    function __construct(ProyectoInvestigacionRepository $proyectoInvestigacionRepo, PaisRepository $paisRepo)
    {
        $this->proyectoInvestigacionRepository = $proyectoInvestigacionRepo;
        $this->paisRepository = $paisRepo;
    }

    /**
     * Display a listing of the ProyectoInvestigacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

       $camposConsulta = $request->all();
        $array_nodo[''] = "Seleccione...";
        $ar_universidad[''] = "Seleccione...";
        $ar_semillero[''] = "Seleccione...";
        $ar_procate[''] = "Seleccione...";
        $ar_estudiante  [''] = "Seleccione..."; 
        $ar_nivel[''] = "Seleccione...";
        $ar_asignatura[''] = "Seleccione...";
        $ar_area[''] = "Seleccione...";
        $ar_subarea[''] = "Seleccione...";
        $nodo = Nodo::all()->toArray();        
        foreach ($nodo as $key => $value) {
            $array_nodo[$value['id']] = $value['nodo'];
        }

        $universidad = Universidades::all()->toArray();
        foreach ($universidad as $key => $value) {
            $ar_universidad[$value['id']]=$value['universidad'];
        }

        $semilleros = Semilleros::all()->toArray();
        foreach ($semilleros as $key => $value) {
            $ar_semillero[$value['id']]=$value['nombre'];
        }

         $Proyecto_Categoria = ProyectoCategoria::all()->toArray();
        foreach ($Proyecto_Categoria as $key => $value) {
            $ar_procate[$value['id']]=$value['categoria'];
        }
        $estudiante = EStudiantes::all()->toArray();
        foreach ($estudiante as $key => $value) {
            $ar_estudiante[$value['id']]=$value['nombre_completo'];
        }

        $nivel = Nivelformacion::all()->toArray();
        foreach ($nivel as $key => $value) {
            $ar_nivel[$value['id']]=$value['nivel'];
        }

        $asignatura = Asignaturas::all()->toArray();
        foreach ($asignatura as $key => $value) {
            $ar_asignatura[$value['id']]=$value['asignatura'];
        }

        $area = Areainvestigacion::all()->toArray();
        foreach ($area as $key => $value) {
            $ar_area[$value['id']]=$value['area'];
        }
        $subarea = Subarea::all()->toArray();
        foreach ($subarea as $key => $value) {
            $ar_subarea[$value['id']]=$value['subarea'];
        }


        $this->proyectoInvestigacionRepository->pushCriteria(new RequestCriteria($request));
        
        $proyectoInvestigacions = ProyectoInvestigacion::
        SNodo($request->get('nodo'))
        ->SSemillero($request->get('semillero'))
        ->SArea_investigacion($request->get('area_investigacion'))
        ->SAsignatura($request->get('asignatura'))
        ->paginate(10);
        
        return view('proyectoInvestigacions.index')
            ->with(
                ['proyectoInvestigacions'=> $proyectoInvestigacions,                
         'array_nodo' => $array_nodo,
         'camposConsulta' => $camposConsulta,
          'ar_semillero' => $ar_semillero,
          'ar_asignatura' => $ar_asignatura,
          'ar_area' => $ar_area,
          'ar_subarea' => $ar_subarea]);
    }
public function inconsulta(Request $request)
    {

       //dd($request);
        $array_nodo[''] = "Seleccione...";
        $ar_universidad[''] = "Seleccione...";
        $ar_semillero[''] = "Seleccione...";
        $ar_procate[''] = "Seleccione...";
        $ar_estudiante  [''] = "Seleccione..."; 
        $ar_nivel[''] = "Seleccione...";
        $ar_asignatura[''] = "Seleccione...";
        $ar_area[''] = "Seleccione...";
        $ar_subarea[''] = "Seleccione...";
        $nodo = Nodo::all()->toArray();        
        foreach ($nodo as $key => $value) {
            $array_nodo[$value['id']] = $value['nodo'];
        }

        $universidad = Universidades::all()->toArray();
        foreach ($universidad as $key => $value) {
            $ar_universidad[$value['id']]=$value['universidad'];
        }

        $semilleros = Semilleros::all()->toArray();
        foreach ($semilleros as $key => $value) {
            $ar_semillero[$value['id']]=$value['nombre'];
        }

         $Proyecto_Categoria = ProyectoCategoria::all()->toArray();
        foreach ($Proyecto_Categoria as $key => $value) {
            $ar_procate[$value['id']]=$value['categoria'];
        }
        $estudiante = EStudiantes::all()->toArray();
        foreach ($estudiante as $key => $value) {
            $ar_estudiante[$value['id']]=$value['nombre_completo'];
        }

        $nivel = Nivelformacion::all()->toArray();
        foreach ($nivel as $key => $value) {
            $ar_nivel[$value['id']]=$value['nivel'];
        }

        $asignatura = Asignaturas::all()->toArray();
        foreach ($asignatura as $key => $value) {
            $ar_asignatura[$value['id']]=$value['asignatura'];
        }

        $area = Areainvestigacion::all()->toArray();
        foreach ($area as $key => $value) {
            $ar_area[$value['id']]=$value['area'];
        }
        $subarea = Subarea::all()->toArray();
        foreach ($subarea as $key => $value) {
            $ar_subarea[$value['id']]=$value['subarea'];
        }


        //$this->proyectoInvestigacionRepository->pushCriteria(new RequestCriteria($request));
        
        $proyectoInvestigacions = ProyectoInvestigacion::
        SNodo($request->get('nodo'))
        ->SSemillero($request->get('semillero'))
        ->SArea_investigacion($request->get('area_investigacion'))
        ->SAsignatura($request->get('asignatura'))
        ->paginate(10);
        
        return view('proyectoInvestigacions.index')
            ->with(
                ['proyectoInvestigacions'=> $proyectoInvestigacions,                
         'array_nodo' => $array_nodo,
          'ar_semillero' => $ar_semillero,
          'ar_asignatura' => $ar_asignatura,
          'ar_area' => $ar_area,
          'ar_subarea' => $ar_subarea]);
    }

    /**
     * Show the form for creating a new ProyectoInvestigacion.
     *
     * @return Response
     */
    public function create()
    {

         $array_nodo[''] = "Seleccione...";
        $ar_universidad[''] = "Seleccione...";
        $ar_semillero[''] = "Seleccione...";
        $ar_procate[''] = "Seleccione...";
        $ar_estudiante  [''] = "Seleccione..."; 
        $ar_nivel[''] = "Seleccione...";
        $ar_asignatura[''] = "Seleccione...";
        $ar_area[''] = "Seleccione...";
        $ar_subarea[''] = "Seleccione...";
        $pais = $this->paisRepository->all()->toArray();        
        foreach ($pais as $key => $value) {
          $array_pais[$value['id']]=$value['pais'];
        }

        $nodo = Nodo::all()->toArray();
        foreach ($nodo as $key => $value) {
            $array_nodo[$value['id']]=$value['nodo'];
        }

        $universidad = Universidades::all()->toArray();
        foreach ($universidad as $key => $value) {
            $ar_universidad[$value['id']]=$value['universidad'];
        }

        $semilleros = Semilleros::all()->toArray();
        foreach ($semilleros as $key => $value) {
            $ar_semillero[$value['id']]=$value['nombre'];
        }

         $Proyecto_Categoria = ProyectoCategoria::all()->toArray();
        foreach ($Proyecto_Categoria as $key => $value) {
            $ar_procate[$value['id']]=$value['categoria'];
        }
        $estudiante = EStudiantes::all()->toArray();
        foreach ($estudiante as $key => $value) {
            $ar_estudiante[$value['id']]=$value['nombre_completo'];
        }

        $nivel = Nivelformacion::all()->toArray();
        foreach ($nivel as $key => $value) {
            $ar_nivel[$value['id']]=$value['nivel'];
        }

        $asignatura = Asignaturas::all()->toArray();
        foreach ($asignatura as $key => $value) {
            $ar_asignatura[$value['id']]=$value['asignatura'];
        }

        $area = Areainvestigacion::all()->toArray();
        foreach ($area as $key => $value) {
            $ar_area[$value['id']]=$value['area'];
        }
        $subarea = Subarea::all()->toArray();
        foreach ($subarea as $key => $value) {
            $ar_subarea[$value['id']]=$value['subarea'];
        }

        return view('proyectoInvestigacions.create')
        ->with(['array_pais' => $array_pais,
         'array_nodo' => $array_nodo,
          'ar_universidad' => $ar_universidad,
          'ar_semillero' => $ar_semillero,
          'ar_procate' => $ar_procate,
          'ar_estudiante' => $ar_estudiante,
          'ar_nivel' => $ar_nivel,
          'ar_asignatura' => $ar_asignatura,
          'ar_area' => $ar_area,
          'ar_subarea' => $ar_subarea]);

    }

    /**
     * Store a newly created ProyectoInvestigacion in storage.
     *
     * @param CreateProyectoInvestigacionRequest $request
     *
     * @return Response
     */
    public function store(CreateProyectoInvestigacionRequest $request)
    {
        //dd('aqui no!');
        $input = $request->all();

        $proyectoInvestigacion = $this->proyectoInvestigacionRepository->create($input);

        Flash::success('ProyectoInvestigacion registrado correctamente.');

        return redirect(route('proyectoInvestigacions.index'));
    }

    /**
     * Display the specified ProyectoInvestigacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $proyectoInvestigacion = $this->proyectoInvestigacionRepository->findWithoutFail($id);

        if (empty($proyectoInvestigacion)) {
            Flash::error('ProyectoInvestigacion No se encuentra en encuentra registrado');

            return redirect(route('proyectoInvestigacions.index'));
        }

        return view('proyectoInvestigacions.show')->with('proyectoInvestigacion', $proyectoInvestigacion);
    }

    /**
     * Show the form for editing the specified ProyectoInvestigacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $proyectoInvestigacion = $this->proyectoInvestigacionRepository->findWithoutFail($id);

        if (empty($proyectoInvestigacion)) {
            Flash::error('ProyectoInvestigacion No se encuentra en encuentra registrado');

            return redirect(route('proyectoInvestigacions.index'));
        }

        $pais = $this->paisRepository->all()->toArray();        
        foreach ($pais as $key => $value) {
          $array_pais[$value['id']]=$value['pais'];
        }

        $nodo = Nodo::all()->toArray();
        foreach ($nodo as $key => $value) {
            $array_nodo[$value['id']]=$value['nodo'];
        }

        $universidad = Universidades::all()->toArray();
        foreach ($universidad as $key => $value) {
            $ar_universidad[$value['id']]=$value['universidad'];
        }

        $semilleros = Semilleros::all()->toArray();
        foreach ($semilleros as $key => $value) {
            $ar_semillero[$value['id']]=$value['nombre'];
        }

         $Proyecto_Categoria = ProyectoCategoria::all()->toArray();
        foreach ($Proyecto_Categoria as $key => $value) {
            $ar_procate[$value['id']]=$value['categoria'];
        }
        $estudiante = EStudiantes::all()->toArray();
        foreach ($estudiante as $key => $value) {
            $ar_estudiante[$value['id']]=$value['nombre_completo'];
        }

        $nivel = Nivelformacion::all()->toArray();
        foreach ($nivel as $key => $value) {
            $ar_nivel[$value['id']]=$value['nivel'];
        }

        $asignatura = Asignaturas::all()->toArray();
        foreach ($asignatura as $key => $value) {
            $ar_asignatura[$value['id']]=$value['asignatura'];
        }

        $area = Areainvestigacion::all()->toArray();
        foreach ($area as $key => $value) {
            $ar_area[$value['id']]=$value['area'];
        }
        $subarea = Subarea::all()->toArray();
        foreach ($subarea as $key => $value) {
            $ar_subarea[$value['id']]=$value['subarea'];
        }

        return view('proyectoInvestigacions.edit')
        ->with(['proyectoInvestigacion'=> $proyectoInvestigacion,
            'array_pais' => $array_pais,
         'array_nodo' => $array_nodo,
          'ar_universidad' => $ar_universidad,
          'ar_semillero' => $ar_semillero,
          'ar_procate' => $ar_procate,
          'ar_estudiante' => $ar_estudiante,
          'ar_nivel' => $ar_nivel,
          'ar_asignatura' => $ar_asignatura,
          'ar_area' => $ar_area,
          'ar_subarea' => $ar_subarea]);
    }

    /**
     * Update the specified ProyectoInvestigacion in storage.
     *
     * @param  int              $id
     * @param UpdateProyectoInvestigacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProyectoInvestigacionRequest $request)
    {
        $proyectoInvestigacion = $this->proyectoInvestigacionRepository->findWithoutFail($id);

        if (empty($proyectoInvestigacion)) {
            Flash::error('ProyectoInvestigacion No se encuentra en encuentra registrado');

            return redirect(route('proyectoInvestigacions.index'));
        }

        $proyectoInvestigacion = $this->proyectoInvestigacionRepository->update($request->all(), $id);

        Flash::success('ProyectoInvestigacion actualizado correctamente.');

        return redirect(route('proyectoInvestigacions.index'));
    }

    /**
     * Remove the specified ProyectoInvestigacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $proyectoInvestigacion = $this->proyectoInvestigacionRepository->findWithoutFail($id);

        if (empty($proyectoInvestigacion)) {
            Flash::error('ProyectoInvestigacion No se encuentra en encuentra registrado');

            return redirect(route('proyectoInvestigacions.index'));
        }

        $this->proyectoInvestigacionRepository->delete($id);

        Flash::success('ProyectoInvestigacion eliminado correctamente.');

        return redirect(route('proyectoInvestigacions.index'));
    }
}
