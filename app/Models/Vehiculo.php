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
        'tipo_propietario',
        'juridico_id',
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
        'tipo_propietario' => 'string',
        'juridico_id' => 'integer',
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
        'tipo_propietario' => 'required',
        'natural_id' => 'required_if:tipo_propietario,Natural',
        'juridico_id' => 'required_if:tipo_propietario,Juridico',      
        'numero_interno' => 'numeric',
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
    public function tarjetapropiedad(){
        return $this->hasOne('App\Models\Tarjeta_Propiedad', 'vehiculo_id', 'id');
    }
    public function tarjetaoperacion(){
        return $this->hasMany('App\Models\TarjetaOperacion', 'vehiculo_id', 'id');
    }
    public function soat(){
        return $this->hasMany('App\Models\Soat', 'vehiculo_id', 'id');
    }
    public function tecnicomecanica(){
        return $this->hasMany('App\Models\Tecnicomecanica', 'vehiculo_id', 'id');
    }
    public function polizaresponsabilidad(){
        return $this->hasMany('App\Models\PolizaResponsabilidad', 'vehiculo_id', 'id');
    }
    public function revisionpreventiva(){
        return $this->hasMany('App\Models\RevisionPreventiva', 'vehiculo_id', 'id');
    }
    
    /**
     * Ascensores
     */

    

    /**
     * Funciones Especiales
     */
}
