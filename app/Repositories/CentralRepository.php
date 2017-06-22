<?php

namespace App\Repositories;


use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Natural;
use App\Models\Juridico;
use App\Models\Vehiculo;
use App\Models\ContratoPrestacionServicio;
use App\Models\LicenciaConduccion;
use App\Models\Tarjeta_Propiedad;
use InfyOm\Generator\Common\BaseRepository;
use Carbon\Carbon;
use Flash;

class CentralRepository extends BaseRepository
{
    public function model()
    {
        return Departamento::class;
    }
    /**
     * Validador de vehículos
     */
    public function validar_conductores_duplicados($input) {
        // VALIDACIONES DE CONDUCTORES

        if (!empty($input['conductor_dos']) and $input['conductor_uno'] == $input['conductor_dos']) {
           Flash::error('Conductor UNO y DOS <b>NO</b> pueden ser iguales.');
           return true;
        } 
        if (!empty($input['conductor_tres']) and $input['conductor_uno'] == $input['conductor_tres']) {
           Flash::error('Conductor UNO y TRES <b>NO</b> pueden ser iguales.');
           return true;
        }
        if (!empty($input['conductor_dos']) 
            and !empty($input['conductor_tres']) 
                and $input['conductor_dos'] == $input['conductor_tres']) {
           Flash::error('Conductor UNO y DOS <b>NO</b> pueden ser iguales.');
           return true;
        }
        // FIN VALIDACIONES
    }
    public function validar_numero_interno($id){
        $vehiculo = Vehiculo::where('id', $id)->first();
        if (empty($vehiculo->numero_interno)) {
           Flash::error("<i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i> El vehiculo de placas ".$vehiculo->placa." no tiene asignado numero interno, <a href='/vehiculos/".$vehiculo->id."/edit' target='_blank'>Resolver aquí</a>"); 
           return true;
        }
    }
    public function validar_documentos_vehiculo($id){
        $car =  Vehiculo::with('tarjetapropiedad')
        ->with('tarjetaoperacion')
        ->with('soat')
        ->with('tecnicomecanica')
        ->with('polizaresponsabilidad')       
        ->where('id',$id)
        ->first();

        $resultado['vehiculo_id'] = Vehiculo::where('id',$id)->first();
        $resultado['error'] = false;
        $msg = "";

        if (is_null($car->tarjetapropiedad)) {
            $resultado['tarjetapropiedad'] = false;
            $resultado['error'] =  true;
            $msg .= "<p><i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i><b>Tarjeta de propiedad:</b> No se encuentra registrada, <a href='/tarjetaPropiedads/create' target='_blank'>Registrar aquí</a></p>";
        } else {
            $resultado['tarjetapropiedad'] = $car->tarjetapropiedad;
            if($car->tarjetapropiedad->fecha_matricula->diffInDays(Carbon::now()) <= 730) {
                $resultado['tecnicomecanica'] = 'Vehiculo nuevo';
                $resultado['error'] =  false; 
            } else {
                if ($car->tecnicomecanica->isEmpty()) {
                    $resultado['tecnicomecanica'] = false;
                        $resultado['error'] =  true;                        
                        $msg .= "<p><i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i><b>Técnicomecánica</b> No se encuentra registrada o esta vencida, <a href='/tecnicomecanicas/create' target='_blank'>Registrar aquí</a></p>";
                    } else {
                        foreach ($car->tecnicomecanica as $key => $value) {
                            if ($value->vigente) {
                                $resultado['tecnicomecanica'] = $value;
                                break;
                            } 
                            $resultado['tecnicomecanica'] = false;
                            $resultado['error'] =  true;
                            $msg .= "<p><i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i><b>Técnicomecánica</b> No se encuentra registrada o esta vencida, <a href='/tecnicomecanicas/create' target='_blank'>Registrar aquí</a></p>";                      
                    }
                }
            }
            
        }
        if ($car->tarjetaoperacion->isEmpty()) {
            $resultado['tarjetaoperacion'] = false;
            $resultado['error'] =  true; 
            $msg .= "<p><i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i><b>Tarjeta de Operación:</b> No se encuentra registrada o esta vencida, <a href='/tarjetaOperacions/create' target='_blank'>Registrar aquí</a></p>";  
            } else {
                foreach ($car->tarjetaoperacion as $key => $value) {
                    if ($value->vigente) {
                        $resultado['tarjetaoperacion'] = $value;
                        break;
                    }
                    $resultado['tarjetaoperacion'] = false;
                    $resultado['error'] =  true; 
                    $msg .= "<p><i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i><b>Tarjeta de Operación:</b> No se encuentra registrada o esta vencida, <a href='/tarjetaOperacions/create' target='_blank'>Registrar aquí</a></p>";        

                }
        }
        if ($car->soat->isEmpty()) {
            $resultado['soat'] = false;
            $resultado['error'] =  true; 
            $msg .= "<p><i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i><b>Soat:</b> No se encuentra registrado o esta vencido, <a href='/soats/create' target='_blank'>Registrar aquí</a> </p>";
         } else { 
           foreach ($car->soat as $key => $value) {
                if ($value->vigente) {
                    $resultado['soat'] = $value;
                    break;
                } 
                $resultado['soat'] = false;
                $resultado['error'] =  true; 
                $msg .= "<p><i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i><b>Soat:</b> No se encuentra registrado o esta vencido, <a href='/soats/create' target='_blank'>Registrar aquí</a> </p>";
                           
            }
        }
        if ($car->polizaresponsabilidad->isEmpty()) {
            $resultado['polizaresponsabilidad'] = false; 
            $resultado['error'] =  true;
            $msg .= "<p><i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i><b> Poliza de responsabilidad (RCC RCE):</b> No se encuentra registrada o esta vencida, <a href='/polizaResponsabilidads/create' target='_blank'>Registrar aquí</a></p>";
         } else {       
            foreach ($car->polizaresponsabilidad as $key => $value) {
                if ($value->vigente) {
                    $resultado['polizaresponsabilidad'] = $value;
                    break;
                } 
                $resultado['polizaresponsabilidad'] = false; 
                $resultado['error'] =  true;
                $msg .= "<p><i class='fa fa fa-exclamation-circle fa-spin fa-fw'></i><b> Poliza de responsabilidad (RCC RCE):</b> No se encuentra registrada o esta vencida, <a href='/polizaResponsabilidads/create' target='_blank'>Registrar aquí</a></p>";                            
            }
        } 
        if ($resultado['error']) {
            $resultado['mensaje'] = "<p>El vehículo de placas <span class='label label-default'>".$car->placa."</span> NO cumple con los siguientes requisitos</p>".$msg;                
            }

        return $resultado;

    }
            
        

        
    
