<?php

namespace App\Repositories;

use App\Models\Departamento;
use InfyOm\Generator\Common\BaseRepository;

class DepartamentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Departamento::class;
    }

    public static function selDepartamento(){
        $modelo = Departamento::all()->toArray();
            foreach ($modelo as $key => $value) {
                $array[$value['id']]=$value['nombre'];
            }
        return ($array);
    }
}
