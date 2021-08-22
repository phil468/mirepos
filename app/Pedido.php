<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table= 'pedido';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'oojj_id',
    	'fecha',
    	'total_producto',
    	'system_state',
        'user_create',
        'user_delete',
        'created_at',
        'deleted_at'
    ];
    protected $guarded=[

    ];
}
