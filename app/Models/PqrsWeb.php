<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PqrsWeb
 * @package App\Models
 * @version July 21, 2017, 2:33 pm COT
 */
class PqrsWeb extends Model
{
    use SoftDeletes;

    public $table = 'pqrs_webs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_documento',
        'cedula',
        'nombres',
        'apellidos',
        'celular',
        'ciudad',
        'correo',
        'motivo',
        'servicio',
        'estado',
        'observacion',
        'easy_token',
        'user_id'
    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'tipo_documento' => 'string',
        'cedula' => 'string',
        'nombres' => 'string',
        'apellidos' => 'string',
        'celular' => 'string',
        'ciudad' => 'string',
        'correo' => 'string',
        'motivo' => 'string',
        'estado' => 'string',
        'servicio' => 'string',
        'observacion' => 'string',
        'easy_token' => 'integer',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'tipo_documento' => 'required',
        'cedula' => 'required|numeric',
        'nombres' => 'required',
        'apellidos' => 'required',
        'celular' => 'required',
        'ciudad' => 'required',
        'correo' => 'required|email',
        'motivo' => 'required',
        'observacion' => 'required'
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */

    public function seguimiento(){
        return $this->hasMany('App\Models\PqrsSeguimiento', 'pqrs_id');
    }
    

    /**
     * Ascensores & Mutadores
     */

    public function getTypeMotivoAttribute()
    {     
        switch ($this->motivo) {
            case 'p':
                return 'Petición';
                break;
            case 'Q':
                return 'Queja';
                break;
            case 'R':
                return 'Reclamo';
                break;
            case 'S':
                return 'Solicitud';
                break;
            case 'C':
                return 'Consulta';
                break;
            case 'F':
                return 'Felicitación';
                break;
            default:
                return 'No Disponible';
                break;
        }
        
    }

    public function getTypeServicioAttribute()
    {     
        switch ($this->servicio) {
            case 's1':
                return 'Empresarial';
                break;
            case 's2':
                return 'Escolar';
                break;
            case 's3':
                return 'Grupo de usuarios';
                break;
            case 's4':
                return 'Salud';
                break;
            case 's5':
                return 'Turismo';
                break;
           
            default:
                return 'No Disponible';
                break;
        }
        
    }     

    public function getFullNameAttribute()
    {
       return $this->nombres . ' ' . $this->apellidos;
    }
}
