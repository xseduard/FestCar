<?php

namespace App\Repositories;

use App\Models\PagoRelDescuento;
use InfyOm\Generator\Common\BaseRepository;

class PagoRelDescuentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pago_id' => 'LIKE',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PagoRelDescuento::class;
    }
}
