<?php

namespace App\Repositories;

use App\Models\ContratoPrestacionServicio;
use InfyOm\Generator\Common\BaseRepository;

class ContratoPrestacionServicioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_cliente',
        'natural_id',
        'juridico_id',
        'origen_id',
        'destino_id',
        'servicio',
        'tipo_cuenta_bancaria',
        'numero_cuenta_bancaria',
        'entidad_bancaria',
        'aprobado',
        'fecha_aprobacion',
        'usuario_aprobacion',
        'fecha_inicio',
        'fecha_final'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContratoPrestacionServicio::class;
    }
}
