<?php

namespace App\Repositories;


use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Natural;
use App\Models\Juridico;
use App\Models\Vehiculo;
use App\Models\ContratoPrestacionServicio;
use App\Models\LicenciaConduccion;
use InfyOm\Generator\Common\BaseRepository;

class CentralRepository extends BaseRepository
{
    public function model()
    {
        return Departamento::class;
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
    
            foreach ($modelo as $key => $value) {

                if ($value['tipo_cliente'] == 'Natural') {
                   $array[$value['id']]="CPS".str_pad($value['id'], 4, "0", STR_PAD_LEFT)." - ".$value['natural']['cedula']." ".$value['natural']['nombres']." ".$value['natural']['apellidos'];
                } elseif ($value['tipo_cliente'] == 'Juridico') {
                    $array[$value['id']]="CPS".str_pad($value['id'], 4, "0", STR_PAD_LEFT)." - ".$value['juridico']['nit']." ".$value['juridico']['nombre'];
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
        $modelo = Vehiculo::all()->toArray();
            foreach ($modelo as $key => $value) {
                $array[$value['id']]=$value['placa']." - ".$value['propietario_cedula']." ".$value['propietario_nombre'];
            }
        return ($array);
    }
    // falta where para evitar que aparezcan los que ya tienen este documento
    public function vehiculo_id_tarjeta_propiedad (){
        $modelo = Vehiculo::all()->toArray();
            foreach ($modelo as $key => $value) {
                $array[$value['id']]=$value['placa']." - ".$value['propietario_cedula']." ".$value['propietario_nombre'];
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
}
