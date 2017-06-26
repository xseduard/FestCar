<?php

namespace App\Repositories;

use App\Models\PagoRelFactura;
use InfyOm\Generator\Common\BaseRepository;

class PagoRelFacturaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pago_id',
        'factura_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PagoRelFactura::class;
    }
}
