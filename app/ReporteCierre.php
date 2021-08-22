<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReporteCierre extends Model
{
    protected $table= 'reporte_cierre';
    protected $primaryKey= 'No';
    public $timestamps=false;
    protected $fillable =[
    	'CODIGO',
    	'DESCRIPCION',
    	'UM',
    	'CANTIDAD',
    	'PRE_UNIT',
    	'IMPORTE',
    	'system_state',
        'user_create',
        'user_update',
        'user_delete',
        'created_at',
        'update_at',
        'deleted_at'
    ];
    protected $guarded=[
        'PRE_UNIT' => 'float',
    ];
}
