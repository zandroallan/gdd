<?php
namespace App\Http\Models\Configuracion;
//use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;
use Illuminate\Database\Eloquent\SoftDeletes;
class Permission extends EntrustPermission {
    use SoftDeletes;
    protected $table = 'permissions';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'display_name', 'description'];  

    public static function lists(){
        $result= Permission::orderBy('name','ASC')->lists('display_name','id','deleted_at');            
        return $result;            
    }
    
    public static function search($data){
        $query= Permission::select('id', 'name', 'display_name', 'description');       
        if(array_key_exists('filtro', $data)){
            $filtro= $data["filtro"];
            $query= $query->where('display_name', 'LIKE', "%".$filtro."%");            
        }              
        $query= $query->orderBy('display_name','ASC');          
        return $query;
    }    
}
