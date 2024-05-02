<?php
namespace App\Http\Requests\Modulos\Direccion;
use Illuminate\Foundation\Http\FormRequest;

class BitacoraRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                             
            'fecha_documento' => 'required',
            'id_tipo_documento' => 'required|nozero',
            'id_dependencia' => 'required|nozero',
            'folio' => 'required',                
            'destinatario' => 'required',
            'cargo_destinatario' => 'required',
            'asunto' => 'required'
        ];
    }
}