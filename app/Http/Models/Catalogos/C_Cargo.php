<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class C_Cargo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_cargos';
    protected $fillable = [
        'id', 'nombre', 'nombre_'
    ];

    protected $hidden = [
        //'id',
    ];

   public static function lists($data=[]){

        $result=C_Cargo::select('*');
        $result= $result->orderBy('nombre','ASC')->pluck('nombre','id','deleted_at')->prepend('-- Seleccionar cargo --', "")->all();
        return $result;

    }

    public static function search($data=[])
    {
        $result = C_Cargo::select('*');             
        if(array_key_exists('nombre', $data)){
            $filtro= $data["nombre"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('nombre','=', $filtro);
            });
        }
        if(array_key_exists('id', $data)){
            $filtro= $data["id"];
            $result= $result->where( function($sql) use ($filtro) {
                $sql->where('id','=',$filtro);
            });
        }
        $result= $result->orderBy('id','DESC');
        return $result;
    }
}