<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslator;

/**
 * Class EmdiPaciente
 * @package App\Models
 * @version June 29, 2017, 11:52 pm COT
 */
class EmdiPaciente extends Model
{
    use DatesTranslator, SoftDeletes;

    public $table = 'emdi_pacientes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cedula',
        'nombres',
        'apellidos',
        'celular',
        'direccion',
        'ac_cedula',
        'ac_nombres',
        'ac_apellidos',
        'ac_celular',
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
        'direccion' => 'string',
        'ac_cedula' => 'string',
        'ac_nombres' => 'string',
        'ac_apellidos' => 'string',
        'ac_celular' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'cedula' => 'required|numeric',
        'nombres' => 'required',
        'apellidos' => 'required',
        'celular' => 'required',
        'ac_cedula' => ''
    ];
    /**
     * Relaciones entre Modelos
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

    public function getAcFullNameAttribute()
    {
       return $this->ac_nombres . ' ' . $this->ac_apellidos;
    }
}
