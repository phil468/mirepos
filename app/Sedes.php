<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sedes extends Model
{
    protected $table= 'sedes';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'nombre',
    	'direccion',
    	'coordenadas_x',
    	'coordenadas_y',
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
