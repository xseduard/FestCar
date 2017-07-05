<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PagoRelDescuento
 * @package App\Models
 * @version June 25, 2017, 8:30 pm COT
 */
class PagoRelDescuento extends Model
{
    use SoftDeletes;

    public $table = 'pago_rel_descuentos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'pago_id',
        'descuento_id',
        'valor',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'pago_id' => 'integer',
        'descuento_id' => 'integer',
        'valor' => 'integer',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    public function descuento(){
        return $this->belongsTo('App\Models\Descuento');
    }
    public function pago(){
        return $this->belongsTo('App\Models\Pago');
    }

    /**
     * Funciones Especiales
     */
}
