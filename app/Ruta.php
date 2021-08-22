<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $table= 'ruta';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'ruta',
    	'system_state'
    ];
    protected $guarded=[

    ];
}
