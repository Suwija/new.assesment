<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleAssignment;
use App\ArticleQuestionnaire;
use App\Questionnaire;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // $aq = ArticleQuestionnaire::whereNotNull('score')->get();
        // foreach ($aq as $aqq) {
        //     $aAs = ArticleAssignment::where('user_id', $aqq->user_id)
        //         ->where('article_id', $aqq->article_id)
        //         ->first();
        //     if($aAs!=null){
        //         $aAs->is_assessed = 1;
        //         $aAs->save();
        //     }
        // }

        if (Auth::user()->is_admin == 1) {
            $users = User::all();
            $userArticles = User::with(['articleAssignment' => function ($q) {
                $q->with('article');
            }])->get();
            $articles = Article::all();

            // return response()->json($userArticles);

            return view('admin.home', compact('users', 'articles', 'userArticles'));
        } else {
            $articles = Article::with(['articleAssignment' => function ($q) {
                $q->where('user_id', Auth::user()->user_id);
            }])->whereHas('articleAssignment', function ($q) {
                $q->where('user_id', Auth::user()->user_id);
            })->get();
            return view('assessor.home', compact('articles'));
        }
    }

    public function summary()
    {
        $articleNotAssessed = Article::select('article_id', 'no', 'title', 'file')->with(['articleAssignment.user'])->whereDoesntHave('articleAssignment.user')
            ->orWhereHas('articleAssignment', function ($q) {
                $q->where('is_assessed', 0);
            })->get();

        $scorePerQuestion = Questionnaire::with(['articleQuestionnaire.user', 'articleQuestionnaire.article:article_id,title,file'])->get();
        $scorePerUser = User::with(['articleQuestionnaire.questionnaire', 'articleQuestionnaire.article:article_id,title,file'])->get();

        return view('admin.summary.index', compact('articleNotAssessed', 'scorePerQuestion', 'scorePerUser'));
    }
}
