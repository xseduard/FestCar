<?php

namespace App\Repositories;

use App\Models\Recibo;
use InfyOm\Generator\Common\BaseRepository;

class ReciboRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'natural_id',
        'modo_pago',
        'descuento',
        'incremento',
        'observaciones'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Recibo::class;
    }
}
