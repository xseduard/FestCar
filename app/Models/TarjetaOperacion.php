<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslatorDocumentosVehiculo;
use App\Traits\VigenteTrait;



/**
 * Class TarjetaOperacion
 * @package App\Models
 * @version May 29, 2017, 8:04 pm UTC
 */
class TarjetaOperacion extends Model
{
    use DatesTranslatorDocumentosVehiculo, VigenteTrait, SoftDeletes;

    public $table = 'tarjeta_operacions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'vehiculo_id',
        'codigo',
        'modalidad_servicio',
        'radio_accion',
        'razon_social_empresa',
        'nit',
        'direccion',
        'entidad_expide',
        'fecha_expedicion',
        'fecha_vigencia_inicio',
        'fecha_vigencia_final',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'vehiculo_id' => 'integer',
        'codigo' => 'string',
        'modalidad_servicio' => 'string',
        'radio_accion' => 'string',
        'razon_social_empresa' => 'string',
        'nit' => 'string',
        'direccion' => 'string',
        'entidad_expide' => 'string',
        'fecha_expedicion' => 'string',
        'fecha_vigencia_inicio' => 'string',
        'fecha_vigencia_final' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'vehiculo_id' => 'required',
        'codigo' => 'required|numeric',
        'razon_social_empresa' => 'required',
        'nit' => 'required',
        'fecha_expedicion' => 'required|date',
        'fecha_vigencia_inicio' => 'required|date',
        'fecha_vigencia_final' => 'required|date|after:fecha_vigencia_inicio'
    ];
    /**
     * Ascensores
     */


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
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Funciones Especiales
     */
}
