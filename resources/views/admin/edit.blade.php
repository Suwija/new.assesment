@extends('layouts.admin.app')

@section('content')

    <div class="mb-3">
        <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
    </div>

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Edit Article</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form enctype="multipart/form-data" method="POST" action="{{ route('updateArticle', ['article_id' => $article->article_id]) }}">
                    @csrf
                    <div class="card-body row">
                        <div class="col-2 mb-3">
                            <label class="form-label">No</label>
                            <input name="no" class="form-control" value="{{ $article->no }}" placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">Upload File</label>
                            <input type="file" name="file" class="form-control" placeholder="Input" spellcheck="false"
                                data-ms-editor="true">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">File Uploaded</label><br />
                            @if ($article->file)
                                <a id="article_file" target="_blank" href="/uploads/{{ $article->file }}"
                                    class="btn btn-primary">Download PDF</a>
                            @else
                                {{ '<None>' }}
                            @endif
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Title</label>
                            <input name="title" class="form-control" value="{{ $article->title }}" placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Publication</label>
                            <input name="publication" class="form-control" value="{{ $article->publication }}"
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Index</label>
                            <input name="index" class="form-control" value="{{ $article->index }}" placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-4 mb-3">
                            <label class="form-label">Quartile</label>
                            <input name="quartile" class="form-control" value="{{ $article->quartile }}"
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-4 mb-3">
                            <label class="form-label">Year</label>
                            <input name="year" class="form-control" value="{{ $article->year }}" placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Authors</label>
                            <input name="authors" class="form-control" value="{{ $article->authors }}"
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Abstracts</label>
                            <textarea rows="10" name="abstracts" class="form-control" placeholder="Input"
                                spellcheck="false" data-ms-editor="true">{{ $article->abstracts }}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Keywords</label>
                            <textarea rows="5" name="keywords" class="form-control" placeholder="Input" spellcheck="false"
                                data-ms-editor="true">{{ $article->keywords }}</textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Language</label>
                            <input name="language" class="form-control" value="{{ $article->language }}"
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Type</label>
                            <input name="type" class="form-control" value="{{ $article->type }}" placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Publisher</label>
                            <input name="publisher" class="form-control" value="{{ $article->publisher }}"
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">References ORI</label>
                            <textarea rows="10" name="references_ori" class="form-control" placeholder="Input"
                                spellcheck="false" data-ms-editor="true">{{ $article->references_ori }}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">References Filter</label>
                            <textarea rows="5" name="references_filter" class="form-control" placeholder="Input"
                                spellcheck="false" data-ms-editor="true">{{ $article->references_filter }}</textarea>
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">Cited</label>
                            <input name="cited" class="form-control" value="{{ $article->cited }}" placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">Cited GS</label>
                            <input name="cited_gs" class="form-control" value="{{ $article->cited_gs }}"
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">Citing New</label>
                            <input name="citing_new" class="form-control" value="{{ $article->citing_new }}"
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Keyword</label>
                            <input name="keyword" class="form-control" value="{{ $article->keyword }}"
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Edatabase</label>
                            <input name="edatabase" class="form-control" value="{{ $article->edatabase }}"
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Edatabase 2</label>
                            <input name="edatabase_2" class="form-control" value="{{ $article->edatabase_2 }}"
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-lg btn-block btn-info mt-2">SAVE ARTICLE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
