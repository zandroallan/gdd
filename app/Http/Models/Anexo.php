<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Anexo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 't_anexos';
    protected $fillable = [
        'id', 'id_documento_externo', 'id_documento_interno', 'path', 'nombre', 'extension', 'peso'];
    protected $hidden = [];  

    public static function search($data=[])
    {

        $result = Anexo::select('*');

        if(array_key_exists('id_documento_externo', $data)){
            $filtro= $data["id_documento_externo"];
            $result= $result->where( function($sql) use ($filtro)
                            {
                                $sql->where('id_documento_externo','=', $filtro);
                            });
        }

        if(array_key_exists('id_documento_interno', $data)){
            $filtro= $data["id_documento_interno"];
            $result= $result->where( function($sql) use ($filtro)
                            {
                                $sql->where('id_documento_interno','=', $filtro);
                            });
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