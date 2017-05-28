<?php

namespace App\Repositories;

use App\Models\Juridico;
use InfyOm\Generator\Common\BaseRepository;

class JuridicoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nit',
        'nombre',
        'natural_id',
        'actividad',
        'telefono',
        'direccion_fiscal',
        'direccion_envio',
        'email',
        'observaciones',
        'estado',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Juridico::class;
    }
}
