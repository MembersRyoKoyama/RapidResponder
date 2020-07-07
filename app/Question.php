<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    /*protected $fillable = [
        'name', 
        'mail', 
        'tel',
        'products_id',
        'content',
        'date'
    ];*/
    public function products()
    {
        return $this->belongsTo('App\Product');
    }
    public function users()
    {
        return $this->belongsTo('App\User', 'staffs_id');
    }
    public function answers()
    {
        return $this->hasMany('App\Answer', 'questions_id');
    }
    protected $fillable = ['end', 'staffs_id'];
    public $timestamps = false;
}
