<?php

namespace App\Http\Controllers\Coordinacion\Recibidos;
use App\Http\Requests\Modulos\Oficialia_Partes\OficialiaPartesRequest;
use App\Http\Models\DocumentoExterno;
use App\Http\Models\Destinatario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class PrincipalController extends Controller
{
    private $route= 'coo.principal'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Recibidos / <span class="badge badge-success"><span class="fa fa-send"></span> Principal</span> ');      
        view()->share('current_route', $this->route);        
    }

    public function index()
    {        
       return view('modulos.coordinacion.recibidos.principal', []);
    }
}
