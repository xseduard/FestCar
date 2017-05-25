<?php

namespace App\Repositories;

use App\Models\Grado;
use InfyOm\Generator\Common\BaseRepository;

class GradoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        "titulo",
        "nivel",
        "periodo",
        "observaciones"
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Grado::class;
    }
}
