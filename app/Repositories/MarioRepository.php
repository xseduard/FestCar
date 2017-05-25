<?php

namespace App\Repositories;

use App\Models\Mario;
use InfyOm\Generator\Common\BaseRepository;

class MarioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        "texto",
        "numero"
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Mario::class;
    }
}
