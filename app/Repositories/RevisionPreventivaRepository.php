<?php

namespace App\Repositories;

use App\Models\RevisionPreventiva;
use InfyOm\Generator\Common\BaseRepository;

class RevisionPreventivaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vehiculo_id',
        'fecha_vigencia_inicio',
        'fecha_vigencia_final',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RevisionPreventiva::class;
    }
}
