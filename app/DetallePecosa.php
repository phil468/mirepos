<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePecosa extends Model
{
    protected $table= 'detalle_pecosa';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'pecosa_id',
    	'producto_id',
    	'cantidad',
    	'importe',
    	'importe_total',
    	'system_state',
        'user_create',
        'user_delete',
        'created_at',
        'deleted_at'
    ];
    protected $guarded=[

    ];
}
