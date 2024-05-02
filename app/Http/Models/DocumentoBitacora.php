<?php
/*************************************************
Nombre: DocumentoBitacora.php
Autor: Sandro Alan Gomez Aceituno
Descripción: Consultas a la tabla t_documentos_bitacoras.
Creación: Mie 04 de Dic de 2019
**************************************************/
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class DocumentoBitacora extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_documentos_bitacoras';
    protected $fillable = [
        'id',
        'id_area',
        'id_status',
        'id_usuario',
        'id_dependencia',
        'id_tipo_documento',
        'folio',
        'asunto',
        'destinatario',
        'cargo_destinatario',
        'codigo_clasificacion',
        'fecha_documento'
    ];

    protected $hidden = [ ];

    public static function busquedas($vfiltros)
    {
        return DocumentoBitacora::select(
            't_documentos_bitacoras.*',
            'c_status.nombre as status'      
        )
        ->join('c_status', 't_documentos_bitacoras.id_status', '=', 'c_status.id')
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_documento_bitacora', $vfiltros)){
                $vsql->where('t_documentos_bitacoras.id', '=', $vfiltros['id_documento_bitacora']);
            }                
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_area', $vfiltros)){
                $vsql->where('t_documentos_bitacoras.id_area', '=', $vfiltros['id_area']);
            }                
        })
        ->orderBy('t_documentos_bitacoras.id', 'DESC');
    }
}