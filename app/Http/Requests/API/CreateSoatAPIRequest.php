<?php

namespace App\Http\Requests\API;

use App\Models\Soat;
use InfyOm\Generator\Request\APIRequest;

class CreateSoatAPIRequest extends APIRequest
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
     * NOMBRES DE VARAIBLES EN CASO DE ERROR
     */
    public function attributes() {
        return [

         "" => "",
         "" => "",
    
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Soat::$rules;
    }
}
