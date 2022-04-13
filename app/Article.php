<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $table = 'article';
    protected $primaryKey = 'article_id';

    protected $fillable = [
        'no', 'title', 'publication', 'index', 'quartile', 'year', 'authors', 'abstracts', 'keywords', 'language', 'type', 'publisher', 'references_ori', 'references_filter', 'cited', 'cited_gs', 'citing_new', 'keyword', 'edatabase', 'edatabase_2', 'is_assessed', 'file'
    ];

    // The pivot, to also see the score of each article
    public function articleQuestionnaire()
    {
        return $this->hasMany('App\ArticleQuestionnaire', 'article_id', 'article_id');
    }

    public function questionnaire()
    {
        return $this->belongsToMany('App\Questionnaire', 'article_questionnaire', 'article_id', 'questionnaire_id')->using('App\ArticleQuestionnaire')->withPivot('score','user_id');
    }

    // To see who assigned to this article
    public function articleAssignment()
    {
        return $this->hasMany('App\ArticleAssignment', 'article_id', 'article_id');
    }
}
