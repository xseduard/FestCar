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

    public $table = 'naturals';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cedula',
        'nombres',
        'apellidos',
        'genero',
        'correo',
        'telefono',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'cedula' => 'string',
        'nombres' => 'string',
        'apellidos' => 'string',
        'genero' => 'string',
        'correo' => 'string',
        'telefono' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'cedula' => 'required|numeric|unique:naturals|digits_between:8,12',
        'nombres' => 'required|string',
        'apellidos' => 'required|string',
        'genero' => 'required',
        'correo' => 'email',
        'telefono' => 'numeric|digits_between:8,15'
    ];
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
    

    /**
     * Funciones Especiales
     */
}
