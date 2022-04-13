<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleQuestionnaire extends Pivot
{
    use SoftDeletes;

    protected $table = 'article_questionnaire';
    protected $primaryKey = 'article_questionnaire_id';

    protected $fillable = [
        'questionnaire_id', 'article_id', 'user_id', 'score'
    ];

    public function questionnaire()
    {
        return $this->belongsTo('App\Questionnaire', 'questionnaire_id', 'questionnaire_id');
    }

    public function article()
    {
        return $this->belongsTo('App\Article', 'article_id', 'article_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }
}
