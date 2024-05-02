<?php

namespace App\Http\Controllers\Oficialia\AsignacionDirecta;
use App\Http\Requests\Modulos\Oficialia_Partes\OficialiaPartesRequest;
use App\Http\Models\DocumentoExterno;
use App\Http\Models\Destinatario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class BorradoresController extends Controller
{
    private $route= 'oop.borradores'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Asignacion directa / <span class="badge badge-primary"><span class="fa fa-eraser"></span> Borradores</span> ');      
        view()->share('current_route', $this->route);
        view()->share('icono', 'school');
        view()->share('texto', 'Debera proporcionar la información relativa a las instituciones educativas hasta los cinco últimos grados de escolaridad, iniciando con la más reciente.');          
    }

    public function index()
    {
        //print_r(1); exit();
       return view('modulos.oficialia_partes.asignacion_directa.borradores', []);
    }

    public function create()
    {         
        $dependencias= \App\Http\Models\Catalogos\C_Dependencia::lists();
        $tipos_documentos= \App\Http\Models\Catalogos\C_Tipo_Documento::lists(['id_clasificacion'=>2]);
        $destinatarios= \App\Http\Models\Catalogos\C_Area::lists_sec_subsec();
        return view('modulos.oficialia_partes.asignacion_directa.create', ['dependencias'=>$dependencias, 'tipos_documentos'=>$tipos_documentos, 'destinatarios'=>$destinatarios]);
    } 

    public function edit($id)
    {         
        $datos = DocumentoExterno::find($id); 
        $dependencias= \App\Http\Models\Catalogos\C_Dependencia::lists();
        $tipos_documentos= \App\Http\Models\Catalogos\C_Tipo_Documento::lists(['id_clasificacion'=>2]);
        $destinatarios= \App\Http\Models\Catalogos\C_Area::lists_sec_subsec();
        $datos['fecha']= \App\Http\Classes\clsFormatDates::formatDates($datos['fecha'],1);
        $doctos= \App\Http\Models\Anexo::search(['id_documento_externo'=>$id])->get();

        return view('modulos.oficialia_partes.asignacion_directa.edit', ['datos'=> $datos, 'dependencias'=>$dependencias, 'tipos_documentos'=>$tipos_documentos, 'destinatarios'=>$destinatarios, 'doctos'=>$doctos]);
    }        

}
