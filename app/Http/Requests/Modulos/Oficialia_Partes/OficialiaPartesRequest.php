<?php

namespace App\Http\Requests\Modulos\Oficialia_Partes;

use Illuminate\Foundation\Http\FormRequest;

class OficialiaPartesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                             
                'id_dependencia' => 'required|nozero',
                'id_tipo_documento' => 'required|nozero',
                'numero' => 'required',                
                'fecha' => 'required|',
                'id_destinatario' => 'required|nozero'
        ];
    }
}
