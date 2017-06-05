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
        'natural_id',        
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
        'natural_id' => 'integer',        
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
        'natural_id' => 'required',        
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
    
    public function natural(){
        return $this->belongsTo('App\Models\Natural');
    }
    
    

    /**
     * Funciones Especiales
     */
}
