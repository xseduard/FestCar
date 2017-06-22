<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Juridico
 * @package App\Models
 * @version May 28, 2017, 5:23 pm UTC
 */
class Juridico extends Model
{
    use SoftDeletes;

    public $table = 'juridicos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nit',
        'nombre',
        'natural_id',
        'actividad',
        'telefono',
        'direccion_fiscal',
        'direccion_envio',
        'municipio_id',
        'email',
        'observaciones',
        'estado',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'nit' => 'string',
        'nombre' => 'string',
        'natural_id' => 'integer',
        'actividad' => 'string',
        'telefono' => 'string',
        'direccion_fiscal' => 'string',
        'direccion_envio' => 'string',
        'municipio_id' => 'string',
        'email' => 'string',
        'observaciones' => 'string',
        'estado' => 'boolean',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'nit' => 'required|unique:juridicos|digits_between:6,15',
        'nombre' => 'required',
        'natural_id' => 'required',
        'email' => 'email',
        'estado' => 'required',        
        'municipio_id' => 'required',
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */

    public function natural(){
        return $this->belongsTo('App\Models\Natural');
    }
    public function municipio(){
        return $this->belongsTo('App\Models\Municipio', 'municipio_id');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    

    /**
     * Funciones Especiales
     */
}
