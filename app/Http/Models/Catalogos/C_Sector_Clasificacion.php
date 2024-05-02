<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class C_Sector_Clasificacion extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_sectores_clasificacion';
    protected $fillable = [
        'id', 'id_sector', 'nombre'
    ];

    protected $hidden = [
        //'id',
    ];

   public static function lists($data=[]){

        $result= C_Sector_Clasificacion::select('*');
        if(array_key_exists('activo', $data)){
            $result= $result->where('activo',1);
        }
        $result= $result->orderBy('nombre','ASC')->pluck('nombre','id','deleted_at')->prepend('-- Seleccionar sector clasificacion --', "")->all();
        return $result;

    }

    public static function search($data=[]){
        $result = C_Sector_Clasificacion::select('*');

        if(array_key_exists('id_clasificacion', $data)){
            $filtro= $data["id_clasificacion"];
            $result= $result->where( function($sql) use ($filtro)
                            {
                                $sql->where('id_clasificacion','=', $filtro);
                            });
        }        
       
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