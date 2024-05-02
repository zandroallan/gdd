<?php
namespace App\Http\Models\Configuracion;
/*use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;*/
use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends EntrustRole {
    use SoftDeletes;
    protected $table = 'roles';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'display_name', 'description']; 
    
    public static function lists(){
        $result= Role::orderBy('display_name','DESC')->pluck('display_name','id','deleted_at')->prepend('Seleccionar rol...', "")->all();         
        return $result;            

        $result= $result->orderBy('nombre','ASC')->pluck('nombre','id','deleted_at')->prepend('Seleccionar ambito...', "")->all();
        return $result;        
    }    

    public static function search($data){
        $query= Role::select('id', 'name', 'display_name', 'description');       
        if(array_key_exists('filtro', $data)){
            $filtro= $data["filtro"];
            $query= $query->where('display_name', 'LIKE', "%".$filtro."%");            
        }              
        $query= $query->orderBy('id','DESC');          
        return $query;
    }    
}
