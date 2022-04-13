<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function edit($article_id)
    {
        $article = Article::findOrFail($article_id);

        return view('admin.edit', compact('article'));
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $article = Article::create($input);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filenametostore = uniqid("file") . "." . $file->getClientOriginalExtension();
            $input['file'] = $request->file('file')
                ->storeAs('file', $filenametostore, ['disk' => 'public']);
        }
        $art = $article->update($input);
        if ($art) {
            return redirect()->route('home')->with('message', 'Berhasil menambahkan data article');
        }
        return redirect()->back()->with('error', 'Gagal menambahkan data article');
    }


    public function update(Request $request, $article_id)
    {
        $input = $request->all();

        $article = Article::find($article_id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filenametostore = uniqid("file") . "." . $file->getClientOriginalExtension();
            $input['file'] = $request->file('file')
                ->storeAs('file', $filenametostore, ['disk' => 'public']);
        }
        $art = $article->update($input);
        if ($art) {
            return redirect()->route('home')->with('message', 'Berhasil memperbarui data article');
        }
        return redirect()->back()->with('error', 'Gagal memperbarui data article');
    }

    public function destroy($article_id)
    {
        $art = Article::findOrFail($article_id)->delete();
        if ($art) {
            return redirect()->route('home')->with('message', 'Berhasil menghapus data article');
        }
        return redirect()->back()->with('error', 'Gagal menghapus data article');
    }
}
