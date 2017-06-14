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
        'cedula' => 'like',
        'nombres' => 'like',
        'apellidos' => 'like'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Natural::class;
    }
}
