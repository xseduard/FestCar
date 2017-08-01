<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Natural;

class UpdateNaturalRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $array = Natural::$rules;
        $array['cedula'] = "";
        // $array['cedula'] = "required|unique:naturales,cedula,".$this->route('naturals');
         return $array;
        
    }
     /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
         "cedula" => "Documento de Identidad",
         "municipio_id" => "Lugar de Expedición",
         'direccion' => 'dirección',
         'direccion_municipio' => 'ciudad/departamento',
    
    ];
    }
}
