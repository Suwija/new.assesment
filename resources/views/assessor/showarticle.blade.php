@extends('layouts.admin.app')

@section('content')

    <div class="mb-3">
        <a href="{{ route('home') }}" class="btn btn-primary">Return to Assigned Article List</a>
    </div>
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Article Details</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body row">
                    <div class="col-8">
                        <h5 class="card-title">ID - No</h5>
                        <p class="card-text">{{ $article->article_id }} - {{ $article->no }}
                        </p>
                        <h5 class="card-title">Title</h5>
                        <p class="card-text">{{ $article->title ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Abstracts</h5>
                        <p class="card-text">{{ $article->abstracts ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Keywords</h5>
                        <p class="card-text">{{ $article->keywords ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Authors</h5>
                        <p class="card-text">{{ $article->authors ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Publisher</h5>
                        <p class="card-text">{{ $article->publisher ?? '<None>' }}
                        </p>
                    </div>
                    <div class="col-4">
                        <h5 class="card-title">File Attachment</h5>
                        <p class="card-text">
                            @if ($article->file)
                                <a target="_blank" href="{{ asset('uploads/' . $article->file) }}"
                                    class="btn btn-primary">Download PDF</a>
                            @else
                                {{ '<None>' }}
                            @endif
                        </p>
                        <h5 class="card-title">Publication</h5>
                        <p class="card-text">{{ $article->publication ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Index</h5>
                        <p class="card-text">{{ $article->index ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Year</h5>
                        <p class="card-text">{{ $article->year ?? 'None' }}
                        </p>
                        <h5 class="card-title">Quartile</h5>
                        <p class="card-text">{{ $article->quartile ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Language</h5>
                        <p class="card-text">{{ $article->language ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Type</h5>
                        <p class="card-text">{{ $article->type ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Cited</h5>
                        <p class="card-text">{{ $article->cited ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Cited GS</h5>
                        <p class="card-text">{{ $article->cited_gs ?? '<None>' }}
                        </p>
                        <h5 class="card-title">Citing (Related Article)</h5>
                        @foreach($related as $rel)
                        <a target="_blank" class="btn btn-primary" href="{{ route('showArticleByKode', ['kode' => $rel]) }}">{{$rel}}</a>
                        @endforeach
                        <h5 class="card-title">Database</h5>
                        <p class="card-text">{{ $article->edatabase ?? '<None>' }}{{ $article->edatabase_2 }}
                        </p>
                    </div>
                    <div class="col-12 mt-4">
                        <h5 class="card-title">References</h5>
                        <p class="card-text">
                        <pre>{{ $article->references_ori ?? '<None>' }}</pre>
                        </p>
                        <h5 class="card-title">References Filtered</h5>
                        <p class="card-text"><pre>{{ $article->references_filter ?? '<None>' }}</pre>
                        </p>
                        <h5 class="card-title">Search Keyword</h5>
                        <p class="card-text">{{ $article->keyword ?? '<None>' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
