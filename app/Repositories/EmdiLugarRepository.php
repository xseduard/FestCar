<?php

namespace App\Repositories;

use App\Models\EmdiLugar;
use InfyOm\Generator\Common\BaseRepository;

class EmdiLugarRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'telefono',
        'direccion',
        'municipio_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EmdiLugar::class;
    }
}
