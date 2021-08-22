<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioSede extends Model
{
    protected $table= 'user_sede';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'user_id',
    	'sede_id',
        'created_at',
        'update_at'
    ];
    protected $guarded=[

    ];
}
