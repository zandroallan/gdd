<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class C_Area extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_areas';
    protected $fillable = [
        'id', 
        'id_dependencia', 
        'subsecretaria', 
        'direccion', 
        'departamento', 
        'oficina', 
        'id_area', 
        'id_cargo', 
        'id_titulo',
        'principal', 
        'area', 
        'sexo', 
        'nombre', 
        'ap_paterno', 
        'ap_materno',
        'folio_estructura', 
        'origen'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function search($vfiltros=[])
     {
        //Descripción: Consulta a la tabla C_Area.
        //Creación: Jue 28 de Nov de 2019

        return C_Area::select(
            'c_areas.*',
            'c_cargos.nombre as cargo',
            'c_titulos.nombre as titulo'
        )
        ->join('c_cargos', 'c_areas.id_cargo', '=', 'c_cargos.id')
        ->join('c_titulos', 'c_areas.id_titulo','=','c_titulos.id')
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_area', $vfiltros)){
                $vsql->where('c_areas.id', '=', $vfiltros['id_area']);
            }
        })
        ->where(function($vsql) use ($vfiltros){
            if(array_key_exists('id_cargo', $vfiltros)){
                $vsql->where('c_areas.id_cargo', '=', $vfiltros['id_cargo']);
            }
        })
        ->orderBy('c_areas.id','DESC');      
     }

    public static function lists_sec_subsec($data=[])
    {
        $result= C_Area::select('*');
        $result= $result->whereNull('direccion');
        $result= $result->whereNull('departamento');
        $result= $result->whereNull('oficina');
        $result= $result->whereNotNull('subsecretaria');
        if ( array_key_exists('activo', $data) ) {
            $result= $result->where('activo',1);
        }
        $result=$result->orderBy('area','ASC');
        $result=$result->pluck('area','id','deleted_at');
        $result=$result->prepend('Oficina de la C. Secretaria', 1);
        $result=$result->prepend('-- Seleccionar destinatario --', "");
        $result=$result->all();

        return $result;
    }

    public static function destinatarios($vfiltros=[])
     {
        //Descripción: Obtiene el listado de jefes de area en adelante.
        //Creación: Jue 21 de Nov de 2019

        return C_Area::select(
            '*', 
            DB::raw('CONCAT(area, ".- ",nombre, " ",ap_paterno, " ",ap_materno) as area')
        )
        ->where('principal', 1)
        ->where('c_areas.id', '<>', $vfiltros['id_area'])
        ->orderBy('id','ASC')
        ->pluck('area','id','deleted_at')
        ->prepend('Oficina de la C. Secretaria', 1)
        ->prepend('-- Seleccionar '. $vfiltros['tipo'] .' --', " ")
        ->all();
     }
}