<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SimuladorGasto
 * @package App\Models
 * @version June 14, 2017, 4:13 am COT
 */
class SimuladorGasto extends Model
{
    use SoftDeletes;

    public $table = 'simulador_gastos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'min',
        'max',
        'inversion',
        'llantas_completas',
        'motor_caja_trasmision',
        'ajuste_pintura',
        'rodamiento',
        'cojineria_vidrios',
        'lavado',
        'carroceria',
        'salario_conductor',
        'prestaciones_sociales',
        'seguridad_social',
        'soat',
        'tecnicomecanica',
        'revision_bimensual',
        'contractual',
        'extracontractual',
        'acpm_galon',
        'gasolina_galon',
        'galones_kilometro',
        'aceites_filtros',
        'aditivos',
        'baterias',
        'impuesto_rodamiento',
        'impuesto_semaforizacion',
        'parqueo',
        'tramites_varios',
        'administracion',
        'plan_reposicion_equipo',
        'sistema_comunicacion',
        'gps',
        'margen',
        'otros',
        'user_id'

    ];
    /**
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'min' => 'integer',
        'max' => 'integer',
        'margen' => 'integer',
        'user_id' => 'integer'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        
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
