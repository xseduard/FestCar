<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Municipio
 * @package App\Models
 * @version May 27, 2017, 1:38 am UTC
 */
class Municipio extends Model
{
    use SoftDeletes;

    public $table = 'municipios';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'id_departamento'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'nombre' => 'string',
        'id_departamento' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'nombre' => 'required',
        'id_departamento' => 'required'
    ];
    /**
     * Relaciones entre Modelos
     */
    public function departamento(){
        return $this->belongsTo('App\Models\Departamento', 'id_departamento');
    }

    /**
     * Funciones Especiales
     */

    public static function selMunicipio(){
        $array['']= "seleccione...";
        $modelo = Municipio::all()->toArray();
            foreach ($modelo as $key => $value) {
                $array[$value['id']]=$value['nombre'];
            }
        return ($array);
    }
}
