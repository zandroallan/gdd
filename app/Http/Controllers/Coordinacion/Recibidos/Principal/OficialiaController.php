<?php

namespace App\Http\Controllers\Coordinacion\Recibidos\Principal;
use App\Http\Requests\Modulos\Coordinacion\OficialiaPartesRequest;
use App\Http\Models\DocumentoExterno;
use App\Http\Models\Destinatario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
class OficialiaController extends Controller
{
    private $route= 'coo.oficialia'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Recibidos / <span class="badge badge-success"><span class="fa fa-send"></span> Principal</span> ');      
        view()->share('current_route', $this->route);        
    }

    public function acusar($id_destinatario){
        $datos= Destinatario::find($id_destinatario);
        $post['acuse']= date('Y-m-d H:m:s');
        $post['id_usuario_acuse']= Auth::User()->id;        
        DB::beginTransaction();
        try {
                $datos->fill($post)->save();
                DB::commit();
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            $message= ['errors'=>$error,'url'=>route($this->route.'.index')];
            return response()->json($message, 401);
        }


        $message=['success'=>'El documento ha sido <b>acusado</b>.','origin'=>'edit', 'acuse'=>$post['acuse']];


        return response()->json($message, 201);       
    }


    public function edit($id)
    {         
        $destinatario= Destinatario::find($id); 
        if($destinatario->es_nuevo==1){
            $destinatario->fill(['es_nuevo'=>0])->save();
        }
        $datos= DocumentoExterno::find($destinatario->id_documento_externo); 

        $datos->acuse= $destinatario->acuse;

        $dependencias= \App\Http\Models\Catalogos\C_Dependencia::lists();
        $tipos_documentos= \App\Http\Models\Catalogos\C_Tipo_Documento::lists(['id_clasificacion'=>2]);
        $destinatarios= \App\Http\Models\Catalogos\C_Area::lists_sec_subsec();
        $datos['fecha']= \App\Http\Classes\clsFormatDates::formatDates($datos['fecha'],1);

        $datos['acuse']= \App\Http\Classes\clsFormatDates::shortDateFormatTime($datos['acuse'],1);
        $datos['fecha_envio']= \App\Http\Classes\clsFormatDates::shortDateFormatTime($datos['fecha_envio'],1);

        $doctos= \App\Http\Models\Anexo::search(['id_documento_externo'=>$id])->get();
        $check= $datos['id_tipo_entrada'];
        $cargos= \App\Http\Models\Catalogos\C_Cargo::lists();

        $areas= \App\Http\Models\Catalogos\C_Area::lists_segundo_nivel(['id_area'=>1]);

        return view('modulos.coordinacion.recibidos.principal.oficialia.edit', ['datos'=> $datos, 'dependencias'=>$dependencias, 'tipos_documentos'=>$tipos_documentos, 'destinatarios'=>$destinatarios, 'doctos'=>$doctos, 'check'=>$check, 'areas'=>$areas, 'cargos'=>$cargos]);
    }

    public function show($id)
    {         
        $destinatario= Destinatario::find($id); 
        $datos= DocumentoExterno::find($destinatario->id_documento_externo); 
        $areas= \App\Http\Models\Catalogos\C_Area::lists_segundo_nivel(['id_area'=>1]);
        return view('modulos.coordinacion.recibidos.principal.oficialia.show-externo', ['datos'=> $datos, 'areas'=>$areas]);
    }    

    public function store(OficialiaPartesRequest $request)
    {
        $post= $request->all();        
        $datos= DocumentoExterno::find($post['id']);
        DB::beginTransaction();

        try {            
            $post['fecha']= \App\Http\Classes\clsFormatDates::formatDates($post['fecha']);
            if($post['turnar']==1){
                $post['id_status']= 2;
            }

            $datos->fill($post)->save();

            $existe= Destinatario::exist_destinatario(['id_documento_externo'=>$datos->id]);
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
                $datos_destinatario= new Destinatario;
                $post_destinatario['id_documento_externo']= $datos->id;
                $post_destinatario['id_area']= $datos->id_destinatario;
                $area2= \App\Http\Models\Catalogos\C_Area::find($datos->id_destinatario);
                $titulo2= \App\Http\Models\Catalogos\C_Titulo::find($area2->id_titulo);
                $post_destinatario['area_nombre']= $area2->area;
                $post_destinatario['area_responsable']= $titulo2->nombre.' '.$area2->nombre.' '.$area2->ap_paterno.' '.$area2->ap_materno;
                $post_destinatario['id_tipo_envio']= 1;  
                $post_destinatario['acuse']= null;
                $post_destinatario['es_nuevo']= 1;
                $post_destinatario['id_usuario_acuse']= null; 
                $datos_destinatario->fill($post_destinatario)->save();                   
            }

            //Subir archivos
            if($request->hasFile('files')){
                $id=$datos->id;
                $area= \App\Http\Models\Catalogos\C_Area::find($datos->id_area_envia);
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

            if($datos->id_status==2){
                $anio= date('Y');
                $area2= \App\Http\Models\Vistas\V_Area::find(Auth::User()->id_area);
                $total_folios= \App\Http\Models\Folio::total_folios(['anio'=>$anio, 'id_area_genera'=>Auth::User()->id_area]);
                $folio= $area2->folio_estructura.'/F'.str_pad(($total_folios+1),4,"0",STR_PAD_LEFT).'/'.$anio;

                $datos_folio= new \App\Http\Models\Folio;
                $post_folio['id_documento_externo']= $datos->id;
                $post_folio['id_area']= $area2->id;
                $post_folio['id_titular']= $area2->id_titular;
                $post_folio['id_area_responde']= $post['id_area_responde'];
                $post_folio['folio']= $folio;
                $post_folio['anio']= $anio;
                $post_folio['id_status']= 1;
                if($request->has('es_urgente')){ $post_folio['es_urgente']= 1; }               

                $post_folio['id_area_genera']= Auth::User()->id_area;
                $post_folio['fecha_vencimiento']= \App\Http\Classes\clsFormatDates::formatDates($post['fecha_vencimiento']);
                $post_folio['indicaciones']= $post['indicaciones'];
                $datos_folio->fill($post_folio)->save();

                $datos_turnado= new \App\Http\Models\Turnado;
                $area3= \App\Http\Models\Vistas\V_Area::find($post['id_area_responde']);
                $post_turnado['id_folio']= $datos_folio->id;
                $post_turnado['id_tipo_turnado']= 1;
                $post_turnado['id_area']= $post['id_area_responde'];
                $post_turnado['id_titular']= $area3->id_titular;
                $post_turnado['id_status']= 1;                
                $datos_turnado->fill($post_turnado)->save();

                
                if(isset($post['copias'])){
                    foreach($post['copias'] as $copia){
                        $datos_turnado_c= new \App\Http\Models\Turnado;
                        $area3_c= \App\Http\Models\Vistas\V_Area::find($copia);
                        $post_turnado_c['id_folio']= $datos_folio->id;
                        $post_turnado_c['id_tipo_turnado']= 2;
                        $post_turnado_c['id_area']= $copia;
                        $post_turnado_c['id_titular']= $area3_c->id_titular;
                        $post_turnado_c['id_status']= 7;                
                        $datos_turnado_c->fill($post_turnado_c)->save();                        
                    }
                }                               
            }


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
            ($datos->id_tipo_entrada==1) ? $url = 'coo.principal.index' : $url = 'coo.principal.index';            
        }
        $message=['success'=>'Datos actualizados <b>satisfactoriamente</b>.','origin'=>'update', 'data'=>$datos, 'url'=>route($url)];        
        return response()->json($message, 201);
    }

        
}
