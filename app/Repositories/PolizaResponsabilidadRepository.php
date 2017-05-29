<?php

namespace App\Repositories;

use App\Models\PolizaResponsabilidad;
use InfyOm\Generator\Common\BaseRepository;

class PolizaResponsabilidadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vehiculo_id',
        'codigo',
        'fecha_vigencia_inicio',
        'fecha_vigencia_final',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PolizaResponsabilidad::class;
    }
}
