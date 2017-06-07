<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTranslator;

/**
 * Class Extracto
 * @package App\Models
 * @version June 1, 2017, 8:50 am UTC
 */
class Extracto extends Model
{
    use DatesTranslator, SoftDeletes;

    public $table = 'extractos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'codigo',
        'ContratoPrestacionServicio_id',
        'vehiculo_id',
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
        'vehiculo_id' => 'integer',
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
        'vehiculo_id' => 'required',
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
    public function vehiculo(){
        return $this->belongsTo('App\Models\Vehiculo');
    }
    public function conductoruno(){
        return $this->belongsTo('App\Models\Natural', 'conductor_uno');
    }
    public function conductordos(){
        return $this->belongsTo('App\Models\Natural', 'conductor_dos');
    }
    public function conductortres(){
        return $this->belongsTo('App\Models\Natural', 'conductor_tres');
    }
     public function cps(){
        return $this->belongsTo('App\Models\ContratoPrestacionServicio', 'ContratoPrestacionServicio_id');
    }
    

    /**
     * Funciones Especiales
     */
}
