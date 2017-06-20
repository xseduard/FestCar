<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslator;

/**
 * Class Recibo
 * @package App\Models
 * @version June 16, 2017, 3:05 pm COT
 */
class Recibo extends Model
{
    use DatesTranslator, SoftDeletes;

    public $table = 'recibos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'natural_id',
        'modo_pago',
        'descuento',
        'incremento',
        'observaciones',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'natural_id' => 'integer',
        'modo_pago' => 'string',
        'observaciones' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'natural_id' => 'required',
        'modo_pago' => 'required'
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
    public function natural(){
        return $this->belongsTo('App\Models\Natural');
    }
    public function articulos(){
        return $this->hasMany('App\Models\ReciboDetalle', 'recibo_id', 'id');
    }

    /**
     * Funciones Especiales
     */
}
