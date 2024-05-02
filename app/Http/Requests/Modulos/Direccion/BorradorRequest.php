<?php

namespace App\Http\Requests\Modulos\Direccion;

use Illuminate\Foundation\Http\FormRequest;

class BorradorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                             
                'id_tipo_documento' => 'required|nozero',
                //'id_destinatario' => 'required|nozero',
                'asunto' => 'required',                
                'cuerpo' => 'required|'
        ];
    }
}
