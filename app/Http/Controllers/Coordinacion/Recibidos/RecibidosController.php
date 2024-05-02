<?php

namespace App\Http\Controllers\Coordinacion\Recibidos;
use App\Http\Requests\Modulos\Oficialia_Partes\OficialiaPartesRequest;
use App\Http\Models\Destinatario;
use App\Http\Models\DocumentoExterno;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class RecibidosController extends Controller
{
    private $route= 'coo.recibidos'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Recibidos');      
        view()->share('current_route', $this->route);        
    }

    public function getResultados($bandeja){
        $resultados= [];
        if($bandeja==1){
            $areas= [];
            if(Auth::User()->hasRole(['Coordinacion'])){
                $areas= [Auth::User()->id_area, 1];
            }
            $resultados = Destinatario::search_oficialia(['areas'=>$areas, 'id_tipo_envio'=>1, 'id_status'=>1])->get();
        }

        return $resultados;
    } 

          

    
}
