<?php

namespace App\Repositories;

use App\Models\Municipio;
use InfyOm\Generator\Common\BaseRepository;

class MunicipioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'id_departamento'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Municipio::class;
    }
}
