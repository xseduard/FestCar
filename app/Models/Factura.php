<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Factura
 * @package App\Models
 * @version June 25, 2017, 7:33 pm COT
 */
class Factura extends Model
{
    use SoftDeletes;

    public $table = 'facturas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'codigo',
        'fecha_inicio',
        'fecha_final',
        'total',
        'observacion',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'codigo' => 'integer',
        'fecha_inicio' => 'date',
        'fecha_final' => 'date',
        'observacion' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'codigo' => 'required',
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
    public function pagorelfactura(){
        return $this->hasMany('App\Models\PagoRelFactura');
    }
    
    /**
     * Funciones Especiales
     */
}
