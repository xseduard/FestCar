<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LicenciaConduccion
 * @package App\Models
 * @version June 1, 2017, 6:18 am UTC
 */
class LicenciaConduccion extends Model
{
    use SoftDeletes;

    public $table = 'licencia_conduccions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'natural_id',
        'fecha_expedicion',
        'a1',
        'a2',
        'b1',
        'b2',
        'b3',
        'c1',
        'c2',
        'c3',
        'user_id'
        
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'natural_id' => 'integer',
        'fecha_expedicion' => 'string',
        'a1' => 'string',
        'a2' => 'string',
        'b1' => 'string',
        'b2' => 'string',
        'b3' => 'string',
        'c1' => 'string',
        'c2' => 'string',
        'c3' => 'string',
        'user_id' => 'integer'        
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'natural_id' => 'required',
        'fecha_expedicion' => 'required|date',
        'a1' => 'date',
        'a2' => 'date',
        'b1' => 'date',
        'b2' => 'date',
        'b3' => 'date',
        'c1' => 'date',
        'c2' => 'date',
        'c3' => 'date',        
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    public function natural(){
        return $this->belongsTo('App\Models\Natural');
    }

    /**
     * Funciones Especiales
     */
}
