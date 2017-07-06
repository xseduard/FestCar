<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslator;

use Jenssegers\Date\Date;

/**
 * Class Pago
 * @package App\Models
 * @version June 25, 2017, 8:16 pm COT
 */
class Pago extends Model
{
    use DatesTranslator, SoftDeletes;

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
        'fecha_final' => 'date|after:fecha_inicio',
        'desc_transaccion' => 'integer',
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
        'contrato_vinculacion_id' => 'required',
        'fecha_planilla' => 'date',
        'fecha_inicio' => 'date',
        'fecha_final' => 'date'
    ];
    /**
     * Relaciones entre Modelos
     */
    // return $this->belongsToMany('App\Models\Factura', 'pago_rel_facturas')->withPivot('pago_id', 'factura_id');
     public function pagorelfactura(){
        return $this->hasMany('App\Models\PagoRelFactura');
    }

     public function pagorelruta(){
        return $this->hasMany('App\Models\PagoRelRuta');
    }

    public function pagoreldescuento(){
        return $this->hasMany('App\Models\PagoRelDescuento');
    }

    public function contratovinculacion(){
        return $this->belongsTo('App\Models\ContratoVinculacion', 'contrato_vinculacion_id', 'id');
    }
    public function cps(){
        return $this->belongsTo('App\Models\ContratoPrestacionServicio', 'cps_id', 'id');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    //Express relationship
    public function express_factura(){
        return $this->belongsToMany('App\Models\Factura', 'pago_rel_facturas');
    }
     public function express_ruta(){
        return $this->belongsToMany('App\Models\Ruta', 'pago_rel_rutas');
    }
    public function express_descuento(){
        return $this->belongsToMany('App\Models\Descuento', 'pago_rel_descuentos');
    }


    

    /**
     * Funciones Especiales
     */

    public function getFechaPlanillaAttribute($fecha_planilla)
    {
        return new Date($fecha_planilla);
    }

    public function getFechaInicioAttribute($fecha_inicio)
    {
        return new Date($fecha_inicio);
    }

    public function getFechaFinalAttribute($fecha_final)
    {
        return new Date($fecha_final);
    }
}
