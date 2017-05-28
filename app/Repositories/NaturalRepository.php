<?php

namespace App\Repositories;

use App\Models\Natural;
use InfyOm\Generator\Common\BaseRepository;

class NaturalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cedula',
        'nombres',
        'apellidos',
        'correo',
        'telefono'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Natural::class;
    }
}
