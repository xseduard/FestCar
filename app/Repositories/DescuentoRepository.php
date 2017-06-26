<?php

namespace App\Repositories;

use App\Models\Descuento;
use InfyOm\Generator\Common\BaseRepository;

class DescuentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Descuento::class;
    }

    public function descuento_id(){                        
           return Descuento::lists('nombre', 'id');
    }
}
