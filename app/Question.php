<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    public $timestamps = false;
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
}
