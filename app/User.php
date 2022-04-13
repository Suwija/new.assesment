<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name', 'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // the pivot
    public function articleAssignment()
    {
        return $this->hasMany('App\ArticleAssignment', 'user_id', 'user_id');
    }

    // User can see the article assigned to score
    public function article()
    {
        return $this->belongsToMany('App\Article', 'article_assignment', 'user_id', 'article_id')->using('App\ArticleAssignment');
    }

    // The pivot, to also see the score of each article
    public function articleQuestionnaire()
    {
        return $this->hasMany('App\ArticleQuestionnaire', 'user_id', 'user_id');
    }
}
