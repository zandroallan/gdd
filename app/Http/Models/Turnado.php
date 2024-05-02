<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Turnado extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_turnados';
    protected $fillable = [
        'id', 
        'id_folio', 
        'id_tipo_turnado',
        'id_area', 
        'subsecretaria', 
        'direccion', 
        'departamento', 
        'oficina', 
        'area_responsable',
        'responsable_area',
        'es_nuevo',
        'acuse',
        'id_usuario_acuse',
        'id_status',
        'motivo_rechazo',
        'informe'
    ];

    protected $hidden = [];  
    
    public static function internos($vfiltros=[])
     {
        //Autor: Sandro Alan Gomez Aceituno
        //Descripción: Consulta a la tabla t_folios.
        //Creación: Lun 06 de Ene de 2020

        return Turnado::select(
            't_turnados.id as id_turnado',
            't_turnados.id_folio',
            't_turnados.area_responsable',
            't_turnados.responsable_area',
            't_turnados.es_nuevo',
            't_turnados.acuse',
            't_turnados.motivo_rechazo',
            't_turnados.id_tipo_turnado as id_tipo_envio',
            't_folios.folio',
            't_folios.indicaciones',
            't_folios.id_status',
            't_folios.fecha_vencimiento',
            't_folios.id_area as id_area_envia',
            't_folios.area_responsable as area_responsable_envia',
            't_folios.responsable_area as responsable_area_envia',
            't_folios.created_at',
            // 't_documentos_internos.id as id_documento_interno',
            't_documentos_internos.asunto',
            't_documentos_internos.cuerpo',
            't_documentos_internos.acusado'
        )
        ->leftJoin('t_folios', 't_turnados.id_folio', '=', 't_folios.id')
        ->leftJoin('t_documentos_externos', 't_folios.id_documento_externo', '=', 't_documentos_externos.id')
        ->leftJoin('t_documentos_internos', 't_folios.id_documento_interno', '=', 't_documentos_internos.id')
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_turnado', $vfiltros))
                $vsql->where('t_turnados.id', $vfiltros['id_turnado']);
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_documento_externo', $vfiltros))
                $vsql->where('t_folios.id_documento_externo', $vfiltros['id_documento_externo']);
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_documento_interno', $vfiltros))
                $vsql->where('t_folios.id_documento_interno', $vfiltros['id_documento_interno']);
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_area', $vfiltros))
                $vsql->where('t_turnados.id_area', $vfiltros['id_area']);
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_area_envia', $vfiltros))
                $vsql->where('t_folios.id_area', $vfiltros['id_area_envia']);
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_folio', $vfiltros))
                $vsql->where('t_turnados.id_folio', $vfiltros['id_folio']);
        })        
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_tipo_envio', $vfiltros))
                $vsql->where('t_turnados.id_tipo_turnado', $vfiltros['id_tipo_envio']);
        })
        ->orderBy('t_folios.id','DESC');      
     } 
}