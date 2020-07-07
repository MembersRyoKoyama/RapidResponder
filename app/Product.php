<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
    //
=======
>>>>>>> 91295979b394c194025039cabd0bfc0c1cc0fef9
    public function questions()
    {
        return $this->hasMany('App\Question')->oldest();
    }
}
