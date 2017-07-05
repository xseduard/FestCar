<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ruta
 * @package App\Models
 * @version June 25, 2017, 7:50 pm COT
 */
class Ruta extends Model
{
    use SoftDeletes;

    public $table = 'rutas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'distancia',
        'duracion',
        'valor_sugerido',
        'predefinido',
        'descripcion',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'nombre' => 'string',
        'duracion' => 'integer',
        'valor_sugerido' => 'integer',
        'predefinido' => 'boolean',
        'descripcion' => 'string',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'nombre' => 'required',
        'predefinido' => 'required'
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    public function pagorelruta(){
        return $this->hasMany('App\Models\PagoRelRuta');
    }

    /**
     * Funciones Especiales
     */
}
