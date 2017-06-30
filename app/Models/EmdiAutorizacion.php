<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslator;
use Jenssegers\Date\Date;
use Carbon\Carbon;

/**
 * Class EmdiAutorizacion
 * @package App\Models
 * @version June 30, 2017, 12:18 am COT
 */
class EmdiAutorizacion extends Model
{
    use DatesTranslator, SoftDeletes;

    public $table = 'emdi_autorizacions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'ruta',
        'paciente_id',
        'cita_fecha',
        'cita_hora',
        'cita_lugar_id',
        'conductor_id',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'ruta' => 'string',
        'paciente_id' => 'integer',
        'cita_fecha' => 'date',
        'cita_hora' => 'string',
        'cita_lugar_id' => 'integer',
        'conductor_id' => 'integer',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'ruta' => 'required',
        'paciente_id' => 'required',
        'cita_fecha' => 'date|required',
        'cita_hora' => 'required',
        'cita_lugar_id' => 'required',
        'conductor_id' => 'required'
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

    public function paciente(){
        return $this->belongsTo('App\Models\EmdiPaciente');
    }
    public function lugar(){
        return $this->belongsTo('App\Models\EmdiLugar', 'cita_lugar_id');
    }
     public function conductor(){
        return $this->belongsTo('App\Models\EmdiConductor', 'conductor_id');
    }

    /**
     * Funciones Especiales
     */

    public function getCitaFechaAttribute($cita_fecha)
    {
        return new Date($cita_fecha);
    }



}
