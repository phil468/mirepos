<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaIngreso extends Model
{
    protected $table= 'nota_ingreso';
    protected $primaryKey= 'No';
    public $timestamps=false;
    protected $fillable =[
    	'CODIGO',
    	'DESCRIPCION',
    	'UM',
    	'CANTIDAD',
    	'PRE_UNIT',
    	'IMPORTE',
        'created_at',
    ];
    protected $guarded=[

    ];
}
