<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OOJJ extends Model
{
    protected $table= 'oojjs';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'nombre',
    	'sede_id',
    	'permanencia_id',
    	'instancia_id',
    	'especialidad_id',
    	'presupuesto_id',
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

