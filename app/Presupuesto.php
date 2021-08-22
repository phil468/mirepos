<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table= 'presupuesto';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'nombre',
    	'presupuesto',
    	'año',
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
