<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PagoRelFactura
 * @package App\Models
 * @version June 25, 2017, 8:26 pm COT
 */
class PagoRelFactura extends Model
{
    use SoftDeletes;

    public $table = 'pago_rel_facturas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'pago_id',
        'factura_id',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'pago_id' => 'integer',
        'factura_id' => 'integer',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'factura_id' => ''
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    public function factura(){
        return $this->belongsTo('App\Models\Factura');
    }
    public function pago(){
        return $this->belongsTo('App\Models\Pago');
    }

    /**
     * Funciones Especiales
     */
}
