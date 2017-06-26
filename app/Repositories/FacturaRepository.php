<?php

namespace App\Repositories;

use App\Models\Factura;
use InfyOm\Generator\Common\BaseRepository;

class FacturaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'fecha_inicio',
        'fecha_final',
        'total',
        'observacion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Factura::class;
    }
}
