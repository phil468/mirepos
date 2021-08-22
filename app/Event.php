<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table= 'events';
    protected $primaryKey= 'id';
    public $timestamps=false;
    protected $fillable =[
    	'title',
    	'start',
        'end'
    ];
    protected $guarded=[

    ];
}
