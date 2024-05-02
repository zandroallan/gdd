<?php

namespace App\Http\Controllers\Oficialia;
use App\Http\Requests\Modulos\Oficialia_Partes\OficialiaPartesRequest;
use App\Http\Models\DocumentoExterno;
use App\Http\Models\Destinatario;
use App\Http\Models\Catalogos\C_Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class AsignacionDirectaController extends Controller
{
    private $route= 'oop.asignacion-directa'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Asignación directa');
        view()->share('current_route', $this->route);       
    }

    public function getResultados($status){
        $data= ['enviado'=>$status, 'id_usuario'=>Auth::User()->id];
        if($status!=0){
            $data= ['enviado'=>$status, 'id_tipo_entrada'=>1, 'id_usuario'=>Auth::User()->id];
        }        
        $resultados = DocumentoExterno::search($data)->get();
        return $resultados;
    }

}
