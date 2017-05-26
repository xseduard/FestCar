<?php

namespace App\Repositories;

use App\Models\triangulo;
use InfyOm\Generator\Common\BaseRepository;

class trianguloRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'texto',
        'numero'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return triangulo::class;
    }
}
