<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidades extends Model
{
    protected $table= 'especialidades';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'nombre',
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
