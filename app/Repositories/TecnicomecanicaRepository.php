<?php

namespace App\Repositories;

use App\Models\Tecnicomecanica;
use InfyOm\Generator\Common\BaseRepository;

class TecnicomecanicaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vehiculo_id',
        'codigo_control',
        'cda_nombre',
        'cda_nit',
        'consecutivo_runt',
        'fecha_expedicion',
        'fecha_vencimiento'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tecnicomecanica::class;
    }
}
