<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslator;

/**
 * Class ContratoVinculacion
 * @package App\Models
 * @version May 30, 2017, 5:15 am UTC
 */
class ContratoVinculacion extends Model
{
    use DatesTranslator, SoftDeletes;


    public $table = 'contrato_vinculaciones';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_contrato',
        'tipo_proveedor',
        'natural_id',
        'juridico_id',
        'vehiculo_id',
        'servicio',        
        'tipo_cuenta_bancaria',
        'numero_cuenta_bancaria',
        'entidad_bancaria',
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
        'fecha_inicio' => 'string',
        'fecha_final' => 'string',
        'tipo_cuenta_bancaria' => 'string',
        'numero_cuenta_bancaria' => 'string',
        'entidad_bancaria' => 'string',
        'user_id' => 'integer',
        'aprobado' => 'boolean',
        'fecha_aprobacion' => 'datetime',
        'usuario_aprobacion' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'tipo_contrato' => 'required',
        'tipo_proveedor' => 'required',
        'vehiculo_id' => 'required',
        'natural_id' => 'required_if:tipo_proveedor,Natural',
        'juridico_id' => 'required_if:tipo_proveedor,Juridico',
        'servicio' => 'required',
        'tipo_cuenta_bancaria' => 'required',
        'numero_cuenta_bancaria' => 'required',
        'entidad_bancaria' => 'required',
        'fecha_inicio' => 'required|date',
        'fecha_final' => 'required|date'
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    // REGLA SEGURA?: 'tipo_proveedor' => 'required_unless:tipo_contrato,CC',    
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */

    public function natural(){
        return $this->belongsTo('App\Models\Natural');
    }
    public function juridico(){
        return $this->belongsTo('App\Models\Juridico');
    }
    public function vehiculo(){
        return $this->belongsTo('App\Models\Vehiculo');
    }
    public function usuario(){
        return $this->belongsTo('App\User');
    }
    public function usuario_aprueba(){
        return $this->belongsTo('App\User', 'usuario_aprobacion');
    }
    

    /**
     * Funciones Especiales
     */
}
