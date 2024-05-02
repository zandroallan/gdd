<?php

namespace App\Http\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class C_Titulo extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'c_titulos';
    protected $fillable = [
        'id', 'nombre'
    ];

    protected $hidden = [
        //'id',
    ];

}