<?php

namespace App\Repositories;

use App\Models\LicenciaConduccion;
use InfyOm\Generator\Common\BaseRepository;

class LicenciaConduccionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'fecha_expedicion',
        'a1',
        'a2',
        'b1',
        'b2',
        'b3',
        'c1',
        'c2',
        'c3',
        'user_id',
        'natural_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LicenciaConduccion::class;
    }
}
