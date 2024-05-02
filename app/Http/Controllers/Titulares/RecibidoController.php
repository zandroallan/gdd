<?php
/**************************************************
Name: RecibidoController.php

Creation date: Mart 26 de Noviembre de 2019
Description: Controlador principal, Recibidos Titulares
***************************************************/
namespace App\Http\Controllers\Titulares;
use App\Http\Classes\clsTools;
use App\Http\Requests\Modulos\Direccion\BorradorRequest;
use App\Http\Classes\clsFormatDates;
use App\Http\Models\Catalogos\C_Dependencia;
use App\Http\Models\Catalogos\C_Tipo_Documento;
use App\Http\Models\Catalogos\C_Area;
use App\Http\Models\Anexo;
use App\Http\Models\Folio;
use App\Http\Models\Turnado;
use App\Http\Models\DocumentoInterno;
use App\Http\Models\DocumentoExterno;
use App\Http\Models\Destinatario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class RecibidoController extends Controller
{
    private $route= 'ttl.recibidos'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Recibidos');
        view()->share('current_route', $this->route);       
    }

    public function search(Request $vrequest)
    {  
        $vstatus=200;
        $vfiltros=array();
        $vrespuesta=array();        
        $vrespuesta['codigo']=1;
        $vrespuesta['respuesta']='Especificar el tipo de accion.';
        try {
            $vfiltro=array();
            $vaccion=$vrequest->input('method');
            switch ($vaccion) {
                case 'show':
                    # code...
                    $vfiltros['id_documento_interno']=$vrequest->input('id_documento_interno');
                    $vrespuesta['respuesta']=Destinatario::internos($vfiltros)->first();
                  break;                
                case 'get':
                    # code...                   
                    $vfiltros['id_area']=Auth::User()->id_area;                 
                    $vid_tipo_envio=$vrequest->input('id_tipo_envio');

                    $vflRespuesta=Destinatario::internos($vfiltros)->get();

                    //$vacuse=$vrequest->input('acuse');
                    //if(isset($vacuse)) $vfiltros['acuse']=$vacuse;
                    //if(isset($vid_tipo_envio)) $vfiltros['id_tipo_envio']=$vid_tipo_envio;

                    // $vtipo_documento=$vrequest->input('id_tipo_documento');
                    // if(isset($vtipo_documento)) {
                    //     if($vtipo_documento != 0) $vfiltros['id_tipo_documento']=$vtipo_documento; 
                    //     switch((int)$vtipo_documento){
                    //         case 0:
                    //             # code oficialia de partes
                    //             $vfiltros['externo']=true;
                    //             $vrespuesta['id_area']=Auth::User()->id_area;
                    //             if(Auth::User()->id_area==4) $vfiltros['id_area']=1;
                    //             $vflRespuesta=Destinatario::internos($vfiltros)->get();
                    //           break;
                    //         case 2:
                    //             # code memorandum
                    //             $vflRespuesta=Destinatario::internos($vfiltros)->get();
                    //           break;
                    //         case 3:
                    //             # code circular
                    //             $vflRespuesta=Destinatario::internos($vfiltros)->get();
                    //           break;
                    //         case 7:
                    //             # code folio
                    //             $vfiltros['id_area_envia']=4;
                    //             $vflRespuesta=Turnado::internos($vfiltros)->get();
                    //           break;
                    //         case 100:
                    //             # code folio
                    //             $vflRespuesta=Turnado::internos($vfiltros)->get();
                    //           break;
                    //     }
                    // }

                    if ( isset($vflRespuesta) ) {
                        if ( count($vflRespuesta) > 0 ) {
                            $vrespuesta['respuesta']=$vflRespuesta;
                        }
                        else {
                            $vrespuesta['codigo']=0;
                            $vrespuesta['respuesta']=$vrespuesta; //'No existen registros que mostrar.';
                        }
                    }                    
                  break;
            }
        }
        catch(Exception $vexception) {
            $vstatus=500;
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']='Ocurrio un error en el servidor, verifiquelo con el administrador del sistema.';
            $vrespuesta['response']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

    public function data($vid, $vtipo)
    {
        $vfiltro=array();
        $vflCopias=array();
        $vflDocumentoAnexo=array();
        $vflDestinatarios=array();

        if(($vtipo==2) || ($vtipo==3)) {
            $vfiltro['id_area']=Auth::User()->id_area;        
            $vfiltro['id_documento_interno']=$vid;
            $vflDestinatarios=Destinatario::internos($vfiltro)->first();
            $vid_destinatario=$vflDestinatarios->id_destinatario;
            $vacuse=$vflDestinatarios->acuse;
            unset($vflDestinatarios);

            $vflDestinatarios=Destinatario::findOrFail($vid_destinatario);
            $vflDestinatarios->es_nuevo=0;
            $vflDestinatarios->save();
            unset($vflDestinatarios);

            $vfiltros['id_documento_interno']=$vid;
            $vflDocumentoAnexo=Anexo::search($vfiltros)->get();
            $vflRespuesta=DocumentoInterno::search($vfiltros)->first();
            $vfiltros['id_tipo_envio']=1;
            $vflDestinatarios=Destinatario::internos($vfiltros)->get();
            $vfiltros['id_tipo_envio']=2;
            $vflCopias=Destinatario::internos($vfiltros)->get();

            $acuse=0;
            if($vacuse!=null) $acuse=1;

            // Obtener el folio
            $vflFolio=array();
            $vflFolio=Folio::internos(['id_documento_interno'=>$vid])->first();
        }
        if( $vtipo==7 ) {
            $vfiltro['id_folio']=$vid;
            $vfiltro['id_area']=Auth::User()->id_area;
            $vflDestinatarios=Turnado::internos($vfiltro)->first();
            $vid_destinatario=$vflDestinatarios->id_turnado;
            $vacuse=$vflDestinatarios->acuse;
            unset($vflDestinatarios);

            $vflDestinatarios=Turnado::findOrFail($vid_destinatario);
            $vflDestinatarios->es_nuevo=0;
            $vflDestinatarios->save();
            unset($vflDestinatarios);

            $vfiltros['id_folio']=$vid;
            //$vflDocumentoAnexo=Anexo::search($vfiltros)->get();
            $vflRespuesta=Folio::internos($vfiltros)->first();
            $vfiltros['id_tipo_envio']=1;
            $vflDestinatarios=Turnado::internos($vfiltros)->get();
            $vfiltros['id_tipo_envio']=2;
            $vflCopias=Turnado::internos($vfiltros)->get();

            $acuse=0;
            if($vacuse!=null) $acuse=1;

            // Obtener el folio
            $vflFolio=array();
            $vflFolio=$vflRespuesta; //Folio::internos(['id_folio' => $vid])->first();
        }
        if( $vtipo==100 ) {
            $vfiltro['id_folio']=$vid;
            $vfiltro['id_area']=Auth::User()->id_area;
            $vflDestinatarios=Turnado::internos($vfiltro)->first();
            $vid_destinatario=$vflDestinatarios->id_turnado;
            $vacuse=$vflDestinatarios->acuse;
            unset($vflDestinatarios);

            $vflDestinatarios=Turnado::findOrFail($vid_destinatario);
            $vflDestinatarios->es_nuevo=0;
            $vflDestinatarios->save();
            unset($vflDestinatarios);

            $vfiltros['id_folio']=$vid;
            //$vflDocumentoAnexo=Anexo::search($vfiltros)->get();
            $vflRespuesta=Folio::internos($vfiltros)->first();
            $vfiltros['id_tipo_envio']=1;
            $vflDestinatarios=Turnado::internos($vfiltros)->get();
            $vfiltros['id_tipo_envio']=2;
            $vflCopias=Turnado::internos($vfiltros)->get();

            $acuse=0;
            if($vacuse!=null) $acuse=1;

            // Obtener el folio
            $vflFolio=array();
            $vflFolio=Folio::internos(['id_documento_interno' => $vid])->first();
        }
        if( $vtipo==0 ) {
            // Codigo detalle para oficialia.
            // Siempre y cuando sea 0 el la variable vtipo.

            $vfiltro['id_area']=Auth::User()->id_area;
            if (Auth::User()->id_area==4) $vfiltro['id_area']=1;

            $vfiltro['id_documento_externo']=$vid;
            $vflDestinatarios=Destinatario::externos($vfiltro)->first();
            $vid_destinatario=$vflDestinatarios->id_destinatario;
            $vacuse=$vflDestinatarios->acuse;
            unset($vflDestinatarios);

            $vflDestinatarios=Destinatario::findOrFail($vid_destinatario);
            $vflDestinatarios->es_nuevo=0;
            $vflDestinatarios->save();
            unset($vflDestinatarios);

            $vfiltros['id_documento_externo']=$vid;
            $vflDocumentoAnexo=Anexo::search($vfiltros)->get();
            $vflRespuesta=DocumentoExterno::search($vfiltros)->first();
            $vfiltros['id_tipo_envio']=1;
            $vflDestinatarios=Destinatario::internos($vfiltros)->get();
            $vfiltros['id_tipo_envio']=2;
            $vflCopias=Destinatario::internos($vfiltros)->get();

            $acuse=0;
            if($vacuse!=null) $acuse=1;

            // Obtener el folio
            $vflFolio=array();
            $vflFolio=Folio::internos(['id_documento_externo' => $vid])->first();
        }

        return view('modulos.titulares.recibidos.show', [
            'respuesta'=>$vflRespuesta,
            'turnado'=>C_Area::destinatarios(['id_area'=>Auth::User()->id_area, 'tipo'=>'destinatario']),
            'destinatarios'=>$vflDestinatarios,
            'anexos'=>$vflDocumentoAnexo,
            'copias'=>$vflCopias,
            'folio'=>$vflFolio,
            'acuse'=>$acuse,
            'tipo'=>$vtipo,
            'internos'=>true
        ]);
    }

    public function acusar(Request $vrequest)
    {
        $vstatus=201;
        try {
            $vfiltro=array();
            $vflDestinatarios=array();
            $vid=$vrequest->input('id');
            $vtipo_documento=$vrequest->input('id_tipo_documento');
            if(isset($vtipo_documento)) {
                $vtipoDestinatario=1;
                $vfiltro['id_area']=Auth::User()->id_area;
                switch ($vtipo_documento) {
                    case 0:
                        # code - Oficialia de Partes
                        $vfiltro['id_documento_externo']=$vid;
                        $vfiltroAcuse['id_documento_externo']=$vid;
                        if (Auth::User()->id_area==4) $vfiltro['id_area']=1;
                      break;
                    case 2:
                        # code - Memorandums Internos
                        $vfiltro['id_documento_interno']=$vid;
                        $vfiltroAcuse['id_documento_interno']=$vid;
                      break;
                    case 3:
                        # code - Circular Internos
                        $vfiltro['id_documento_interno']=$vid;
                        $vfiltroAcuse['id_documento_interno']=$vid;
                      break;
                    case 7:
                        # code - Folios Coordinacion
                        $vtipoDestinatario=2;
                        $vfiltro['id_folio']=$vid;
                      break;
                    case 100:
                        # code - Folios Returnados
                        $vtipoDestinatario=2;
                        $vfiltro['id_folio']=$vid;
                      break;
                }

                if($vtipoDestinatario == 1) {
                    # Se obtiene el id_destinatario
                    $vflDestinatario=Destinatario::internos($vfiltro)->first();
                    $vid_destinatario=$vflDestinatario->id_destinatario;
                    unset($vflDestinatario);

                    # Acusa la persona y se guarda el registro
                    $vflDestinatario=Destinatario::findOrFail($vid_destinatario);
                    $vflDestinatario->acuse=date('Y-m-d H:i:s');
                    $vflDestinatario->id_usuario_acuse=Auth::User()->id;
                    $vflDestinatario->save();
                    unset($vflDestinatario);

                    # Verifica si han acusado todos
                    $vfiltroAcuse=array();
                    $vfiltroAcuse['acuse']=1;                    
                    $vflDestinatarioAcuses=Destinatario::internos($vfiltroAcuse)->get();

                    if((int)count($vflDestinatarioAcuses)==0) {
                        # Actualiza el registro acusado de la tabla t_documentos_internos
                        $vflDocumentoInterno=DocumentoInterno::findOrFail($vid);
                        $vflDocumentoInterno->acusado=1;
                        $vflDocumentoInterno->save();
                    }
                }
                else if($vtipoDestinatario == 2){
                    # Se obtiene el id_turnado
                    $vflDestinatarios=Turnado::internos($vfiltro)->first();
                    $vid_destinatario=$vflDestinatarios->id_turnado;
                    $vacuse=$vflDestinatarios->acuse;
                    unset($vflDestinatarios);

                    # Acusa la persona y se guarda el registro
                    $vflDestinatarios=Turnado::findOrFail($vid_destinatario);
                    $vflDestinatarios->acuse=date('Y-m-d H:i:s');
                    $vflDestinatarios->id_usuario_acuse=Auth::User()->id;
                    $vflDestinatarios->save();
                    unset($vflDestinatarios);
                }            
            }
            
            unset($vflDestinatarioAcuses);
            $vrespuesta['codigo']=1;
            $vrespuesta['respuesta']='Documento acusado correctamente.';
        }
        catch(Exception $vexception) {
            $vstatus=500;
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']='Ocurrio un error en el servidor, verifiquelo con el administrador del sistema.';
            $vrespuesta['response']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

    public function detail(Request $vrequest)
    {  
        $vstatus=200;
        $vfiltros=array();
        $vrespuesta=array();
        $vflRespuesta=array();
        $vflDocumentoAnexo=array();

        $vrespuesta['codigo']=1;        
        try {
            # code...
            // $vtipo_documento=$vrequest->input('id_tipo_documento');
            // if(isset($vtipo_documento)) {
                // if(($vtipo_documento==2) || ($vtipo_documento==3)) {
                    $vfiltros['id_documento_interno']=$vrequest->input('id');
                    $vflRespuesta=DocumentoInterno::search($vfiltros)->first();
                    $vflDocumentoAnexo=Anexo::search($vfiltros)->get();
                    $vfiltros['id_tipo_envio']=1;
                    $vflDestinatarios=Destinatario::internos($vfiltros)->get();
                    $vfiltros['id_tipo_envio']=2;
                    $vflCopias=Destinatario::internos($vfiltros)->get();
                // }
                // if( $vtipo_documento==100 ) {
                //     $vfiltros['id_folio']=$vrequest->input('id');
                //     $vflRespuesta=Folio::internos($vfiltros)->first();
                //     $vflDocumentoAnexo=Anexo::search($vfiltros)->get();
                //     $vfiltros['id_tipo_envio']=1;
                //     $vflDestinatarios=Turnado::internos($vfiltros)->get();
                //     $vfiltros['id_tipo_envio']=2;
                //     $vflCopias=Turnado::internos($vfiltros)->get();
                // }
                // if( $vtipo_documento==0 ) {
                    // Codigo detalle para oficialia.
                    // Siempre y cuando sea 0 el la variable vtipo.

                //     $vfiltros['id_documento_externo']=$vrequest->input('id');                    
                //     $vflRespuesta=DocumentoExterno::search($vfiltros)->first();
                //     $vflDocumentoAnexo=Anexo::search($vfiltros)->get();
                //     $vfiltros['id_tipo_envio']=1;
                //     $vflDestinatarios=Destinatario::internos($vfiltros)->get();
                //     $vfiltros['id_tipo_envio']=2;
                //     $vflCopias=Destinatario::internos($vfiltros)->get();
                // }
                // if( $vtipo_documento==7 ) {
                    // Codigo detalle para folios coordinacion.
                    // Siempre y cuando sea 7 el la variable vtipo.

                    // $vfiltros['id_folio']=$vrequest->input('id');
                    // $vfiltros['id_documento_externo']=$vrequest->input('id');
                    // $vflRespuesta=Folio::internos($vfiltros)->first();
                    // $vflDocumentoAnexo=Anexo::search($vfiltros)->get();
                    // $vfiltros['id_tipo_envio']=1;
                    // $vflDestinatarios=Turnado::internos($vfiltros)->get();
                    // $vfiltros['id_tipo_envio']=2;
                    // $vflCopias=Turnado::internos($vfiltros)->get();
                // }
                $vrespuesta['respuesta']=$vflRespuesta;
                $vrespuesta['anexos']=$vflDocumentoAnexo;
                $vrespuesta['destinatarios']=$vflDestinatarios;
                $vrespuesta['copias']=$vflCopias;
            // }
            // else {
            //     $vrespuesta['codigo']=0;
            //     $vrespuesta['respuesta']='No existen registros que mostrar.';
            // }
        }
        catch(Exception $vexception) {
            $vstatus=500;
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']='Ocurrio un error en el servidor, verifiquelo con el administrador del sistema.';
            $vrespuesta['response']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

    public function index() { return view('modulos.titulares.recibidos.index'); }

    public function copias() { return view('modulos.titulares.recibidos.copias', ['titulo'=>'Copias']); }

    public function acusados() { return view('modulos.titulares.recibidos.acusados', ['titulo'=>'Acusados']); }

    public function store(BorradorRequest $vrequest)
    {
        $vcodeHTTP=201;
        $vrespuesta=array();
        DB::beginTransaction();
        try {
            $vsend=$vrequest->only('sended_at');
            $vfirma=$vrequest->input('txtsignature');
            $vserie=$vrequest->input('txtserie');
            $vsecuencia=$vrequest->input('txtsecuencie');
            $vfecha_firma=$vrequest->input('txtsignedDate');
            $vflDocumentacionInterna=$vrequest->except(['cuerpo', 'sended_at']);

            if((isset($vflDocumentacionInterna['id'])) && ($vflDocumentacionInterna['id'] > 0)) 
                $vdlDocumentacionInterna=DocumentoInterno::findOrFail($vflDocumentacionInterna['id']);
            else
                $vdlDocumentacionInterna=new DocumentoInterno;
            $vflArea=C_Area::search(['id_area'=>Auth::User()->id_area])->first();
            $vresponsableArea=$vflArea->titulo.' '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno;

            // Begin create folio, y firmado
            if((isset($vsend['sended_at'])) && ($vsend['sended_at']!='')) {
                $vfiltros=array();
                $vfiltros['sended_at']=1;
                $vfiltros['id_area_envia']=Auth::User()->id_area;
                $vfiltros['id_tipo_documento']=$vrequest['id_tipo_documento'];
                $vtotalFolios=count(DocumentoInterno::verificarTotalFolio($vfiltros));
                $vfiltros['total_folios']=$vtotalFolios;
                $vflDocumentacionInterna['folio']=clsTools::generarFolioDocumentoInterno($vfiltros);
                $vflDocumentacionInterna['anio_folio']=date('Y');

                //Agregamos los datos de firma electronica
                $vflDocumentacionInterna['sended_at']=date('Y-m-d H:i:s');
                $vflDocumentacionInterna['firma']=$vfirma;
                $vflDocumentacionInterna['serie']=$vserie;
                $vflDocumentacionInterna['secuencia']=$vsecuencia;
                $vflDocumentacionInterna['fecha_firma']=$vfecha_firma;
            }
            // End create folio

            if(isset($vflDocumentacionInterna['id_destinatario']))
                $vflDocumentacionInterna['destinatario']= json_encode($vflDocumentacionInterna['id_destinatario']);        
            if(isset($vflDocumentacionInterna['ccp'])) 
                $vflDocumentacionInterna['ccp']=json_encode($vflDocumentacionInterna['ccp']); 
            $vflDocumentacionInterna['id_dependencia']=4;
            $vflDocumentacionInterna['id_area_aux']=0;
            $vflDocumentacionInterna['id_area_envia']=Auth::User()->id_area;            
            $vflDocumentacionInterna['id_usuario']=Auth::User()->id;
            $vflDocumentacionInterna['cuerpo']=$vrequest['cuerpo'];
            $vflDocumentacionInterna['area_responsable']=$vflArea->area;
            $vflDocumentacionInterna['cargo_responsable']=$vflArea->cargo;
            $vflDocumentacionInterna['responsable_area']=$vresponsableArea;
            $vdlDocumentacionInterna->fill($vflDocumentacionInterna)->save();
            unset($vflArea);

            if((isset($vsend['sended_at'])) && ($vsend['sended_at']!='')) {
                if(isset($vflDocumentacionInterna['id_destinatario'])) {
                    foreach($vflDocumentacionInterna['id_destinatario'] as $vareaDestino){
                        $vflArea=C_Area::search(['id_area'=>$vareaDestino])->first();
                        $vresponsableArea=$vflArea->titulo.' '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno;

                        $vflDestinatarios['id_documento_interno']=$vdlDocumentacionInterna->id;
                        $vflDestinatarios['id_area']=$vareaDestino;
                        $vflDestinatarios['area_responsable']=$vflArea->area;
                        $vflDestinatarios['cargo_responsable']=$vflArea->cargo;
                        $vflDestinatarios['responsable_area']=$vresponsableArea;
                        $vflDestinatarios['es_nuevo']=true;
                        $vflDestinatarios['id_tipo_envio']=1;

                        $vdlDestinatarios=new Destinatario;
                        $vdlDestinatarios->fill($vflDestinatarios)->save();
                        unset($vflArea, $vflDestinatarios, $vdlDestinatarios);
                    }
                }
                if(isset($vflDocumentacionInterna['ccp'])) {
                    foreach(json_decode($vflDocumentacionInterna['ccp']) as $vareaCopia) {
                        $vflArea=C_Area::search(['id_area'=>$vareaCopia])->first();
                        $vresponsableArea=$vflArea->titulo.' '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno;

                        $vflDestinatarios['id_documento_interno']=$vdlDocumentacionInterna->id;
                        $vflDestinatarios['id_area']=$vareaCopia;
                        $vflDestinatarios['responsable_area']=$vflArea->area;
                        $vflDestinatarios['cargo_responsable']=$vflArea->cargo;
                        $vflDestinatarios['responsable_area']=$vresponsableArea;
                        $vflDestinatarios['es_nuevo']=true;
                        $vflDestinatarios['id_tipo_envio']=2;

                        $vdlDestinatarios=new Destinatario;
                        $vdlDestinatarios->fill($vflDestinatarios)->save();
                        unset($vflArea, $vflDestinatarios, $vdlDestinatarios);
                    }
                }
            }

            // Subir archivos
            if($vrequest->hasFile('files')) {
                $id=$vdlDocumentacionInterna->id;
                $vflArea=C_Area::find(Auth::User()->id_area);
                $tipo_documento= \App\Http\Models\Catalogos\C_Tipo_Documento::find($vrequest['id_tipo_documento']);
                $ruta_de_archivos='';
                
                $path=storage_path().'/archivos/'.\App\Http\Classes\clsHerramientas::NormalizaURL($vflArea->area).'/'.date('Y').'/'.\App\Http\Classes\clsHerramientas::NormalizaURL($tipo_documento->nombre).'/'.$id;
                   
                $ruta_de_archivos='archivos/'.\App\Http\Classes\clsHerramientas::NormalizaURL($vflArea->area).'/'.date('Y').'/'.\App\Http\Classes\clsHerramientas::NormalizaURL($tipo_documento->nombre).'/'.$id;

                $i=1;
                $files=$vrequest->file('files');
                foreach($files as $file){
                    $vrespuesta['file']=true;
                    $fileName="Anexo-".$file->getClientOriginalName();
                    $tipo_archivo=$file->getClientOriginalExtension();
                    $size=$file->getClientSize();
                    $file->move($path, $fileName);

                    $vflDocumentacionAnexo['id_documento_interno']=$id;
                    $vflDocumentacionAnexo['peso']=$size;
                    $vflDocumentacionAnexo['path']=$ruta_de_archivos;
                    $vflDocumentacionAnexo['nombre']=$fileName;
                    $vflDocumentacionAnexo['extension']=$tipo_archivo;
                    
                    $vdlDocumentocionAnexo= new \App\Http\Models\Anexo;
                    $vdlDocumentocionAnexo->fill($vflDocumentacionAnexo)->save();
                    $i++;
                }
            } 
            //Fin subir archivos

            $vrespuesta['codigo']=1;
            $vrespuesta['id_documento_interno']=$vdlDocumentacionInterna->id;
            $vrespuesta['respuesta']='Datos registrados exitosamente.';
            unset($vflDocumentacionInterna, $vdlDocumentacionInterna);
            DB::commit();
        }
        catch(Exception $vexception) {
            $vcodeHTTP=500;
            DB::rollback();
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']='Problema con el servidor, verifiquelo con el administrador del sistema.';
            $vrespuesta['response']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vcodeHTTP);
    }

    public function returnar(Request $vrequest)
    {
        $vstatus=201;
        $vrespuesta['codigo']=1;
        DB::beginTransaction();
        try {
            $vflTurnado=array();
            $vflFolio=$vrequest->all();
            $vdlFolio=new Folio;

            if(empty($vflFolio['id_folio'])){
                $vflArea=C_Area::search(['id_area'=>Auth::user()->id_area])->first();
                $vresponsableArea=$vflArea->titulo.' '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno;
                
                if (($vflFolio['id_tipo_documento']==2) || ($vflFolio['id_tipo_documento']==3))
                    $vflFolio['id_documento_interno']=$vflFolio['id_documento'];
                else if ( $vflFolio['id_tipo_documento'] == 0 )
                    $vflFolio['id_documento_externo']=$vflFolio['id_documento'];
                else if ( $vflFolio['id_tipo_documento'] == 100 )
                    $vflFolio['id_documento_interno']=$vflFolio['id_documento'];
                
                /*
                 * Actualizacion, que el oficio a sido turnado
                 */
                if ( $vflFolio['id_tipo_documento'] == 0 ) {
                    $vdocumentacionExterna=DocumentoExterno::findOrFail($vflFolio['id_documento_externo']);
                    $vdocumentacionExterna->turnado=1;
                    $vdocumentacionExterna->save();
                }


                $vfiltros=array();
                $vfiltros['id_area_envia']=Auth::User()->id_area;
                $vtotalFolios=count(Folio::verificarTotalFolio($vfiltros)->get());
                $vfiltros['total_folios']=$vtotalFolios;
                $vflFolio['folio']=clsTools::generarFolio($vfiltros);
                
                if(Auth::User()->id_area == 4){
                    $vflFolio['fecha_vencimiento']=clsFormatDates::formatDates($vflFolio['fecha_vencimiento']);
                    if(isset($vflFolio['urgente'])){
                        if($vflFolio['urgente']==1) $vflFolio['es_urgente']=1;
                    }
                }               

                $vflFolio['id_status']=2;
                $vflFolio['id_area']=Auth::user()->id_area;
                $vflFolio['area_responsable']=$vflArea->area;
                $vflFolio['responsable_area']=$vresponsableArea;

                $vdlFolio->fill($vflFolio)->save();
                $vflTurnado['id_folio']=$vdlFolio->id;
                unset($vflArea, $vresponsableArea);
            }
            else {
                $vflTurnado['id_folio']=$vflFolio['id_folio'];
            }

            if(isset($vflFolio['id_destinatario'])) {
                foreach($vflFolio['id_destinatario'] as $vareaDestino) {
                    $vflArea=C_Area::search(['id_area'=>$vareaDestino])->first();
                    $vresponsableArea=$vflArea->titulo.' '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno;

                    $vdlTurnado=new Turnado;            
                    $vflTurnado['id_tipo_turnado']=1;
                    $vflTurnado['id_area']=$vflArea->id;
                    $vflTurnado['area_responsable']=$vflArea->area;
                    $vflTurnado['responsable_area']=$vresponsableArea;
                    $vflTurnado['es_nuevo']=1;
                    $vflTurnado['id_status']=2;
                    
                    $vdlTurnado->fill($vflTurnado)->save();
                    unset($vflArea, $vresponsableArea);
                }
            }

            //$vflDocumentacionInterna=DocumentoInterno::findOrFail($vflFolio['id_documento']);        
            //$vflDocumentacionInterna->turnado=1;
            //$vflDocumentacionInterna->save();

            $vrespuesta['respuesta']='Datos returnados exitosamente.';
            DB::commit();
        }
        catch(Exception $vexception) {
            $vstatus=500;
            DB::rollback();
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']='Ocurrio un error en el servidor, verifiquelo con el administrador del sistema.';
            $vrespuesta['response']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

    public function concluir(Request $vrequest)
    {
        $vstatus=201;
        $vrespuesta['codigo']=1;
        DB::beginTransaction();
        try {
            $vdatosRequest=$vrequest->all();

            /*
             * Se agrega el dato del informe
             */
            $vfiltros=array();
            $vfiltros['id_folio']=$vdatosRequest['id_folio'];
            $vfiltros['id_area']=Auth::user()->id_area;
            $vflRespuesta=Folio::internos($vfiltros)->first();
            $vflRespuesta->informe=$vdatosRequest['informe'];
            $vflRespuesta->save();
            

            $vrespuesta['respuesta']='Datos concluidos exitosamente.';
            DB::commit();
        }
        catch(Exception $vexception) {
            $vstatus=500;
            DB::rollback();
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']='Ocurrio un error en el servidor, verifiquelo con el administrador del sistema.';
            $vrespuesta['response']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

    public function responder($vid)
    {
        $vfiltro=array();
        $vfiltro['id_documento_interno']=$vid;
        $vflDocumentoInterno=DocumentoInterno::search($vfiltro)->first();

        return view('modulos.titulares.recibidos.create', [
            'documento_interno'=>$vflDocumentoInterno,
            'tipos_documentos'=>C_Tipo_Documento::lists(['id_clasificacion'=>2]), 
            'destinatarios'=>C_Area::destinatarios(['id_area'=>Auth::User()->id_area, 'tipo'=>'destinatario']),
            'documentos'=>array()
        ]);
    }
}