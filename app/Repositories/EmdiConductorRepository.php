<?php

namespace App\Repositories;

use App\Models\EmdiConductor;
use InfyOm\Generator\Common\BaseRepository;

class EmdiConductorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cedula',
        'nombres',
        'apellidos',
        'celular',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EmdiConductor::class;
    }
}
