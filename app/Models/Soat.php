<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslatorDocumentosVehiculo;
use App\Traits\VigenteTrait;
/**
 * Class Soat
 * @package App\Models
 * @version May 29, 2017, 6:18 am UTC
 */
class Soat extends Model
{
    use DatesTranslatorDocumentosVehiculo, VigenteTrait, SoftDeletes;

    public $table = 'soats';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'vehiculo_id',
        'poliza',
        'fecha_expedicion',
        'fecha_vigencia_inicio',
        'fecha_vigencia_final',
        'entidad',
        'tomador_nombre',
        'tomador_cedula',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'vehiculo_id' => 'integer',
        'poliza' => 'string',
        'fecha_expedicion' => 'string',
        'fecha_vigencia_inicio' => 'string',
        'fecha_vigencia_final' => 'string',
        'entidad' => 'string',
        'tomador_nombre' => 'string',
        'tomador_cedula' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'vehiculo_id' => 'required',
        'poliza' => 'required',
        'fecha_expedicion' => 'date|required',
        'fecha_vigencia_inicio' => 'date|required',
        'fecha_vigencia_final' => 'date|required',
        'tomador_cedula' => 'numeric'
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
