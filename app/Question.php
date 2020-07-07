<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
<<<<<<< HEAD
    //
    /*protected $fillable = [
        'name', 
        'mail', 
        'tel',
        'products_id',
        'content',
        'date'
    ];*/
=======

    public $timestamps = false;
>>>>>>> 91295979b394c194025039cabd0bfc0c1cc0fef9
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
<<<<<<< HEAD
    public $timestamps = false;
=======
>>>>>>> 91295979b394c194025039cabd0bfc0c1cc0fef9
}
