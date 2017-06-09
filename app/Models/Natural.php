<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Natural
 * @package App\Models
 * @version May 28, 2017, 5:50 am UTC
 */
class Natural extends Model
{
    use SoftDeletes;

    public $table = 'naturales';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cedula',
        'municipio_id',
        'nombres',
        'apellidos',
        'genero',
        'direccion',
        'direccion_municipio',
        'correo',
        'telefono',
        'user_id',
        'observaciones'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'cedula' => 'string',
        'municipio_id' => 'integer',
        'nombres' => 'string',
        'apellidos' => 'string',
        'genero' => 'string',
        'direccion' => 'string',
        'direccion_municipio' => 'integer',
        'correo' => 'string',
        'telefono' => 'string',
        'user_id' => 'integer',
        'observaciones' => 'string'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'cedula' => 'required|numeric|unique:naturales|digits_between:8,12',
        'municipio_id' => 'required',
        'nombres' => 'required|string',
        'apellidos' => 'required|string',
        'genero' => 'required',
        'direccion' => '',
        'direccion_municipio' => 'required',
        'correo' => 'email',
        'telefono' => 'numeric|digits_between:8,15',
        'observaciones' => ''
    ];
    /**
     * Ascensores
     */

    public function getFullNameAttribute()
    {
       return $this->nombres . ' ' . $this->apellidos;
    }
    
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function municipio(){
        return $this->belongsTo('App\Models\Municipio');
    }

    public function residenciamunicipio(){
        return $this->belongsTo('App\Models\Municipio', 'direccion_municipio');
    }

    public function licencia(){
        return $this->belongsTo('App\Models\LicenciaConduccion', 'id', 'natural_id');
    }
    

    /**
     * Funciones Especiales
     */
}
