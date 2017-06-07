<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ContratoPrestacionServicio
 * @package App\Models
 * @version May 30, 2017, 8:05 am UTC
 */
class ContratoPrestacionServicio extends Model
{
    use SoftDeletes;

    public $table = 'contrato_prestacion_servicios';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_cliente',
        'natural_id',
        'juridico_id',
        'origen_id',
        'destino_id',
        'servicio',
        'tipo_cuenta_bancaria',
        'numero_cuenta_bancaria',
        'entidad_bancaria',
        'aprobado',
        'fecha_aprobacion',
        'usuario_aprobacion',
        'fecha_inicio',
        'fecha_final',
        'responsable_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'tipo_cliente' => 'string',
        'natural_id' => 'integer',
        'juridico_id' => 'integer',
        'origen_id' => 'integer',
        'destino_id' => 'integer',
        'servicio' => 'string',
        'tipo_cuenta_bancaria' => 'string',
        'numero_cuenta_bancaria' => 'string',
        'entidad_bancaria' => 'string',
        'aprobado' => 'boolean',
        'fecha_aprobacion' => 'datetime',
        'usuario_aprobacion' => 'integer',
        'fecha_inicio' => 'string',
        'fecha_final' => 'string',
        'responsable_id' => 'string'
        
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'tipo_cliente' => 'required',
        'origen_id' => 'required',
        'destino_id' => 'required',
        'servicio' => 'required',
        'tipo_cuenta_bancaria' => 'required',
        'numero_cuenta_bancaria' => 'required',
        'entidad_bancaria' => 'required',
        'usuario_aprobacion' => '',
        'fecha_inicio' => 'required|date',
        'fecha_final' => 'required|date',
        'responsable_id' => ''
    ];
    /**
     * Ascensores
     */

    public function getContratistaIdAttribute()
    {
        if ($this->tipo_cliente == "Natural") {
           return $this->natural_id;
        } elseif ($this->tipo_cliente == "Juridico") {
             return$this->juridico_id;
        }
       
    }
    /**
     * Relaciones entre Modelos
     */
    /*
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
    public function origen(){
        return $this->belongsTo('App\Models\Municipio');
    } 
    public function destino(){
        return $this->belongsTo('App\Models\Municipio');
    }   
    public function usuario(){
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
}
