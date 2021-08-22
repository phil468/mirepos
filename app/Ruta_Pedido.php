<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruta_Pedido extends Model
{
    protected $table= 'ruta_pecosa';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'ruta_id',
    	'pecosa_id',
        'created_at'
    ];
    protected $guarded=[

    ];
}
