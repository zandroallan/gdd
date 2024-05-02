<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait { restore as private restoreA; }
    use SoftDeletes { restore as private restoreB; }
    protected $dates = ['deleted_at'];
    protected $table = 'usuarios';
    protected $fillable = [
        'id',
        'activo',
        'id_area',
        'nombre',        
        'nickname',
        'img',
        'password',
        'curp'
    ];
 

    public function restore()
    {
        $this->restoreA();
        $this->restoreB();
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function edit($id){
        $query= User::select('usuarios.*', 'role_user.role_id as id_rol');  
        $query= $query->leftJoin('role_user', 'usuarios.id','=','role_user.user_id');
        $query= $query->where('usuarios.id',$id);
        //$query= $query->groupBy('usuarios.id'); 
        $query= $query->first();
        return $query;
    }    

    public static function search($data=[]){
        $result = User::select('*');
        if(array_key_exists('nombre', $data)){
            $filtro= $data["nombre"];
            $result= $result->where( function($sql) use ($filtro)
                            {
                                $sql->where('nombre','=', $filtro);
                            });
        }

        if(array_key_exists('nickname', $data)){
            $filtro= $data["nickname"];
            $result= $result->where( function($sql) use ($filtro)
                            {
                                $sql->where('nickname','=', $filtro);
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

    public static function usuario_persona($data=[])
    {
        $result=User::select('usuarios.*', 
            'personal.curp',
            DB::raw("CONCAT_WS(' ',personal.nombre, personal.apellido1, personal.apellido2) as persona"), 
            'personal.foto', 
            'personal.correo_personal',
            'padron.correo_laboral'
        );
        $result=$result->join('personal', 'usuarios.id_persona','=','personal.id');
        $result=$result->join('padron', 'personal.id','=','padron.id_personal');
        if(array_key_exists('curp', $data)){
            $filtro= $data["curp"];
            $result= $result->where( function($sql) use ($filtro){
                $sql->where('personal.curp','=', $filtro);
            });
        }
        $result=$result->orderBy('personal.id','DESC');
        return $result;
    }
}
