<?php

namespace App\Repositories;

use App\Models\Empresa;
use InfyOm\Generator\Common\BaseRepository;

class EmpresaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nit',
        'nombre_corto',
        'razon_social',
        'rte_nombre',
        'rte_apellido',
        'rte_cedula',
        'rte_cedula_ref',
        'correo',
        'direccion',
        'direccion_corta',
        'ciudad',
        'departamento',
        'rte_cedula_ref_departamento',
        'telefono',
        'celular',
        'cuota_admin',
        'cuota_admin_valor',
        'cuota_admin_valor_dos',
        'pagina_web',
        'version',
        'observaciones'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Empresa::class;
    }
}
