<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslator;
use App\Traits\DatesTranslatorContrato;


/**
 * Class ContratoVinculacion
 * @package App\Models
 * @version May 30, 2017, 5:15 am UTC
 */
class ContratoVinculacion extends Model
{
    use DatesTranslator, DatesTranslatorContrato, SoftDeletes;


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
        'responsable_id',
        'user_id',
        'aprobado',
        'fecha_aprobacion',
        'usuario_aprobacion',
        'rl_id',
        'rl_id_ref',
        'rl_name',
        'rl_lastname',

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
        'responsable_id' => 'string',
        'tipo_cuenta_bancaria' => 'string',
        'numero_cuenta_bancaria' => 'string',
        'entidad_bancaria' => 'string',
        'user_id' => 'integer',
        'aprobado' => 'boolean',
        'fecha_aprobacion' => 'datetime',
        'usuario_aprobacion' => 'integer',
        'rl_id' =>  'string',
        'rl_id_ref' =>  'string',
        'rl_name'   =>  'string',
        'rl_lastname'   =>  'string',
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
        'fecha_final' => 'required|date|after:fecha_inicio',
        'responsable_id' => 'required',
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
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function usuario_aprueba(){
        return $this->belongsTo('App\User', 'usuario_aprobacion');
    }

    public function responsable(){
        return $this->belongsTo('App\Models\Natural', 'responsable_id');
    }
    

    /**
     * Funciones Especiales
     */

      /**
     * Ascensor
     */

    public function getRlFullNameAttribute()
    {
       return $this->rl_name . ' ' . $this->rl_lastname;
    }

    public function getExistResponsableAttribute()
    {
        if ($this->responsable_id > 0) {
            return true;
        } else {
            return false;
        }
       
    }
}
