@extends('layouts.admin.app')

@section('content')

    <div class="mb-3">
        <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
    </div>

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Add Article</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form enctype="multipart/form-data" method="POST" action="{{ route('storeArticle') }}">
                    @csrf
                    <div class="card-body row">
                        <div class="col-4 mb-3">
                            <label class="form-label">No</label>
                            <input name="no" class="form-control"  
                            placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-4 mb-3">
                            <label class="form-label">Upload File</label>
                            <input type="file" name="file" class="form-control" placeholder="Input" spellcheck="false"
                                data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Title</label>
                            <input name="title" class="form-control"  
                            placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Publication</label>
                            <input name="publication" class="form-control" 
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Index</label>
                            <input name="index" class="form-control"  
                            placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-4 mb-3">
                            <label class="form-label">Quartile</label>
                            <input name="quartile" class="form-control" 
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-4 mb-3">
                            <label class="form-label">Year</label>
                            <input name="year" class="form-control"  
                            placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Authors</label>
                            <input name="authors" class="form-control" 
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Abstracts</label>
                            <textarea rows="10" name="abstracts" class="form-control" placeholder="Input"
                                spellcheck="false" data-ms-editor="true"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Keywords</label>
                            <textarea rows="5" name="keywords" class="form-control" placeholder="Input" spellcheck="false"
                                data-ms-editor="true"></textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Language</label>
                            <input name="language" class="form-control" 
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Type</label>
                            <input name="type" class="form-control"  
                            placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Publisher</label>
                            <input name="publisher" class="form-control" 
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">References ORI</label>
                            <textarea rows="10" name="references_ori" class="form-control" placeholder="Input"
                                spellcheck="false" data-ms-editor="true"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">References Filter</label>
                            <textarea rows="5" name="references_filter" class="form-control" placeholder="Input"
                                spellcheck="false" data-ms-editor="true"></textarea>
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">Cited</label>
                            <input name="cited" class="form-control"  
                            placeholder="Input"
                                spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">Cited GS</label>
                            <input name="cited_gs" class="form-control" 
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">Citing New</label>
                            <input name="citing_new" class="form-control" 
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Keyword</label>
                            <input name="keyword" class="form-control" 
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Edatabase</label>
                            <input name="edatabase" class="form-control" 
                                placeholder="Input" spellcheck="false" data-ms-editor="true">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Edatabase 2</label>
                            <input name="edatabase_2" class="form-control" 
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
