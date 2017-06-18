<?php

namespace App\Repositories;

use App\Models\ReciboProducto;
use InfyOm\Generator\Common\BaseRepository;

class ReciboProductoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'precio',
        'stock'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ReciboProducto::class;
    }

    public function recibo_producto_id()
    {
        return ReciboProducto::lists('nombre', 'id');
    }
}
