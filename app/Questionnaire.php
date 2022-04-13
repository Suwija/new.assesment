<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $table = 'questionnaire';
    protected $primaryKey = 'questionnaire_id';

    protected $fillable = [
        'questionnaire_id', 'question', 'desc_pos', 'desc_neg', 'desc_net'
    ];

    // We can see the questionnaire of the article
    public function article()
    {
        return $this->belongsToMany('App\Article', 'article_questionnaire', 'questionnaire_id', 'article_id')->using('App\ArticleQuestionnaire');
    }

    // To see the score of a questionnaire for certain article
    public function articleQuestionnaire()
    {
        return $this->hasMany('App\ArticleQuestionnaire', 'questionnaire_id', 'questionnaire_id');
    }
}
