<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ContratoVinculacion
 * @package App\Models
 * @version May 30, 2017, 5:15 am UTC
 */
class ContratoVinculacion extends Model
{
    use SoftDeletes;

    public $table = 'contrato_vinculaciones';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_contrato',
        'tipo_proveedor',
        'natural_id',
        'juridico_id',
        'vehiculo_id',
        'servicio',
        'fecha_inicio',
        'fecha_final',
        'user_id',
        'aprobado',
        'fecha_aprobacion',
        'usuario_aprobacion'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'tipo_contrato' => 'string',
        'tipo_proveedor' => 'string',
        'natural_id' => 'integer',
        'juridico_id' => 'integer',
        'vehiculo_id' => 'integer',
        'servicio' => 'string',
        'fecha_inicio' => 'date',
        'fecha_final' => 'date',
        'user_id' => 'integer',
        'aprobado' => 'boolean',
        'usuario_aprobacion' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'tipo_contrato' => 'required',
        'vehiculo_id' => 'required',
        'servicio' => 'required',
        'fecha_inicio' => 'required',
        'fecha_final' => 'required'
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
     * Funciones Especiales
     */
}
