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
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'questions_tags', 'questions_id', 'tags_id')
            ->using('App\QuestionTag');
    }
    public function filterByTags($tagid)
    {
        return $this
            ->belongsToMany('App\Tag', 'questions_tags', 'questions_id', 'tags_id')
            ->using('App\QuestionTag')
            ->wherePivotIn('priority', $tagid);
    }
    protected $fillable = ['end', 'staffs_id'];
    protected $dates = ['date'];
}
