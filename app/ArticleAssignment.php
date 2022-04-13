<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ArticleAssignment extends Pivot
{
    protected $table = 'article_assignment';
    protected $primaryKey = 'article_assignment_id';

    protected $fillable = [
        'article_id', 'user_id', 'is_assessed'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function article()
    {
        return $this->belongsTo('App\Article', 'article_id', 'article_id');
    }
}
