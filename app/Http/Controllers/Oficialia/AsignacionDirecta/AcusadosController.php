<?php

namespace App\Http\Controllers\Oficialia\AsignacionDirecta;
use App\Http\Requests\Modulos\Oficialia_Partes\OficialiaPartesRequest;
use App\Http\Models\DocumentoExterno;
use App\Http\Models\Destinatario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class AcusadosController extends Controller
{
    private $route= 'oop.acusados'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Asignacion directa / <span class="badge badge-success"><span class="fa fa-check-square"></span> Acusados</span> ');      
        view()->share('current_route', $this->route);       
    }

    public function index()
    {
       return view('modulos.oficialia_partes.asignacion_directa.acusados', []);
    }
}