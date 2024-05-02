<?php

namespace App\Http\Controllers\Oficialia\Conocimiento;
use App\Http\Requests\Modulos\Oficialia_Partes\OficialiaPartesRequest;
use App\Http\Models\DocumentoExterno;
use App\Http\Models\Destinatario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class EnviadosController extends Controller
{
    private $route= 'oopc.enviados'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Conocimiento / <span class="badge badge-warning"><span class="fa fa-send"></span> Enviados</span> ');      
        view()->share('current_route', $this->route);    
    }

    public function index()
    {
       return view('modulos.oficialia_partes.conocimiento.enviados', []);
    }
}
