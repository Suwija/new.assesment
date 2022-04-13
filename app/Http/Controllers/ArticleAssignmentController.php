<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleAssignment;
use App\ArticleQuestionnaire;
use App\User;
use Illuminate\Http\Request;

class ArticleAssignmentController extends Controller
{
    public function assign(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $is_failed = false;
        if ($user && $request->first_id && $request->last_id) {
            $articles = Article::where('article_id', '>=', $request->first_id)
                ->where('article_id', '<=', $request->last_id)->get();

            // ArticleQuestionnaire::where('user_id', $user_id)->delete();
            // Delete already assigned article

            foreach ($articles as $article) {
                $assign_count = ArticleAssignment::where('article_id', $article->article_id)->count();
                if ($assign_count < 3) {
                    ArticleAssignment::firstOrCreate([
                        'article_id' => $article->article_id,
                        'user_id' => $user_id
                    ]);
                } else {
                    $is_failed = true;
                }
            }
        }

        if ($user && $request->first_id_rem && $request->last_id_rem) {
            $del_articles = Article::where('article_id', '>=', $request->first_id_rem)
                ->where('article_id', '<=', $request->last_id_rem)->get();

            foreach ($del_articles as $article) {
                $art = ArticleAssignment::where('user_id', $user_id)
                    ->where('article_id', $article->article_id)->first();
                if ($art) {
                    $art->delete();
                }
            }
        }


        if ($is_failed) {
            return redirect()->back()->with('error', 'Terdapat assignment yang gagal karena artikel sudah dialokasikan ke 3 assessor');
        }
        return redirect()->back()->with('message', 'Berhasil memperbarui data assignment');
    }
}
