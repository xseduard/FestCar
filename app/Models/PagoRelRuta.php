<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PagoRelRuta
 * @package App\Models
 * @version June 25, 2017, 8:35 pm COT
 */
class PagoRelRuta extends Model
{
    use SoftDeletes;

    public $table = 'pago_rel_rutas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'pago_id',
        'ruta_id',
        'valor_final',
        'cantidad_viajes',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'pago_id' => 'integer',
        'ruta_id' => 'integer',
        'cantidad_viajes' => 'integer',
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
    public function ruta(){
        return $this->belongsTo('App\Models\Ruta');
    }
    public function pago(){
        return $this->belongsTo('App\Models\Pago');
    }

    /**
     * Funciones Especiales
     */
}
