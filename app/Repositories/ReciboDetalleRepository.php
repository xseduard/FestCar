<?php

namespace App\Repositories;

use App\Models\ReciboDetalle;
use InfyOm\Generator\Common\BaseRepository;

class ReciboDetalleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'recibo_id',
        'recibo_producto_id',
        'cantidad',
        'precio_final'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ReciboDetalle::class;
    }
}
