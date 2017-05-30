<?php

namespace App\Repositories;

use App\Models\ContratoVinculacion;
use InfyOm\Generator\Common\BaseRepository;

class ContratoVinculacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_contrato',
        'tipo_proveedor',
        'natural_id',
        'juridico_id',
        'vehiculo_id',
        'servicio',
        'fecha_inicio',
        'fecha_final',
        'user_id',
        'aprobado',
        'fecha_aprobacion',
        'usuario_aprobacion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContratoVinculacion::class;
    }
}
