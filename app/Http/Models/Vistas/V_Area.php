<?php

namespace App\Http\Models\Vistas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class V_Area extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'vst_areas';
    protected $fillable = [
        'id', 'id_dependencia', 'subsecretaria', 'direccion', 'departamento', 'oficina', 'id_titular', 'titulo', 'cargo', 'sexo', 'nombre', 'ap_paterno', 'ap_materno', 'activo'
    ];

    protected $hidden = [
        //'id',
    ];
 
}