<?php

namespace App\Http\Controllers\Oficialia\AsignacionDirecta;
use App\Http\Requests\Modulos\Oficialia_Partes\OficialiaPartesRequest;
use App\Http\Models\DocumentoExterno;
use App\Http\Models\Destinatario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class EnviadosController extends Controller
{
    private $route= 'oop.enviados'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Asignacion directa / <span class="badge badge-success"><span class="fa fa-send"></span> Enviados</span> ');      
        view()->share('current_route', $this->route);        
    }

    public function index()
    {        
       return view('modulos.oficialia_partes.asignacion_directa.enviados', []);
    }

    public function edit($id)
    {         
        $datos = DocumentoExterno::find($id); 
        $dependencias= \App\Http\Models\Catalogos\C_Dependencia::lists();
        $tipos_documentos= \App\Http\Models\Catalogos\C_Tipo_Documento::lists(['id_clasificacion'=>2]);
        $destinatarios= \App\Http\Models\Catalogos\C_Area::lists_sec_subsec();
        $datos['fecha']= \App\Http\Classes\clsFormatDates::formatDates($datos['fecha'],1);
        $doctos= \App\Http\Models\Anexo::search(['id_documento_externo'=>$id])->get();

        return view('modulos.oficialia_partes.borradores.edit', ['datos'=> $datos, 'dependencias'=>$dependencias, 'tipos_documentos'=>$tipos_documentos, 'destinatarios'=>$destinatarios, 'doctos'=>$doctos]);
    }     
}
