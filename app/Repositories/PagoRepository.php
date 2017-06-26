<?php

namespace App\Repositories;

use App\Models\Pago;
use InfyOm\Generator\Common\BaseRepository;

class PagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cps_id',
        'contrato_vinculacion',
        'fecha_planilla',
        'fecha_inicio',
        'fecha_final',
        'desc_transaccion',
        'desc_finca',
        'desc_admin',
        'cuatro_por_mil',
        'desc_sobrecosto',
        'irregularidad',
        'subtotal',
        'total',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pago::class;
    }
}
