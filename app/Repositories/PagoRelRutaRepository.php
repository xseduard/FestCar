<?php

namespace App\Repositories;

use App\Models\PagoRelRuta;
use InfyOm\Generator\Common\BaseRepository;

class PagoRelRutaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pago_id',
        'ruta_id',
        'valor_final',
        'cantidad_viajes',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PagoRelRuta::class;
    }
}
