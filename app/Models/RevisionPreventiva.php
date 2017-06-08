<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslatorDocumentosVehiculo;
use App\Traits\VigenteTrait;
/**
 * Class RevisionPreventiva
 * @package App\Models
 * @version May 29, 2017, 9:06 pm UTC
 */
class RevisionPreventiva extends Model
{
    use DatesTranslatorDocumentosVehiculo, VigenteTrait, SoftDeletes;

    public $table = 'revision_preventivas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'vehiculo_id',
        'entidad_nombre',
        'entidad_nit',
        'fecha_vigencia_inicio',
        'fecha_vigencia_final',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'vehiculo_id' => 'integer',
        'entidad_nombre' => 'string',
        'entidad_nit' => 'string',
        'fecha_vigencia_inicio' => 'string',
        'fecha_vigencia_final' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'vehiculo_id' => 'required',
        'fecha_vigencia_inicio' => 'required|date',
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

    /**
     * Funciones Especiales
     */
}
