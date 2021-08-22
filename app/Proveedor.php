<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table= 'proveedor';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'nombre',
    	'ruc',
    	'telefono',
    	'email',
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
