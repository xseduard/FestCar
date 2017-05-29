<?php

namespace App\Repositories;

use App\Models\Tarjeta_Propiedad;
use InfyOm\Generator\Common\BaseRepository;

class Tarjeta_PropiedadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vehiculo_id',
        'licencia_transito',
        'marca',
        'linea',
        'cilindrada',
        'color',
        'servicio',
        'clase_vehiculo',
        'tipo_carroceria',
        'combustible',
        'numero_motor',
        'numero_serie',
        'numero_chasis',
        'restriccion_movilidad',
        'blindaje',
        'potencia_hp',
        'declaracion_importacion',
        'fecha_importacion',
        'puertas',
        'fecha_matricula',
        'fecha_expedicion',
        'organismo_transito'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tarjeta_Propiedad::class;
    }
}
