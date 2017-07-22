<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PqrsSeguimiento
 * @package App\Models
 * @version July 22, 2017, 3:10 am COT
 */
class PqrsSeguimiento extends Model
{
    use SoftDeletes;

    public $table = 'pqrs_seguimientos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'pqrs_id',
        'asunto',
        'mensaje',
        'tipo',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'pqrs_id' => 'integer',
        'asunto' => 'string',
        'mensaje' => 'string',
        'tipo' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'pqrs_id' => 'required',
        'asunto' => 'required',
        'mensaje' => 'required'
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
