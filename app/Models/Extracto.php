<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Extracto
 * @package App\Models
 * @version June 1, 2017, 8:50 am UTC
 */
class Extracto extends Model
{
    use SoftDeletes;

    public $table = 'extractos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'codigo',
        'ContratoPrestacionServicio_id',
        'recorrido',
        'conductor_uno',
        'conductor_dos',
        'conductor_tres',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'codigo' => 'integer',
        'ContratoPrestacionServicio_id' => 'integer',
        'recorrido' => 'string',
        'conductor_uno' => 'integer',
        'conductor_dos' => 'integer',
        'conductor_tres' => 'integer',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'ContratoPrestacionServicio_id' => 'required',
        'recorrido' => 'required',
        'conductor_uno' => 'required',
        'conductor_dos' => '',
        'conductor_tres' => ''
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
       public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }

    */
    public function usuario(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function conductoruno(){
        return $this->belongsTo('App\Models\Natural', 'conductor_uno');
    }
     public function cps(){
        return $this->belongsTo('App\Models\ContratoPrestacionServicio');
    }
    

    /**
     * Funciones Especiales
     */
}
