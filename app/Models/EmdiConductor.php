<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslator;

/**
 * Class EmdiConductor
 * @package App\Models
 * @version June 30, 2017, 12:10 am COT
 */
class EmdiConductor extends Model
{
    use DatesTranslator, SoftDeletes;

    public $table = 'emdi_conductors';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cedula',
        'nombres',
        'apellidos',
        'celular',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'cedula' => 'string',
        'nombres' => 'string',
        'apellidos' => 'string',
        'celular' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'cedula' => 'numeric',
        'nombres' => 'required',
        'apellidos' => 'required'
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

    public function getFullNameAttribute()
    {
       return $this->nombres . ' ' . $this->apellidos;
    }
}
