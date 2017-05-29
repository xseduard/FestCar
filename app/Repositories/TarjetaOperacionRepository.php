<?php

namespace App\Repositories;

use App\Models\TarjetaOperacion;
use InfyOm\Generator\Common\BaseRepository;

class TarjetaOperacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vehiculo_id',
        'codigo',
        'modalidad_servicio',
        'radio_accion',
        'razon_social_empresa',
        'nit',
        'direccion',
        'fecha_expedicion',
        'fecha_vigencia_inicio',
        'fecha_vigencia_final',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TarjetaOperacion::class;
    }
}
