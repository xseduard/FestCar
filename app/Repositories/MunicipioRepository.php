<?php

namespace App\Repositories;

use App\Models\Municipio;
use App\Models\Departamento;
use InfyOm\Generator\Common\BaseRepository;

class MunicipioRepository extends BaseRepository
{
   
    protected $fieldSearchable = [
        'nombre',
        'id_departamento'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Municipio::class;
    }

   

    public static function selDepartamento_re(){
        $modelo = Departamento::all()->toArray();
            foreach ($modelo as $key => $value) {
                $array[$value['id']]=$value['nombre'];
            }
        return ($array);
    }
}
