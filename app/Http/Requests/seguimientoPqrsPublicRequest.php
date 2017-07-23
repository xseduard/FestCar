<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
// use App\Models\PqrsWeb;

class SeguimientoPqrsPublicRequest extends Request
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
        $array['radicado'] = 'required';
        if (config('app.env') == 'production') 
        {
            $array['g-recaptcha-response'] = "required|recaptcha";   
        }
        return $array;
    }

    /**
     * Atributos (Nombres que se muestran en las alertas)
     */
    public function attributes() {
        return [   
        'radicado' => 'Número Radicado',
        'g-recaptcha-response' => 'Captcha',
        ];
    }
    /*
    $FIELDS$
    */
}
