<?php
/**************************************************
Name: EnviadoController.php
Autor name: Sandro Alan Gomez Aceituno
Creation date: Mart 26 de Noviembre de 2019
Description: Controlador principal, Enviados Titulares
***************************************************/
namespace App\Http\Controllers\Titulares;
use App\Http\Classes\clsTools;
use App\Http\Requests\Modulos\Direccion\BorradorRequest;
use App\Http\Models\Catalogos\C_Dependencia;
use App\Http\Models\Catalogos\C_Tipo_Documento;
use App\Http\Models\Catalogos\C_Area;
use App\Http\Models\Catalogos\C_Cargo;
use App\Http\Models\DocumentoInterno;
use App\Http\Models\Destinatario;
use App\Http\Models\Folio;
use App\Http\Models\Turnado;
use App\Http\Models\Anexo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class EnviadoController extends Controller
{
    private $route= 'ttl.enviados'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Enviados');
        view()->share('current_route', $this->route);       
    }

    public function search(Request $vrequest)
    {  
        $vstatus=200;
        $vfiltros=array();
        $vrespuesta=array();
        $vdocumentos=array();
        $vrespuesta['codigo']=1;
        $vrespuesta['mensaje']='Especificar el tipo de accion.';
        try {
            $vfiltro=array();
            $vaccion=$vrequest->input('method');
            switch ($vaccion) {
                case 'show':
                    # code...
                    $vfiltros['id_documento_interno']=$vrequest->input('id_documentos_internos');
                    $vrespuesta['respuesta']=DocumentoInterno::search($vfiltros)->first();
                  break;                
                case 'get':
                    # code...
                    $vfiltros['sended_at']=true;
                    $vfiltros['acusado']=$vrequest->input('acusado');
                    $vfiltros['id_area_envia']=Auth::User()->id_area;

                    $vdocumentos=DocumentoInterno::search($vfiltros)->get();

                    // $vtipo_documento=$vrequest->input('id_tipo_documento');
                    // if(isset($vtipo_documento)){
                    //     switch($vtipo_documento){
                    //         case 2: 
                    //             $vfiltros['id_tipo_documento']=2;
                    //             $vdocumentos=DocumentoInterno::search($vfiltros)->get();
                    //           break;
                    //         case 3: 
                    //             $vfiltros['id_tipo_documento']=3;
                    //             $vdocumentos=DocumentoInterno::search($vfiltros)->get();
                    //           break;
                    //         case 7: 
                    //             $vfiltros['id_area']=Auth::User()->id_area;
                    //             $vdocumentos=Folio::internos($vfiltros)->get();
                    //           break;
                    //         case 100: 
                    //             $vfiltros['id_area']=Auth::User()->id_area;
                    //             $vdocumentos=Folio::internos($vfiltros)->get();
                    //           break;
                    //     }
                    // }
                  break;
            }
            $vrespuesta['respuesta']=$vdocumentos;
            if(count($vdocumentos) < 0) {
                $vrespuesta['codigo']=0;
                $vrespuesta['mensaje']='No existen registros que mostrar.';
            }
        }
        catch(Exception $vexception ){
            $vstatus=500;
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']='Ocurrio un error al mostrar los datos, intente de nuevo';
            $vrespuesta['response']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

    public function index()
    {
       return view('modulos.titulares.enviados.index');
    }

    public function acusados()
    {
       return view('modulos.titulares.enviados.acusados', ['titulo'=>'Acusados']);
    }

    public function show($vid)
    {
        $vflDestinatario=array();
        $vflCargos=array();

        $vfiltros['id_documento_interno']=$vid;
        $vflDocumentoAnexo=Anexo::search($vfiltros)->get();
        $vflRespuesta=DocumentoInterno::search($vfiltros)->first();
        
        $vfiltros['id_tipo_envio']=1;
        $vflDestinatario=Destinatario::internos($vfiltros)->get();
        if($vflRespuesta->id_tipo_documento==3) $vflCargos=C_Cargo::search()->get();
    
        $vfiltros['id_tipo_envio']=2;
        $vflCopias=Destinatario::internos($vfiltros)->get();

        return view('modulos.titulares.enviados.show', [
            'respuesta'=>$vflRespuesta,
            'destinatarios'=>$vflDestinatario,
            'cargos'=>$vflCargos,
            'anexos'=>$vflDocumentoAnexo,
            'copias'=>$vflCopias,
            'internos'=>true
        ]);
    }


    public function data($vid, $vtipo)
    {
        $vflDocumentoAnexo=array();
        $vflRespuesta=array();
        $vflDestinatarios=array();
        $vflCopias=array();
        
        

        if(($vtipo==2) || ($vtipo==3)) {

        }
        if( $vtipo==7 ) {
            $vfiltro['id_documento_externo']=$vid;
        }
        if( $vtipo==100 ) {
            $vfiltros['id_folio']=$vid;
            
            $vflRespuesta=Folio::internos($vfiltros)->first();
            $vfiltro['id_documento_interno']=$vid;

        }
        
        $vflDocumentoAnexo=Anexo::search($vfiltro)->get();

        $vfiltros['id_tipo_envio']=1;
        $vflDestinatarios=Turnado::internos($vfiltros)->get();
        $vfiltros['id_tipo_envio']=2;
        $vflCopias=Turnado::internos($vfiltros)->get();
        
        return view('modulos.titulares.enviados.show', [
            'respuesta'=>$vflRespuesta,
            'destinatarios'=>$vflDestinatarios,
            'anexos'=>$vflDocumentoAnexo,
            'copias'=>$vflCopias,
            'internos'=>false
        ]);
    }
}