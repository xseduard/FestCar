<?php

namespace App\Repositories;

use App\Models\Juridico;
use InfyOm\Generator\Common\BaseRepository;

class JuridicoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nit' => 'like',
        'nombre' => 'like',      
        'email' => 'like',
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Juridico::class;
    }
}
