<?php

namespace App\Repositories;

use App\Models\PqrsSeguimiento;
use InfyOm\Generator\Common\BaseRepository;

class PqrsSeguimientoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pqrs_id',
        'asunto',
        'mensaje',
        'tipo',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PqrsSeguimiento::class;
    }
}
