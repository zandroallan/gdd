<?php
namespace App\Http\Models\Configuracion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionRole extends Model {
    use SoftDeletes;
    protected $table = 'permission_role';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'permission_id', 'role_id']; 

    public static function lists($role){
        $result= PermissionRole::where('role_id',$role)->orderBy('permission_id','ASC')->lists('permission_id','permission_id','deleted_at');            
        return $result;            
    }
    
}
