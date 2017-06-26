<?php

namespace App\Repositories;

use App\Models\Ruta;
use InfyOm\Generator\Common\BaseRepository;

class RutaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'distancia',
        'duracion',
        'valor_sugerido',
        'predefinido',
        'descripcion',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Ruta::class;
    }
}
