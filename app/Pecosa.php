<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pecosa extends Model
{
    protected $table= 'pecosa';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'oojj_id',
    	'fecha',
    	'pedido_id',
    	'codigo',
    	'total_pecosa',
    	'system_state',
        'user_create',
        'user_delete',
        'created_at',
        'deleted_at',
        'num_pecosa',
        'observacion'
    ];
    protected $guarded=[

    ];
}
