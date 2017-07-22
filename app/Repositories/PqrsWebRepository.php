<?php

namespace App\Repositories;

use App\Models\PqrsWeb;
use InfyOm\Generator\Common\BaseRepository;

class PqrsWebRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_documento',
        'cedula',
        'nombres',
        'apellidos',
        'celular',
        'ciudad',
        'correo',
        'motivo',
        'servicio',
        'observacion',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PqrsWeb::class;
    }
}
