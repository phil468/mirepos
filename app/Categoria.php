<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table= 'categorias';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'nombre',
    	'descripcion',
    	'system_state',
        'user_create',
        'user_update',
        'user_delete',
        'created_at',
        'update_at',
        'deleted_at'
    ];
    protected $guarded=[

    ];
}
