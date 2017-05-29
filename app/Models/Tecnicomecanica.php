<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tecnicomecanica
 * @package App\Models
 * @version May 29, 2017, 7:11 pm UTC
 */
class Tecnicomecanica extends Model
{
    use SoftDeletes;

    public $table = 'tecnicomecanicas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'vehiculo_id',
        'codigo_control',
        'cda_nombre',
        'cda_nit',
        'consecutivo_runt',
        'fecha_expedicion',
        'fecha_vencimiento',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'vehiculo_id' => 'integer',
        'codigo_control' => 'string',
        'cda_nombre' => 'string',
        'cda_nit' => 'string',
        'consecutivo_runt' => 'string',
        'fecha_expedicion' => 'string',
        'fecha_vencimiento' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'vehiculo_id' => 'required',
        'codigo_control' => 'numeric',
        'cda_nombre' => '',
        'cda_nit' => '',
        'fecha_expedicion' => 'required|date',
        'fecha_vencimiento' => 'required|date'
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    public function vehiculo(){
        return $this->belongsTo('App\Models\Vehiculo');
    }

    /**
     * Funciones Especiales
     */
}
