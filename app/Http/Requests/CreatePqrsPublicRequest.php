<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\PqrsWeb;

class CreatePqrsPublicRequest extends Request
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
     * Obtienes las reglas que se aplican a la solicitud (Request).
     *
     * @return array
     */
    public function rules()
    { 
        $array = PqrsWeb::$rules;
        $array['g-recaptcha-response'] = "required|recaptcha";   
        return $array;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [
        'tipo_documento' => 'tipo de documento',
        'cedula' => 'cédula',        
        'observacion' => 'observaciones / comentarios',
        'g-recaptcha-response' => 'Captcha',
        ];
    }
    /*
    $FIELDS$
    */
}
