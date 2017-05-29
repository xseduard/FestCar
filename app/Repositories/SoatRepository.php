<?php

namespace App\Repositories;

use App\Models\Soat;
use InfyOm\Generator\Common\BaseRepository;

class SoatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vehiculo_id',
        'poliza',
        'fecha_expedicion',
        'fecha_vigencia_inicio',
        'fecha_vigencia_final',
        'entidad',
        'tomador_nombre',
        'tomador_cedula',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Soat::class;
    }
}
