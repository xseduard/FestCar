<?php

namespace App\Repositories;

use App\Models\EmdiPaciente;
use InfyOm\Generator\Common\BaseRepository;

class EmdiPacienteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cedula' => 'like',
        'nombres' => 'like',
        'apellidos' => 'like',
        'celular' => 'like',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EmdiPaciente::class;
    }
}
