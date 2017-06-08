<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Jenssegers\Date\Date;

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
        'natural_id' => 'required|unique:licencia_conduccions,natural_id',
        'fecha_expedicion' => 'required|date',
        'a1' => '',
        'a2' => '',
        'b1' => '',
        'b2' => '',
        'b3' => '',
        'c1' => '',
        'c2' => '',
        'c3' => '',        
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
     * Ascensor C2 y C3
     */
        public function getFechaExpedicionAttribute($fecha_expedicion)
    {
        return new Date($fecha_expedicion);
    }
        public function getVigenteAttribute()
    {       

        if ($this->c2 >=  Carbon::now() || $this->c3 >=  Carbon::now()) {
            return true;
        } else {
            return false;
        }
    }

        public function getFechaVigenciaAttribute()
    {      

         if ($this->c3 >= Carbon::now()) {
            return new Date($this->c3);               
            } elseif ($this->c2 >= Carbon::now()) {
                return new Date($this->c2); 
            } else {
                if ($this->c3 > $this->c2) {
                     return new Date($this->c3);
                } else {
                    return new Date($this->c2);
                }
            }
        
    }

    /**
     * Funciones Especiales
     */
}
