<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleQuestionnaire;
use App\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleQuestionnaireController extends Controller
{
    public function viewScore($article_id)
    {
        $article = Article::find($article_id);

        $qustionnaire = Questionnaire::with(['articleQuestionnaire' => function ($q) use ($article_id) {
            $q->with(['user', 'article'])->where('article_id', $article_id);
        }])->whereHas('articleQuestionnaire', function ($q) use ($article_id) {
            $q->where('article_id', $article_id);
        })->get();

        foreach ($qustionnaire as $i => $quest) {
            $sum = 0;
            foreach ($quest->articleQuestionnaire as $idx => $det) {
                $sum += $det->score;
            }
            $qustionnaire[$i]['sum'] = $sum;
        }

        return view('admin.score', compact('qustionnaire', 'article'));
    }

    public function showArticleByKode($kode)
    {
        $article = Article::where('no', $kode)->firstOrFail();
        $related = explode(';', $article->citing_new);

        return view('assessor.showarticle', compact('article', 'related'));
    }

    public function assess($article_id)
    {
        $qustionnaire = Questionnaire::all();
        foreach ($qustionnaire as $quest) {
            $articleQuestionnaire = ArticleQuestionnaire::firstOrCreate([
                'article_id' => $article_id,
                'questionnaire_id' => $quest->questionnaire_id,
                'user_id' => Auth::user()->user_id
            ]);
        }

        $article = Article::with(['questionnaire' => function ($q) {
            $q->wherePivot(
                'user_id',
                Auth::user()->user_id
            );
        }])->whereHas('articleAssignment', function ($q) {
            $q->where('user_id', Auth::user()->user_id);
        })->findOrFail($article_id);

        $related = explode(';', $article->citing_new);

        return view('assessor.assess', compact('article', 'related'));
    }

    public function submit(Request $request, $article_id)
    {
        $article = Article::with(['questionnaire', 'articleAssignment' => function ($q) {
            $q->where('user_id', Auth::user()->user_id);
        }])->whereHas('articleAssignment', function ($q) {
            $q->where('user_id', Auth::user()->user_id);
        })->findOrFail($article_id);

        foreach ($article->questionnaire as $quest) {
            $score = $request['choice-' . $quest->questionnaire_id];
            $articleQuestionnaire = ArticleQuestionnaire::firstOrNew([
                'article_id' => $article_id,
                'questionnaire_id' => $quest->questionnaire_id,
                'user_id' => Auth::user()->user_id
            ]);
            $articleQuestionnaire->score = $score;
            $articleQuestionnaire->save();
        }

        $article->articleAssignment[0]->is_assessed = 1;
        $article->articleAssignment[0]->save();

        return redirect()->route('home')->with('message', 'Berhasil mengisi kuisioner assessment');
    }
}
