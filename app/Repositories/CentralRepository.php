<?php

namespace App\Repositories;


use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Natural;
use App\Models\Juridico;
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

    public function id_departamento(){
        // Departamento::all()->pluck('nombre', 'id')->toArray();                
           return Departamento::lists('nombre', 'id');
    }
    public function municipio_id(){
        // Departamento::all()->pluck('nombre', 'id')->toArray();                
           return Municipio::lists('nombre', 'id');
    }
    public function natural_id_nombre(){
        // Departamento::all()->pluck('nombre', 'id')->toArray();                
           return Natural::lists('nombres', 'id');
    }
    public function natural_id(){
        $array['']= "seleccione...";
        $modelo = Natural::all()->toArray();
            foreach ($modelo as $key => $value) {
                $array[$value['id']]=$value['cedula']." - ".$value['nombres']." ".$value['apellidos'];
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
