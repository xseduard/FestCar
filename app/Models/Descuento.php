<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Descuento
 * @package App\Models
 * @version June 25, 2017, 7:27 pm COT
 */
class Descuento extends Model
{
    use SoftDeletes;

    public $table = 'descuentos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'descripcion',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'nombre' => 'string',
        'descripcion' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'nombre' => 'required'
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    public function pagoreldescuento(){
        return $this->hasMany('App\Models\PagoRelDescuento');
    }

    /**
     * Funciones Especiales
     */
}
