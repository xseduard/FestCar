<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PqrsWeb
 * @package App\Models
 * @version July 21, 2017, 2:33 pm COT
 */
class PqrsWeb extends Model
{
    use SoftDeletes;

    public $table = 'pqrs_webs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_documento',
        'cedula',
        'nombres',
        'apellidos',
        'celular',
        'ciudad',
        'correo',
        'motivo',
        'servicio',
        'observacion',
        'short_token',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'tipo_documento' => 'string',
        'cedula' => 'string',
        'nombres' => 'string',
        'apellidos' => 'string',
        'celular' => 'string',
        'ciudad' => 'string',
        'correo' => 'string',
        'motivo' => 'string',
        'servicio' => 'string',
        'observacion' => 'string',
        'short_token' => 'integer',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'tipo_documento' => 'required',
        'cedula' => 'required|numeric',
        'nombres' => 'required',
        'apellidos' => 'required',
        'celular' => 'required',
        'ciudad' => 'required',
        'correo' => 'required|email',
        'motivo' => 'required',
        'observacion' => 'required'
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
     * Ascensores & Mutadores
     */
}
