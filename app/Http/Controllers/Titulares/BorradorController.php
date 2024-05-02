<?php
/**************************************************
Name: BorradorController.php
Creation date: Jue 21 de Noviembre de 2019
Description: Controlador principal, Borradores Direccion
***************************************************/
namespace App\Http\Controllers\Titulares;
use App\Http\Classes\clsTools;
use App\Http\Classes\clsHerramientas;
use App\Http\Requests\Modulos\Direccion\BorradorRequest;
use App\Http\Models\Catalogos\C_Dependencia;
use App\Http\Models\Catalogos\C_Tipo_Documento;
use App\Http\Models\Catalogos\C_Area;
use App\Http\Models\Catalogos\C_Cargo;
use App\Http\Models\DocumentoInterno;
use App\Http\Models\Destinatario;
use App\Http\Models\Anexo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class BorradorController extends Controller
{
    private $route= 'ttl.borradores'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Borradores');
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
                    # show code...
                    $vfiltros['id_documento_interno']=$vrequest->input('id_documentos_internos');
                    $vrespuesta['respuesta']=DocumentoInterno::search($vfiltros)->first();
                  break;                
                case 'get':
                    # get code...
                    $vfiltros['sended_at']=false;
                    $vfiltros['id_area_envia']=Auth::User()->id_area;
                    $vdocumentosInternos=DocumentoInterno::search($vfiltros)->get();
                    $vrespuesta=['codigo'=>0, 'respuesta'=>$vdocumentosInternos];
                    /*
                    if(count($vdocumentosInternos) > 0)
                        $vrespuesta['respuesta']=$vdocumentosInternos;
                    else {
                        $vrespuesta['codigo']=0;
                        $vrespuesta['respuesta']='No existen registros que mostrar.';
                    }
                    */
                  break;
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
       return view('modulos.titulares.borradores.index');
    }

    public function create()
    {
        return view('modulos.titulares.borradores.create', [
            'tipos_documentos'=>C_Tipo_Documento::lists(['internos'=>1]),
            'cargos'=>C_Cargo::lists(),
            'destinatarios'=>C_Area::destinatarios(['id_area'=>Auth::User()->id_area, 'tipo'=>'destinatario']),
            'copias'=>C_Area::destinatarios(['id_area'=>Auth::User()->id_area, 'tipo'=>'copias']),
            'documentos'=>array()
        ]);
    }  
    
    public function store(BorradorRequest $vrequest)
    {
        $vcodeHTTP=201;
        $vrespuesta=array();
        DB::beginTransaction();
        try {
            $vsend=$vrequest->only('sended_at');
            // $vfirma=$vrequest->input('txtsignature');
            // $vserie=$vrequest->input('txtserie');
            // $vsecuencia=$vrequest->input('txtsecuencie');
            // $vfecha_firma=$vrequest->input('txtsignedDate');
            $vflDocumentacionInterna=$vrequest->except(['cuerpo', 'sended_at']);

            if((isset($vflDocumentacionInterna['id'])) && ($vflDocumentacionInterna['id'] > 0)) {
                $vdlDocumentacionInterna=DocumentoInterno::findOrFail($vflDocumentacionInterna['id']);
            }
            else {
                $vdlDocumentacionInterna=new DocumentoInterno;
            }
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
                // $vflDocumentacionInterna['firma']=$vfirma;
                // $vflDocumentacionInterna['serie']=$vserie;
                // $vflDocumentacionInterna['secuencia']=$vsecuencia;
                // $vflDocumentacionInterna['fecha_firma']=$vfecha_firma;
            }
            // End create folio
            
            $vdestinatarios=array();
            if($vrequest['id_tipo_documento']!=3) {
                if(isset($vflDocumentacionInterna['id_destinatario'])) {
                    foreach($vflDocumentacionInterna['id_destinatario'] as $vareaDestino) {
                        $varea=C_Area::search(['id_area'=>$vareaDestino])->first();
                        $vdestinatario=(object) [
                            'responsable'=>$varea->titulo.' '.$varea->nombre.' '.$varea->ap_paterno.' '.$varea->ap_materno,
                            'area'=>$varea->area
                        ];
                        array_push($vdestinatarios, $vdestinatario);
                        unset($varea);                        
                    }
                }
            }
            else {
                if(isset($vflDocumentacionInterna['cargos'])) {
                    foreach($vflDocumentacionInterna['cargos'] as $vcargoDestino){
                        $vcargo=C_Cargo::findOrFail($vcargoDestino);
                        $vdestinatario=(object) [
                            'responsable'=>$vcargo->nombre
                        ];
                        array_push($vdestinatarios, $vdestinatario);
                        unset($vcargo);                        
                    }
                }
            }
            $vflDocumentacionInterna['destinatario_text']=json_encode($vdestinatarios);
           

            if($vrequest['id_tipo_documento']==3) {
                $vflDocumentacionInterna['destinatario']=json_encode($vflDocumentacionInterna['cargos']);
            }
            else {
                if(isset($vflDocumentacionInterna['id_destinatario'])) {
                    $vflDocumentacionInterna['destinatario']=json_encode($vflDocumentacionInterna['id_destinatario']);
                }
            }

            if(isset($vflDocumentacionInterna['ccp'])) {
                $vflDocumentacionInterna['ccp']=json_encode($vflDocumentacionInterna['ccp']); 
            }
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
                $vrespuesta['sended_at']=true;
                $vrespuesta['url']=route('ttl.borradores.index');
                if(isset($vflDocumentacionInterna['cargos'])) {
                    if($vrequest['id_tipo_documento']==3) {
                        foreach($vflDocumentacionInterna['cargos'] as $vcargo) {
                            $vflAreas=C_Area::search(['id_cargo'=>$vcargo])->get();
                            foreach($vflAreas as $vflArea) {
                                $vresponsableArea=$vflArea->titulo.' '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno;
                                $vflDestinatarios['id_documento_interno']=$vdlDocumentacionInterna->id;
                                $vflDestinatarios['id_area']=$vflArea->id;
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
                    }
                }
                if(isset($vflDocumentacionInterna['id_destinatario'])) {
                    if($vrequest['id_tipo_documento']!=3) {
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
                }
                if(isset($vflDocumentacionInterna['ccp'])) {
                    foreach(json_decode($vflDocumentacionInterna['ccp']) as $vareaCopia) {
                        $vflArea=C_Area::search(['id_area'=>$vareaCopia])->first();
                        $vresponsableArea=$vflArea->titulo.' '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno;

                        $vflDestinatarios['id_documento_interno']=$vdlDocumentacionInterna->id;
                        $vflDestinatarios['id_area']=$vareaCopia;
                        $vflDestinatarios['area_responsable']=$vflArea->area;
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
                    $fileName=date('His') . "Anexo-".$file->getClientOriginalName();
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


            // Agregar id documento auxiliar            
            if($vdlDocumentacionInterna->id_documento_aux == null) {
                $vid_documento_interno=$vdlDocumentacionInterna->id;
                unset($vdlDocumentacionInterna);
                $vdlDocumentacionInterna=DocumentoInterno::findOrFail($vid_documento_interno);
                $vdlDocumentacionInterna->id_documento_aux=$vid_documento_interno;
                $vdlDocumentacionInterna->save();
            }

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

    public function edit($vid)
    {
        $vflDocumentacionInterna=DocumentoInterno::findOrFail($vid);
        $vflDocumentacionInterna['id_destinatario']=json_decode($vflDocumentacionInterna->destinatario);
        $vflDocumentacionInterna['ccp']=json_decode($vflDocumentacionInterna->ccp);
        $vdocumentos=Anexo::search(['id_documento_interno'=>$vid])->get();
        
        if($vflDocumentacionInterna->id_tipo_documento==3){
            $vflDocumentacionInterna['cargos']=json_decode($vflDocumentacionInterna->destinatario);
        }

        return view('modulos.titulares.borradores.edit', [
            'respuesta'=>$vflDocumentacionInterna,
            'tipos_documentos'=>C_Tipo_Documento::lists(['internos'=>1]),
            'cargos'=>C_Cargo::lists(),
            'destinatarios'=>C_Area::destinatarios(['id_area'=>Auth::User()->id_area, 'tipo'=>'destinatario']),
            'copias'=>C_Area::destinatarios(['id_area'=>Auth::User()->id_area, 'tipo'=>'copias']),
            'documentos'=>$vdocumentos
        ]);
    }

    public function destroy($vid)
    {
        $vstatus=200;
        $vrespuesta=array();
        DB::beginTransaction();
        try {
            $vdlDocumentoInterno=DocumentoInterno::findOrFail($vid);
            $vdlDocumentoInterno->delete();

            $vrespuesta['codigo']=1;
            $vrespuesta['respuesta']="El dato ha sido eliminado correctamente.";
            DB::commit();
        }
        catch(Exception $vexception ){
            DB::rollback();
            $vstatus=500;
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']='Ocurrio un problema al borrar los datos, comunicate con el administrador del sistema';
            $vrespuesta['response']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }
}