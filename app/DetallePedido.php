<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table= 'detalle_pedido';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'pedido_id',
    	'producto_id',
    	'cantidad',
    	'system_state',
        'user_create',
        'user_delete',
        'created_at',
        'deleted_at'
    ];
    protected $guarded=[

    ];
}
