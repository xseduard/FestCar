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
        'tarjetaoperacion_id',
        'soat_id',
        'tecnicomecanica_id',
        'polizaresponsabilidad_id',
        'contratovinculacion_id',
        'observaciones',
        'conductor_uno',
        'conductor_dos',
        'conductor_tres',
        'f_licencia_uno',
        'f_licencia_dos',
        'f_licencia_tres',
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
        'tarjetaoperacion_id' => 'integer',
        'soat_id' => 'integer',
        'tecnicomecanica_id' => 'integer',
        'polizaresponsabilidad_id' => 'integer',
        'contratovinculacion_id' => 'integer',
        'observaciones' => 'string',
        'conductor_uno' => 'integer',
        'conductor_dos' => 'integer',
        'conductor_tres' => 'integer',
        'f_licencia_uno' => 'string',
        'f_licencia_dos' => 'string',
        'f_licencia_tres' => 'string',
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
    public function tarjetaoperacion(){
        return $this->belongsTo('App\Models\TarjetaOperacion', 'tarjetaoperacion_id');
    }
    public function soat(){
        return $this->belongsTo('App\Models\Soat', 'soat_id');
    }
    public function tecnicomecanica(){
        return $this->belongsTo('App\Models\Tecnicomecanica', 'tecnicomecanica_id');
    }
    public function polizaresponsabilidad(){
        return $this->belongsTo('App\Models\PolizaResponsabilidad', 'polizaresponsabilidad_id');
    }
    public function contratovinculacion(){
        return $this->belongsTo('App\Models\ContratoVinculacion', 'contratovinculacion_id');
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
