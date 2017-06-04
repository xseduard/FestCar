<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Vehiculo
 * @package App\Models
 * @version May 28, 2017, 10:22 pm UTC
 */
class Vehiculo extends Model
{
    use SoftDeletes;

    public $table = 'vehiculos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'placa',
        'propietario_nombre',
        'propietario_cedula',
        'poseedor_nombre',
        'poseedor_cedula',
        'numero_interno',
        'capacidad',
        'modelo',
        'marca',
        'clase',
        'propiedad',
        'observaciones',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'placa' => 'string',
        'propietario_nombre' => 'string',
        'propietario_cedula' => 'string',
        'poseedor_nombre' => 'string',
        'poseedor_cedula' => 'string',
        'numero_interno' => 'string',
        'capacidad' => 'string',
        'modelo' => 'string',
        'marca' => 'string',
        'clase' => 'string',
        'propiedad' => 'boolean',
        'observaciones' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'placa' => 'required|alpha_num|unique:vehiculos|size:6',
        'propietario_nombre' => 'required',
        'propietario_cedula' => 'required|numeric',
        'poseedor_cedula' => 'numeric',
        'numero_interno' => 'required|numeric',
        'capacidad' => 'numeric',
        'modelo' => 'numeric',
        'marca' => 'required',
        'clase' => 'required',
        'propiedad' => 'required',
        'observaciones' => ''
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    

    /**
     * Funciones Especiales
     */
}
