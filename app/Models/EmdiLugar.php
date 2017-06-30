<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslator;

/**
 * Class EmdiLugar
 * @package App\Models
 * @version June 30, 2017, 12:05 am COT
 */
class EmdiLugar extends Model
{
    use DatesTranslator, SoftDeletes;

    public $table = 'emdi_lugars';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'telefono',
        'direccion',
        'municipio_id',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'nombre' => 'string',
        'telefono' => 'string',
        'direccion' => 'string',
        'municipio_id' => 'integer',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'nombre' => 'required'
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
