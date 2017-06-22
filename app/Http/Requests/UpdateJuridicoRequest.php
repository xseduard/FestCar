<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Juridico;

class UpdateJuridicoRequest extends Request
{

    /**
     * Determine si el usuario está autorizado para realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  Obtienes las reglas que se aplican a la solicitud (Request).
     *
     * @return array
     */
    public function rules()
    {        
        $array = Juridico::$rules;
        $array['nit'] = "";
         return $array;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        "natural_id" => "Representante Legal",
        "nombre" => "Nombre o Razón Social",
        "municipio_id" => "Ciudad/Departamento",    
        ];
    }
    /*
    $FIELDS$
    */
}
