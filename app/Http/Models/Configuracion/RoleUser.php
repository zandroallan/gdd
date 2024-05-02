<?php
namespace App\Http\Models\Configuracion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model {
    use SoftDeletes;
    protected $table = 'role_user';
    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'role_id']; 
    
    public static function lists(){
        $result= RoleUser::orderBy('name','DESC')->lists('name','id','deleted_at');            
        return $result;            
    }    

    public static function search($data){
        $query= RoleUser::select('users.*','roles.display_name as rol', 'c_dependencia.nombre as dependencia');
        $query= $query->leftJoin('roles', 'roles.id','=','role_user.role_id');
        $query= $query->leftJoin('users', 'users.id','=','role_user.user_id');
        $query= $query->leftJoin('c_dependencia', 'c_dependencia.id','=','users.id_dependencia');

        if(array_key_exists('role_id', $data)){
            $filtro= $data["role_id"];
            $query= $query->where('role_id', $filtro);            
        }              
        $query= $query->orderBy('id','DESC');          
        return $query;
    } 
    
    public static function edit($data){
        $query= RoleUser::select('*')->where('user_id', $data)->first();          
        return $query;
    }    
}
