<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ReciboProducto
 * @package App\Models
 * @version June 16, 2017, 12:06 pm COT
 */
class ReciboProducto extends Model
{
    use SoftDeletes;

    public $table = 'recibo_productos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'precio',
        'stock',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'nombre' => 'string',
        'stock' => 'integer',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'nombre' => 'required',
        'precio' => ''
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
