<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Folio extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_folios';
    protected $fillable = [
        'id', 
        'id_documento_externo', 
        'id_documento_interno', 
        'id_status',
        'id_area', 
        'folio', 
        'fecha_vencimiento', 
        'es_urgente', 
        'indicaciones',
        'area_responsable',
        'responsable_area'
    ];

    protected $hidden = [];  
    
    public static function verificarTotalFolio($vfiltro=[])
     {
        // Autor: Sandro Alan Gómez Aceituno
        // Description: Verifica cuantos folios existen dependiendo a los filtros.
        // Creación: Vie 24 de Ene de 2020

        // $vsended_at=$vfiltro['sended_at'];
        return Folio::select(
            't_folios.*' 
            // 't_folios.nombre as tipo_documento', 
            // 't_folios.color as tipo_documento_color'
        )
        // ->join('c_tipos_documentos', 't_folios.id_tipo_documento', '=', 'c_tipos_documentos.id')
        ->where('t_folios.id_area', $vfiltro['id_area_envia']);
        // ->where('t_folios.id_tipo_documento', $vfiltro['id_tipo_documento'])
        // ->where('t_folios.anio_folio', date('Y'))
     }

    public static function internos($vfiltros=[])
     {
        //Autor: Sandro Alan Gomez Aceituno
        //Descripción: Consulta a la tabla t_folios.
        //Creación: Lun 06 de Ene de 2020

        return Folio::select(
            't_folios.id',
            't_folios.id_documento_externo',
            't_folios.id_documento_interno',
            't_folios.id_area',
            't_folios.folio',
            't_folios.indicaciones',
            't_folios.id_status',
            't_folios.fecha_vencimiento',
            't_folios.area_responsable',
            't_folios.responsable_area',
            't_folios.created_at',
            't_documentos_internos.asunto',
            't_documentos_internos.cuerpo',
            't_documentos_internos.acusado'
        )
        ->leftJoin('t_documentos_externos', 't_folios.id_documento_externo', '=', 't_documentos_externos.id')
        ->leftJoin('t_documentos_internos', 't_folios.id_documento_interno', '=', 't_documentos_internos.id')
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_folio', $vfiltros))
                $vsql->where('t_folios.id', $vfiltros['id_folio']);
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_area', $vfiltros))
                $vsql->where('t_folios.id_area', $vfiltros['id_area']);        
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_documento_externo', $vfiltros))
                $vsql->where('t_folios.id_documento_externo', $vfiltros['id_documento_externo']);
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_documento_interno', $vfiltros))
                $vsql->where('t_folios.id_documento_interno', $vfiltros['id_documento_interno']);
        })
        ->orderBy('t_folios.id','DESC');      
     }
}