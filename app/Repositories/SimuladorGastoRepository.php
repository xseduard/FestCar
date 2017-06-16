<?php

namespace App\Repositories;

use App\Models\SimuladorGasto;
use InfyOm\Generator\Common\BaseRepository;

class SimuladorGastoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        'otros'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SimuladorGasto::class;
    }
}
