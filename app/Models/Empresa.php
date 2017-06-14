<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Empresa
 * @package App\Models
 * @version June 14, 2017, 12:31 am COT
 */
class Empresa extends Model
{
    use SoftDeletes;

    public $table = 'empresas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * Estos atributos son casteados en su tipo nativo.
     */
    protected $casts = [
        'nit' => 'string',
        'nombre_corto' => 'string',
        'razon_social' => 'string',
        'rte_nombre' => 'string',
        'rte_apellido' => 'string',
        'rte_cedula' => 'string',
        'rte_cedula_ref' => 'string',
        'correo' => 'string',
        'direccion' => 'string',
        'direccion_corta' => 'string',
        'ciudad' => 'string',
        'departamento' => 'string',
        'rte_cedula_ref_departamento' => 'string',
        'telefono' => 'string',
        'celular' => 'string',
        'cuota_admin' => 'string',
        'cuota_admin_valor' => 'string',
        'cuota_admin_valor_dos' => 'string',
        'pagina_web' => 'string',
        'version' => 'string',
        'observaciones' => 'string'
    ];
    /**
     * Reglas de Validacón
     */
    public static $rules = [
        'nit' => 'required|numeric',
        'nombre_corto' => 'required',
        'razon_social' => 'required',
        'rte_nombre' => 'required',
        'rte_apellido' => 'required',
        'rte_cedula' => 'required|numeric',
        'rte_cedula_ref' => 'required',
        'correo' => 'required',
        'direccion' => 'required',
        'direccion_corta' => 'required',
        'ciudad' => 'required',
        'departamento' => 'required',
        'rte_cedula_ref_departamento' => 'required',
        'telefono' => 'required|numeric',
        'celular' => '',
        'cuota_admin' => '',
        'cuota_admin_valor' => '',
        'cuota_admin_valor_dos' => '',
        'pagina_web' => 'required',
        'version' => '',
        'observaciones' => ''
    ];
    /**
     * Relaciones entre Modelos
     */
    /*
    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }
    */
    

    /**
     * Ascensores
     */

    public function getFullNameAttribute()
    {
       return $this->rte_nombre . ' ' . $this->rte_apellido;
    }
    public function getLugarExpedicionAttribute()
    {
       return $this->rte_cedula_ref . ', ' . $this->rte_cedula_ref_departamento;
    }
    public function getDomicilioAttribute()
    {
       return $this->ciudad . ', ' . $this->departamento;
    }
}
