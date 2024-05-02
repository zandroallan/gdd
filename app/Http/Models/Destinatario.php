<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Destinatario extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_destinatarios';
    protected $fillable = [
        'id', 
        'id_documento_externo',
        'id_documento_interno',
        'id_area',
        'area_responsable',
        'responsable_area',
        'es_nuevo',
        'acuse',
        'id_usuario_acuse',
        'id_tipo_envio'
    ];

    protected $hidden = [];  

    public static function search($data=[]){

        $result=Destinatario::select('t_destinatarios.*','td.nombre as tipo_documento', 'a.area');
        $result=$result->leftJoin('t_documentos_externos as de', 'de.id','=','t_destinatarios.id_documento_externo');        


        if(array_key_exists('id_dependencia', $data)){
            $filtro=$data["id_dependencia"];
            $result=$result->where( function($sql) use ($filtro)
                            {
                                $sql->where('t_documentos_externos.id_dependencia','=', $filtro);
                            });
        }
        if(array_key_exists('id_area', $data)){
            $filtro=$data["id_area"];
            $result=$result->where( function($sql) use ($filtro)
                            {
                                $sql->where('t_documentos_externos.id_destinatario','=', $filtro);
                            });
        }

        if(array_key_exists('id_tipo_documento', $data)){
            $filtro=$data["id_tipo_documento"];
            $result=$result->where( function($sql) use ($filtro)
                            {
                                $sql->where('t_documentos_externos.id_tipo_documento','=',$filtro);
                            });
        }

        if(array_key_exists('id', $data)){
            $filtro=$data["id"];
            $result=$result->where( function($sql) use ($filtro)
                            {
                                $sql->where('t_documentos_externos.id','!=',$filtro);
                            });
        } 

        $result=$result->orderBy('t_documentos_externos.id','DESC');
        return $result;        
    }

    public static function exist_destinatario($data=[]){

        $result=Destinatario::select('t_destinatarios.*','d.nombre as dependencia');
        $result=$result->leftJoin('t_documentos_externos as de', 'de.id','=','t_destinatarios.id_documento_externo');
        $result=$result->leftjoin('c_dependencias as d', 'd.id','=','de.id_dependencia');                


        if(array_key_exists('id_documento_externo', $data)){
            $filtro=$data["id_documento_externo"];
            $result=$result->where( function($sql) use ($filtro)
                            {
                                $sql->where('t_destinatarios.id_documento_externo','=', $filtro);
                            });
        }

        if(array_key_exists('id_dependencia', $data)){
            $filtro=$data["id_dependencia"];
            $result=$result->where( function($sql) use ($filtro)
                            {
                                $sql->where('de.id_dependencia','=', $filtro);
                            });
        }

        if(array_key_exists('id_tipo_documento', $data)){
            $filtro=$data["id_tipo_documento"];
            $result=$result->where( function($sql) use ($filtro)
                            {
                                $sql->where('de.id_tipo_documento','=',$filtro);
                            });
        }

        if(array_key_exists('id', $data)){
            $filtro=$data["id"];
            $result=$result->where( function($sql) use ($filtro)
                            {
                                $sql->where('de.id','!=',$filtro);
                            });
        }

        $result=$result->orderBy('de.id','DESC')->first();
        return $result;        
    }

    public static function externos($data=[])
    {
        //Autor: Sandro Alan Gomez Aceituno
        //Creación: Mar 10 de Dic de 2019
        //Descripcion: Muestra a con quien se mando la documentacion Externa.
        
        $result= Destinatario::select(
            't_destinatarios.id as id_destinatario',
            't_destinatarios.id_documento_externo',
            't_destinatarios.id_documento_interno',
            't_destinatarios.es_nuevo',
            't_destinatarios.id_area',
            't_destinatarios.area_responsable',
            't_destinatarios.id_tipo_envio',
            't_destinatarios.responsable_area',
            't_destinatarios.acuse',
            't_documentos_externos.id as id_documento_externo',
            't_documentos_externos.numero as folio',
            't_documentos_externos.observacion as asunto',            
            't_documentos_externos.id_tipo_documento',
            't_documentos_externos.area_responsable as area_responsable_envia',
            't_documentos_externos.responsable_area as responsable_area_envia',            
            't_documentos_externos.fecha_envio as sended_at',
            'c_tipos_documentos.nombre as tipo_documento',
            'c_tipos_documentos.color as tipo_documento_color'
        );
        $result= $result->leftJoin('t_documentos_externos', 't_destinatarios.id_documento_externo', '=', 't_documentos_externos.id');
        $result= $result->join('c_tipos_documentos', 't_documentos_externos.id_tipo_documento', '=', 'c_tipos_documentos.id');
        if(array_key_exists('id_area', $data)){
            $filtro= $data["id_area"];
            $result= $result->where(function($sql) use ($filtro) {
                $sql->where('t_destinatarios.id_area', $filtro);
            });
        }
        if(array_key_exists('id_tipo_envio', $data)){
            $filtro= $data["id_tipo_envio"];
            $result= $result->where(function($sql) use ($filtro) {
                $sql->where('t_destinatarios.id_tipo_envio', $filtro);
            });
        }
        if(array_key_exists('id_documento_externo', $data)){
            $filtro= $data["id_documento_externo"];
            $result= $result->where(function($sql) use ($filtro) {
                $sql->where('t_documentos_externos.id', $filtro);
            });
        }
        $result=$result->orderBy('t_documentos_externos.id','DESC');
        return $result;        
    }

    public static function internos($data=[])
    {
        //Autor: Sandro Alan Gomez Aceituno
        //Creación: Vie 29 de Nov de 2019
        //Descripcion: Muestra a con quien se mando la documentacion interna.
        
        $result= Destinatario::select(
            't_destinatarios.id as id_destinatario',
            't_destinatarios.id_documento_externo',
            't_destinatarios.id_documento_interno',
            't_destinatarios.es_nuevo',
            't_destinatarios.id_area',
            't_destinatarios.area_responsable',
            't_destinatarios.id_tipo_envio',
            't_destinatarios.responsable_area',
            't_destinatarios.acuse',
            't_destinatarios.created_at',
            't_documentos_internos.folio',
            't_documentos_internos.asunto',
            't_documentos_internos.id_tipo_documento',
            't_documentos_internos.area_responsable as area_responsable_envia',
            't_documentos_internos.responsable_area as responsable_area_envia',
            't_documentos_internos.sended_at',
            't_documentos_externos.area_responsable as area_responsable_envia_externo',
            't_documentos_externos.responsable_area as responsable_area_envia_externo',
            't_documentos_externos.observacion',
            't_documentos_externos.numero',
            't_documentos_externos.turnado',
            'c_dependencias.nombre as dependencia',
            'c_tipos_documentos.nombre as tipo_documento',
            'c_tipos_documentos.color as tipo_documento_color'
        );
        $result=$result->leftJoin('t_documentos_externos', 't_destinatarios.id_documento_externo', '=', 't_documentos_externos.id');
        $result=$result->leftJoin('t_documentos_internos', 't_destinatarios.id_documento_interno', '=', 't_documentos_internos.id');
        $result=$result->leftJoin('c_tipos_documentos', 't_documentos_internos.id_tipo_documento', '=', 'c_tipos_documentos.id');
        $result=$result->leftJoin('c_dependencias', 't_documentos_externos.id_dependencia', '=', 'c_dependencias.id');       

        if(array_key_exists('id_documento_externo', $data)){
            $filtro= $data["id_documento_externo"];
            $result= $result->where(function($sql) use ($filtro) {
                $sql->where('t_destinatarios.id_documento_externo', $filtro);
            });
        }
        if(array_key_exists('externo', $data)){
            $filtro= $data["externo"];
            $result= $result->where(function($sql) use ($filtro) {
                $sql->whereNotNull('t_destinatarios.id_documento_externo');
            });
        }
        if(array_key_exists('id_documento_interno', $data)){
            $filtro= $data["id_documento_interno"];
            $result= $result->where(function($sql) use ($filtro) {
                $sql->where('t_destinatarios.id_documento_interno', $filtro);
            });
        }
        if(array_key_exists('id_tipo_documento', $data)){
            $filtro= $data["id_tipo_documento"];
            $result= $result->where(function($sql) use ($filtro) {
                $sql->where('t_documentos_internos.id_tipo_documento', $filtro);
            });
        }
        if(array_key_exists('id_tipo_envio', $data)){
            $filtro= $data["id_tipo_envio"];
            $result= $result->where(function($sql) use ($filtro) {
                $sql->where('t_destinatarios.id_tipo_envio', $filtro);
            });
        }
        if(array_key_exists('id_area', $data)){
            $filtro= $data["id_area"];
            $result= $result->where(function($sql) use ($filtro) {
                $sql->where('t_destinatarios.id_area', $filtro);
            });
        }
        if(array_key_exists('acuse', $data)){
            $acuse= $data["acuse"];         
            if($acuse==1){
                $result= $result->where(function($sql) {
                    $sql->whereNull('t_destinatarios.acuse');
                });
            }
            elseif($acuse==0){
                $result= $result->where(function($sql) {
                    $sql->whereNotNull('t_destinatarios.acuse');
                });
            }
        }
        $result=$result->orderBy('t_documentos_externos.id','DESC');
        $result=$result->orderBy('t_documentos_internos.id','DESC');
        return $result;        
    }

}