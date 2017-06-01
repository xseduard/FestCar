<?php

namespace App\Repositories;

use App\Models\Extracto;
use InfyOm\Generator\Common\BaseRepository;

class ExtractoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'ContratoPrestacionServicio_id',
        'recorrido',
        'conductor_uno',
        'conductor_dos',
        'conductor_tres',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Extracto::class;
    }
}
