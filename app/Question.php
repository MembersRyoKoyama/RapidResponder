<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'name', 
        'mail', 
        'tel',
        'products_id',
        'content',
        'date'
    ];
}
