<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pago
 * @package App\Models
 * @version June 25, 2017, 8:16 pm COT
 */
class Pago extends Model
{
    use SoftDeletes;

    public $table = 'pagos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cps_id',
        'contrato_vinculacion_id',
        'fecha_planilla',
        'fecha_inicio',
        'fecha_final',
        'desc_transaccion',
        'desc_finca',
        'desc_admin',
        'cuatro_por_mil',
        'desc_sobrecosto',
        'irregularidad',
        'subtotal',
        'total',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'cps_id' => 'integer',
        'contrato_vinculacion_id' => 'integer',
        'fecha_planilla' => 'date',
        'fecha_inicio' => 'date',
        'fecha_final' => 'date',
        'desc_transaccion' => 'integer',
        'desc_finca' => 'integer',
        'cuatro_por_mil' => 'boolean',
        'desc_sobrecosto' => 'integer',
        'irregularidad' => 'boolean',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'cps_id' => 'required',
        'fecha_planilla' => 'date',
        'fecha_inicio' => 'date',
        'fecha_final' => 'date'
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
