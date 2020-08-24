<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class QuestionTag extends Pivot
{
    //
    protected $table = 'questions_tags';
    public $timestamps = false;
}
