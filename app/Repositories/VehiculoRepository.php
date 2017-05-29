<?php

namespace App\Repositories;

use App\Models\Vehiculo;
use InfyOm\Generator\Common\BaseRepository;

class VehiculoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'placa',
        'propietario_nombre',
        'propietario_cedula',
        'poseedor_nombre',
        'poseedor_cedula',
        'numero_interno',
        'capacidad',
        'modelo',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Vehiculo::class;
    }
}
