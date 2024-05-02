<?php

namespace App\Http\Controllers\Oficialia;
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
        view()->share('titulo', 'Inicio / <span class="badge badge-primary"><span class="fa fa-eraser"></span> Borradores</span> ');      
        view()->share('current_route', $this->route);       
    }

    public function index()
    {
       return view('modulos.oficialia_partes.borradores.index', []);
    }

    public function create()
    {         
        $dependencias= \App\Http\Models\Catalogos\C_Dependencia::lists();
        $tipos_documentos= \App\Http\Models\Catalogos\C_Tipo_Documento::lists(['externos'=>1]);
        $destinatarios= \App\Http\Models\Catalogos\C_Area::lists_sec_subsec();
        $check= 1;
        return view('modulos.oficialia_partes.borradores.create', ['dependencias'=>$dependencias, 'tipos_documentos'=>$tipos_documentos, 'destinatarios'=>$destinatarios, 'check'=>$check]);
    } 

    public function edit($id)
    {         
        $datos = DocumentoExterno::find($id); 
        $dependencias= \App\Http\Models\Catalogos\C_Dependencia::lists();
        $tipos_documentos= \App\Http\Models\Catalogos\C_Tipo_Documento::lists(['externos'=>1]);
        $destinatarios= \App\Http\Models\Catalogos\C_Area::lists_sec_subsec();
        $datos['fecha']= \App\Http\Classes\clsFormatDates::formatDates($datos['fecha'],1);
        $doctos= \App\Http\Models\Anexo::search(['id_documento_externo'=>$id])->get();
        $check= $datos['id_tipo_entrada'];
       
        return view('modulos.oficialia_partes.borradores.edit', ['datos'=> $datos, 'dependencias'=>$dependencias, 'tipos_documentos'=>$tipos_documentos, 'destinatarios'=>$destinatarios, 'doctos'=>$doctos, 'check'=>$check]);
    }  

    public function store(OficialiaPartesRequest $request)
    {
        $post = $request->all();
        //isset($post['id']) ? $id=$post['id'] : $id= 0;
        isset($post['id']) ? $datos = DocumentoExterno::find($post['id']) : $datos= new DocumentoExterno;
        DB::beginTransaction();

        try {
            $vflArea=\App\Http\Models\Catalogos\C_Area::search(['id_area'=>Auth::User()->id_area])->first();
            $vresponsableArea=$vflArea->titulo.' '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno;

            $post['id_area_envia']= Auth::User()->id_area;
            $post['fecha']= \App\Http\Classes\clsFormatDates::formatDates($post['fecha']);
            $post['id_usuario']= Auth::User()->id;
            $post['id_status']= 1;
            $post['area_responsable']=$vflArea->area;
            $post['responsable_area']=$vresponsableArea;
            unset($vflArea, $vresponsableArea);

            if(!isset($post['id'])){
                if($post['enviado']==1){
                    $post['fecha_envio']= date('Y-m-d H:m:s'); 
                }
            }
            $datos->fill($post)->save();

            if($post['enviado']==1){   
                $existe= Destinatario::exist_destinatario(['id_documento_externo'=>$datos->id]);
                //print_r($existe); exit();
                $es_nuevo= 0;
                if($existe){ 
                    $datos_destinatario= Destinatario::find($existe->id);
                    if($datos_destinatario->id_area!=$datos->id_destinatario){
                        $datos_destinatario->delete();
                        $es_nuevo= 1;
                    }
                }else{ 
                    $es_nuevo= 1;                                       
                } 

                if($es_nuevo==1){
                    $vflArea=\App\Http\Models\Catalogos\C_Area::search(['id_area'=>$datos->id_destinatario])->first();
                    $vresponsableArea=$vflArea->titulo.' '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno;

                    $datos_destinatario= new Destinatario;
                    $post_destinatario['id_documento_externo']= $datos->id;
                    $post_destinatario['id_area']= $datos->id_destinatario;
                    $area2= \App\Http\Models\Vistas\V_Area::find($datos->id_destinatario);
                    $titulo2= \App\Http\Models\Catalogos\C_Titulo::find($area2->id_titulo);
                    $post_destinatario['id_titular']= $area2->id_titular;
                    $post_destinatario['id_tipo_envio']= 1;  
                    $post_destinatario['acuse']= null;
                    $post_destinatario['es_nuevo']= 1;
                    $post_destinatario['area_responsable']=$vflArea->area;
                    $post_destinatario['responsable_area']=$vresponsableArea;

                    $post_destinatario['id_usuario_acuse']= null; 
                    $datos_destinatario->fill($post_destinatario)->save();
                    unset($vflArea);                  
                }                            
            }

            //Subir archivos
            if($request->hasFile('files')){
                $id=$datos->id;
                $area= \App\Http\Models\Catalogos\C_Area::find(Auth::User()->id_area);
                $tipo_documento= \App\Http\Models\Catalogos\C_Tipo_Documento::find($post['id_tipo_documento']);
                $ruta_de_archivos='';
                if(!isset($post['id'])){
                    $path= storage_path().'/archivos/'.\App\Http\Classes\clsHerramientas::NormalizaURL($area->area).'/'.date('Y').'/'.\App\Http\Classes\clsHerramientas::NormalizaURL($tipo_documento->nombre).'/'.$id;
                    $ruta_de_archivos='archivos/'.\App\Http\Classes\clsHerramientas::NormalizaURL($area->area).'/'.date('Y').'/'.\App\Http\Classes\clsHerramientas::NormalizaURL($tipo_documento->nombre).'/'.$id;
                }
                else {
                    $path= storage_path().'/archivos/'.\App\Http\Classes\clsHerramientas::NormalizaURL($area->area).'/'.date('Y').'/'.\App\Http\Classes\clsHerramientas::NormalizaURL($tipo_documento->nombre).'/'.$id;
                    $ruta_de_archivos='archivos/'.\App\Http\Classes\clsHerramientas::NormalizaURL($area->area).'/'.date('Y').'/'.\App\Http\Classes\clsHerramientas::NormalizaURL($tipo_documento->nombre).'/'.$id;
                }

                $files = $request->file('files');
                $i=1;
                foreach($files as $file){
                    $fileName = "Anexo-".$file->getClientOriginalName();
                    $tipo_archivo= $file->getClientOriginalExtension();
                    $size= $file->getClientSize();
                    $file->move($path, $fileName);

                    $documento_f= new \App\Http\Models\Anexo;
                    $post_documentos['id_documento_externo']= $id;
                    $post_documentos['peso']= $size;
                    $post_documentos['path']= $ruta_de_archivos;
                    $post_documentos['nombre']= $fileName;
                    $post_documentos['extension']= $tipo_archivo;
                    $documento_f->fill($post_documentos)->save();
                    $i++;
                }
            } 
            //Fin subir archivos

            DB::commit();
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            $message= ['errors'=>$error,'url'=>route($this->route.'.index')];
            return response()->json($message, 409);
        }
        
        //isset($post['id']) ? $message=['success'=>'Datos actualizados <b>satisfactoriamente</b>.','origin'=>'update', 'data'=>$datos] : $message= ['success'=>'Datos registrados <b>satisfactoriamente</b>.','origin'=>'create', 'data'=>$datos];
        $enviado= $datos->enviado;
        if($enviado==0){

            $url = 'oop.borradores.index';
            
        }else{
            ($datos->id_tipo_entrada==1) ? $url = 'oop.enviados.index' : $url = 'oopc.enviados.index';            
        }
        $message=['success'=>'Datos registrados <b>satisfactoriamente</b>.','origin'=>'update', 'data'=>$datos, 'url'=>route($url)];        
        return response()->json($message, 201);
    }  

    public function destroy($id)
    {
        $datos = DocumentoExterno::find($id);
        $enviado= $datos->enviado;
        DB::beginTransaction();
        try {
                $datos->delete();
                DB::commit();
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            $message= ['errors'=>$error,'url'=>route($this->route.'.index')];
            return response()->json($message, 401);
        }
        //($enviado==0) ? $url = 'index' :  $url = 'index' ;

        if($enviado==0){
            $url = 'oop.borradores.index';
        }else{
            ($datos->id_tipo_entrada==1) ? $url = 'oop.enviados.index' : $url = 'oopc.enviados.index';            
        }

        $message=['success'=>'Datos <b>eliminados</b>.','origin'=>'update', 'data'=>$datos, 'url'=>route($this->route.'.'.$url)];
        return response()->json($message, 201);            
    }          

}
