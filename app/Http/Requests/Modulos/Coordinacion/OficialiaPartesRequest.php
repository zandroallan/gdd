<?php

namespace App\Http\Requests\Modulos\Coordinacion;

use Illuminate\Foundation\Http\FormRequest;

class OficialiaPartesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $array1= [                             
                'id_dependencia' => 'required|nozero',
                'id_tipo_documento' => 'required|nozero',
                'numero' => 'required',                
                'fecha' => 'required|',
                'id_destinatario' => 'required|nozero',
                'remitente' => 'required',
                'id_cargo' => 'required|nozero' 
        ];

        if($this->input('turnar')==1)
        {
            $array2=
            [ 
                'id_area_responde' => 'required|nozero',
                'fecha_vencimiento' => 'required',
                'indicaciones' => 'required'                
            ];

            $array1= array_merge($array1, $array2);
        }


        return $array1;
    }
}
