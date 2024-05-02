<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class C_Dependencia extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_dependencias';
    protected $fillable = [
        'id', 'id_sector_clasificacion', 'id_tipo_organismo', 'nombre', 'titular', 'direccion', 'conmutador', 'pagina'
    ];

    protected $hidden = [
        //'id',
    ];

   public static function lists($data=[]){
        $sectores= \App\Http\Models\Catalogos\C_Sector_Clasificacion::select('*');
        $sectores= $sectores->orderBy('nombre','ASC')->pluck('nombre','id','deleted_at')->all();        
        $result= [];
        foreach ($sectores as $key => $value) {
            $dependencias= C_Dependencia::where('id_sector_clasificacion', $key)->orderBy('id','ASC')->pluck('nombre','id','deleted_at')->all();
            if(count($dependencias)>0){
                $result[$value]= $dependencias;
            }            
        }
        return [0=>'-- Seleccionar dependencia --']+$result; 
    }

    public static function search($data=[]){
        $result = C_Dependencia::select('c_dependencias.*', 'c_sectores_clasificacion.nombre as sector', 'c_tipos_organismos.nombre as tipo_organismo');
        $result= $result->join('c_sectores_clasificacion', 'c_sectores_clasificacion.id','=','c_dependencias.id_sector_clasificacion');
        $result= $result->join('c_tipos_organismos', 'c_tipos_organismos.id','=','c_dependencias.id_tipo_organismo');


        if(array_key_exists('nombre', $data)){
            $filtro= $data["nombre"];
            $result= $result->where( function($sql) use ($filtro)
                            {
                                $sql->where('nombre','=', $filtro);
                            });
        }

        if(array_key_exists('activo', $data)){         
            $result= $result->where('activo',1);
        }

        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro)
                            {
                                $sql->where('id','!=',$filtro);
                            });
        }
        $result= $result->orderBy('id','DESC');
        return $result;
    }
}