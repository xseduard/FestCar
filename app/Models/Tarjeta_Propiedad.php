<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Jenssegers\Date\Date;

/**
 * Class Tarjeta_Propiedad
 * @package App\Models
 * @version May 29, 2017, 3:05 am UTC
 */
class Tarjeta_Propiedad extends Model
{
    use SoftDeletes;

    public $table = 'tarjeta_propiedads';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'vehiculo_id',
        'licencia_transito',
        'marca',
        'linea',
        'cilindrada',
        'color',
        'servicio',
        'clase_vehiculo',
        'tipo_carroceria',
        'combustible',
        'numero_motor',
        'numero_serie',
        'numero_chasis',
        'restriccion_movilidad',
        'blindaje',
        'potencia_hp',
        'declaracion_importacion',
        'fecha_importacion',
        'puertas',
        'fecha_matricula',
        'fecha_expedicion',
        'organismo_transito',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'vehiculo_id' => 'integer',
        'licencia_transito' => 'string',
        'marca' => 'string',
        'linea' => 'string',
        'cilindrada' => 'string',
        'color' => 'string',
        'servicio' => 'string',
        'clase_vehiculo' => 'string',
        'tipo_carroceria' => 'string',
        'combustible' => 'string',
        'numero_motor' => 'string',
        'numero_serie' => 'string',
        'numero_chasis' => 'string',
        'restriccion_movilidad' => 'string',
        'blindaje' => 'string',
        'potencia_hp' => 'string',
        'declaracion_importacion' => 'string',
        'fecha_importacion' => 'string',
        'puertas' => 'string',
        'fecha_matricula' => 'string',
        'fecha_expedicion' => 'string',
        'organismo_transito' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'vehiculo_id' => 'required|unique:tarjeta_propiedads,vehiculo_id',
        'licencia_transito' => 'required',
        'marca' => '',
        'potencia_hp' => '',
        'puertas' => 'numeric',
        'organismo_transito' => '',
        "fecha_matricula" => "required",
        "fecha_expedicion" => "required",
    ];

    public function getFechaExpedicionAttribute($fecha_expedicion)
    {
        $result = new Date($fecha_expedicion);        
        return $result;        
    }
    public function getFechaMatriculaAttribute($fecha_matricula)    {              
        return new Date($fecha_matricula); 
    }


    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    public function vehiculo(){
        return $this->belongsTo('App\Models\Vehiculo');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Funciones Especiales
     */
}
