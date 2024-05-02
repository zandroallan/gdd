<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class DocumentoExterno extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_documentos_externos';
    protected $fillable = [
        'id', 'id_area_envia', 'id_dependencia', 'id_destinatario', 'id_tipo_documento', 'numero', 'fecha', 'observacion', 'enviado', 'id_usuario', 'area_responsable', 'responsable_area', 'lugar_area', 'fecha_envio', 'acusado', 'turnado'];
    protected $hidden = [];  

    public static function search($data=[]){

        $result = DocumentoExterno::select('t_documentos_externos.*','d.nombre as dependencia','td.nombre as tipo_documento', 'a.area', 'dest.area as destinatario', 't_destinatarios.acuse', 'usuarios.curp');
        $result= $result->join('c_dependencias as d', 'd.id','=','t_documentos_externos.id_dependencia');
        $result= $result->join('c_tipos_documentos as td', 'td.id','=','t_documentos_externos.id_tipo_documento'); 
        $result= $result->join('c_areas as a', 'a.id','=','t_documentos_externos.id_area_envia');  
        $result= $result->leftJoin('c_areas as dest', 'dest.id','=','t_documentos_externos.id_destinatario');
        $result= $result->leftJoin('t_destinatarios', 't_destinatarios.id_documento_externo','=','t_documentos_externos.id');
        $result= $result->leftJoin('usuarios', 'usuarios.id','=','t_documentos_externos.id_usuario'); 

        if(array_key_exists('id_dependencia', $data)){
            $filtro= $data["id_dependencia"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_documentos_externos.id_dependencia','=', $filtro);
            });
        }
        if(array_key_exists('enviado', $data)){
            $filtro= $data["enviado"];
            if($filtro==0){
                $result= $result->where( function($sql) use ($filtro) {
                    $sql->where('t_documentos_externos.enviado','=', 0);
                });
            }
            if($filtro==1){
                $result= $result->where( function($sql) use ($filtro){
                    $sql->where('t_documentos_externos.enviado','=', 1)->whereNull('t_destinatarios.acuse');
                });
            }
            if($filtro==2){
                $result= $result->where( function($sql) use ($filtro) {
                    $sql->where('t_documentos_externos.enviado','=', 1)->whereNotNull('t_destinatarios.acuse');
                });
            }            
        }
        if(array_key_exists('id_tipo_documento', $data)){
            $filtro= $data["id_tipo_documento"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_documentos_externos.id_tipo_documento','=',$filtro);
            });
        }
        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_documentos_externos.id','!=',$filtro);
            });
        }
        if(array_key_exists('id_documento_externo', $data)){
            $filtro= $data["id_documento_externo"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('t_documentos_externos.id','=',$filtro);
            });
        }

        $result= $result->orderBy('t_documentos_externos.id','DESC');
        return $result;        
    }
}