    /**
     * Generador de selects
     */
    // Departamento::all()->pluck('nombre', 'id')->toArray();

    public function id_departamento(){
                        
           return Departamento::lists('nombre', 'id');
    }
    public function municipio_id_only(){               
           return Municipio::lists('nombre', 'id');
    }
    public function municipio_id(){
        // se mantienen formas de colleciones dentro de arrays
        //dd(Municipio::with('departamento')->get()->all()[1]->departamento);
        //dd(Municipio::with('departamento')->get()->all()[1]['departamento']);
            foreach (Municipio::with('departamento')->get()->toArray() as $key => $value) {
                //dd($value); //cuando lo recorre se convierte absolutamente todo en arrray
                $array[$value['id']]=$value['nombre'].", ".$value['departamento']['nombre'];                
            }
        return ($array);
    }
    public function conductor_id(){
        // se mantienen formas de colleciones dentro de arrays
        //dd(Municipio::with('departamento')->get()->all()[1]->departamento);
        //dd(Municipio::with('departamento')->get()->all()[1]['departamento']);
            foreach (LicenciaConduccion::with('natural')->get()->toArray() as $key => $value) {
                //dd($value); //cuando lo recorre se convierte absolutamente todo en arrray
                $array[$value['id']]=$value['natural']['cedula']." - ".$value['natural']['nombres']." ".$value['natural']['apellidos']; 
                //hasta aqui
            }
        return ($array);
    }
     public function ContratoPrestacionServicio_id(){
        
        $modelo = ContratoPrestacionServicio::with('natural')->with('juridico')->get()->toArray();
        $array = [];

        if (!empty($modelo)) {
          
            foreach ($modelo as $key => $value) {

                if ($value['tipo_cliente'] == 'Natural') {

                   $array[$value['id']] = "CPS".str_pad($value['id'], 4, "0", STR_PAD_LEFT)." - ".$value['natural']['cedula']." ".$value['natural']['nombres']." ".$value['natural']['apellidos'];  

                } elseif ($value['tipo_cliente'] == 'Juridico') {   

                    $array[$value['id']]="CPS".str_pad($value['id'], 4, "0", STR_PAD_LEFT)." - ".$value['juridico']['nit']." ".$value['juridico']['nombre'];
                }
                                
            }
        }
        return ($array);               
          
    }
    public function natural_id_nombre(){                      
           
           return Natural::lists('nombres', 'id');
    }
    public function natural_id(){
        $modelo = Natural::all()->toArray();
            foreach ($modelo as $key => $value) {
                $array[$value['id']]=$value['cedula']." - ".$value['nombres']." ".$value['apellidos'];
            }
        return ($array);
    }
    public function juridico_id(){
        $modelo = Juridico::all()->toArray();
            foreach ($modelo as $key => $value) {
                $array[$value['id']]=$value['nit']." - ".$value['nombre'];
            }
        return ($array);
    }
    public function vehiculo_id (){
         $modelo = Vehiculo::with('natural')->with('juridico')->get()->toArray();
            foreach ($modelo as $key => $value) {               
                //$array[$value['id']]=$value['placa']." - ".$value['natural']['cedula']." ".$value['natural']['nombres']." ".$value['natural']['apellidos'] ;
                 if ($value['tipo_propietario'] == 'Natural') {
                    $array[$value['id']]=$value['placa']." - ".$value['natural']['cedula']." ".$value['natural']['nombres']." ".$value['natural']['apellidos'] ;
                }  elseif ($value['tipo_propietario'] == 'Juridico') {
                   $array[$value['id']]=$value['placa']." - ".$value['juridico']['nit']." ".$value['juridico']['nombre'];
                }
            }
        return ($array);
    }
    public function vehiculo_con_tarjeta_propiedad (){
         $modelo = Tarjeta_Propiedad::with('vehiculo.natural')->with('vehiculo.juridico')->get()->toArray(); //demo doble relacion
            foreach ($modelo as $key => $value) {              
                if ($value['vehiculo']['tipo_propietario'] == 'Natural') {
                    $array[$value['vehiculo_id']]=$value['vehiculo']['placa']." - ".$value['vehiculo']['natural']['cedula']." ".$value['vehiculo']['natural']['nombres']." ".$value['vehiculo']['natural']['apellidos'] ;
                }  elseif ($value['vehiculo']['tipo_propietario'] == 'Juridico') {
                   $array[$value['vehiculo_id']]=$value['vehiculo']['placa']." - ".$value['vehiculo']['juridico']['nit']." ".$value['vehiculo']['juridico']['nombre'];
                }
            }
        return ($array);
    }
    // falta where para evitar que aparezcan los que ya tienen este documento
    public function vehiculo_id_tarjeta_propiedad (){
        $modelo = Vehiculo::with('natural')->get()->toArray();
            foreach ($modelo as $key => $value) {               
                $array[$value['id']]=$value['placa']." - ".$value['natural']['cedula']." ".$value['natural']['nombres']." ".$value['natural']['apellidos'] ;
                
            }
        return ($array);
    }
    /**
     * Selectores urls ajax
     */
    public function selector_departamento($term){
        $term2 = trim($term);
        if (empty($term2)) {
            $tags = Departamento::lists('nombre', 'id');           
            
            return $this->tags_formato($tags);        
        }
        else{
            $tags = Departamento::where('nombre', 'LIKE', '%'.$term.'%')->get();

            return $this->tags_formato_modelo($tags);
        }    
    }

    /**
     * Funciones Comunes
     */
    public function tags_formato($inputs){
        //recibe arrays
        $formateado = [];
            foreach ($inputs as $key => $value) {
                $formateado[] = ['id'=>$key, 'text'=>$value];
            }            
        return \Response::json($formateado);
    }
    public function tags_formato_modelo($inputs){
        //recibe modelos
        $formateado = [];
            foreach ($inputs as $input) {
                $formateado[] = ['id' => $input->id, 'text' => $input->nombre];
            }
        return \Response::json($formateado);
    }

    /**
     * funciones de busqueda
     */
    public function buscar_licencia($id) {
        $model = LicenciaConduccion::where('id',$id)
        ->first();
                
        return $model->fechavigencia;
    }





}
