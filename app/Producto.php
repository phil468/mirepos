<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table= 'producto';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'codigo',
    	'nombre',
    	'descripcion',
    	'categoria_id',
        'foto',
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
