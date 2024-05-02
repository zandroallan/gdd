<?php
/*************************************************
Nombre: DocumentoInterno.php
Autor: Sandro Alan Gomez Aceituno
Descripción: Consultas a la tabla t_documentos_internos.
Creación: Mar 08 de Oct de 2019
**************************************************/
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class DocumentoInterno extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_documentos_internos';
    protected $fillable = [
        'id', 
        'id_documento_interno',
        'id_documento_aux',
        'id_dependencia',
        'id_area_envia',
        'id_area_aux',
        'id_usuario', 
        'id_tipo_documento', 
        'folio', 
        'anio_folio',
        'destinatario',
        'destinatario_text',
        'ccp',
        'asunto', 
        'cuerpo',
        'area_responsable',
        'cargo_responsable',
        'responsable_area',
        'turnado',       
        'firma',
        'serie',
        'secuencia',
        'fecha_firma',
        'acusado',
        'sended_at'
    ];

    protected $hidden = [];  

    public static function search($vfiltros=[])
     {
        //Autor: Sandro Alan Gomez Aceituno
        //Descripción: Consulta a la tabla t_documentos_internos.
        //Creación: Jue 21 de Nov de 2019

        return DocumentoInterno::select(
            't_documentos_internos.id as id_documento_interno',
            't_documentos_internos.id',
            't_documentos_internos.id_usuario',
            't_documentos_internos.id_tipo_documento',
            't_documentos_internos.folio as numero',
            't_documentos_internos.anio_folio',
            't_documentos_internos.destinatario_text',
            't_documentos_internos.destinatario',
            't_documentos_internos.ccp',
            't_documentos_internos.asunto',
            't_documentos_internos.cuerpo',
            't_documentos_internos.area_responsable',
            't_documentos_internos.cargo_responsable',
            't_documentos_internos.responsable_area',
            't_documentos_internos.turnado',
            't_documentos_internos.firma',
            't_documentos_internos.serie',
            't_documentos_internos.secuencia',
            't_documentos_internos.fecha_firma',
            't_documentos_internos.acusado',
            't_documentos_internos.sended_at',
            't_documentos_internos.created_at',
            'd.nombre as dependencia',
            'td.nombre as tipo_documento',
            'td.color as tipo_documento_color',
            'a.area'
        )
        ->join('c_dependencias as d', 'd.id','=','t_documentos_internos.id_dependencia')
        ->join('c_tipos_documentos as td', 'td.id','=','t_documentos_internos.id_tipo_documento')
        ->join('c_areas as a', 'a.id','=','t_documentos_internos.id_area_envia')        
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_documento_interno', $vfiltros)){
                $vsql->where('t_documentos_internos.id', $vfiltros['id_documento_interno']);
            }
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_tipo_documento', $vfiltros)){
                $vsql->where('t_documentos_internos.id_tipo_documento',$vfiltros['id_tipo_documento']);
            }
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('acusado', $vfiltros)){
                $vsql->where('t_documentos_internos.acusado', $vfiltros['acusado']);
            }
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_area_envia', $vfiltros)){
                $vsql->where('t_documentos_internos.id_area_envia', $vfiltros['id_area_envia']);
            }
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_area_aux', $vfiltros)){
                $vsql->where('t_documentos_internos.id_area_aux', $vfiltros['id_area_aux']);
                     // ->orWhere('t_documentos_internos.id_usuario', '=', $vfiltros['id_usuario']);
            }
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('sended_at', $vfiltros)){
                if($vfiltros['sended_at']==false){
                    $vsql->whereNull('t_documentos_internos.sended_at');
                }
                elseif($vfiltros['sended_at']==true) {
                    $vsql->whereNotNull('t_documentos_internos.sended_at');
                }
            }
        })
        ->orderBy('t_documentos_internos.id','DESC');      
     }

    public static function verificarTotalFolio($vfiltro=[])
     {
        // Autor: Sandro Alan Gómez Aceituno
        // Description: Verifica cuantos folios existen dependiendo a los filtros.
        // Creación: Vie 22 de Nov de 2019

        $vsended_at=$vfiltro['sended_at'];
        return DocumentoInterno::select(
            't_documentos_internos.*', 
            'c_tipos_documentos.nombre as tipo_documento', 
            'c_tipos_documentos.color as tipo_documento_color'
        )
        ->join('c_tipos_documentos', 't_documentos_internos.id_tipo_documento', '=', 'c_tipos_documentos.id')
        ->where('t_documentos_internos.id_area_envia', $vfiltro['id_area_envia'])
        ->where('t_documentos_internos.id_tipo_documento', $vfiltro['id_tipo_documento'])
        ->where('t_documentos_internos.anio_folio', date('Y'))
        ->where(function($vsql) use ($vsended_at){
            if($vsended_at==1){
                $vsql->where('t_documentos_internos.sended_at','!=', NULL);
            }
        })->get();
     }
}