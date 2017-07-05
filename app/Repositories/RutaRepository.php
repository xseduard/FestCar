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
        'nombre' => 'like',
        'distancia' => 'like',
        'duracion' => 'like',
        'valor_sugerido' => 'like',
        //'predefinido'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Ruta::class;
    }
}
