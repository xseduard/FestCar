<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ReciboDetalle
 * @package App\Models
 * @version June 16, 2017, 4:31 pm COT
 */
class ReciboDetalle extends Model
{
    use SoftDeletes;

    public $table = 'recibo_detalles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'recibo_id',
        'recibo_producto_id',
        'cantidad',
        'precio_final',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'recibo_id' => 'integer',
        'recibo_producto_id' => 'integer',
        'cantidad' => 'integer',
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
    public function producto(){
        return $this->belongsTo('App\Models\ReciboProducto', 'recibo_producto_id');
    }
    

    /**
     * Funciones Especiales
     */
}
