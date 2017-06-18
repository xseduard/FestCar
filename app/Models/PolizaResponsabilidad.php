<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslatorDocumentosVehiculo;
use App\Traits\VigenteTrait;

/**
 * Class PolizaResponsabilidad
 * @package App\Models
 * @version May 29, 2017, 9:00 pm UTC
 */
class PolizaResponsabilidad extends Model
{
    use DatesTranslatorDocumentosVehiculo, VigenteTrait, SoftDeletes;

    public $table = 'poliza_responsabilidads';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'vehiculo_id',
        'codigo',
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
        'fecha_vigencia_inicio' => 'string',
        'fecha_vigencia_final' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'vehiculo_id' => 'required',
        'fecha_vigencia_inicio' => '',
        'fecha_vigencia_final' => 'required|date'
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
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Funciones Especiales
     */
}
