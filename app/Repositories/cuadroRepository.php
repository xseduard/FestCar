<?php

namespace App\Repositories;

use App\Models\cuadro;
use InfyOm\Generator\Common\BaseRepository;

class cuadroRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre_cuadro',
        'numero',
        'correo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return cuadro::class;
    }
}
