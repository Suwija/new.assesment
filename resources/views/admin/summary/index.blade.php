@extends('layouts.admin.app')

@section('content')

    <div class="row">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Article Not Assessed Per User</h1>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="article_notassigned_table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID - No</th>
                                <th>Article</th>
                                <th>Users</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articleNotAssessed as $i => $article)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $article->article_id }} - {{ $article->no }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>
                                        @foreach ($article->articleAssignment as $j => $articleAssign)
                                            @if ($articleAssign->is_assessed == 1)
                                                <span class="badge bg-success"> {{ $articleAssign->user->name }}</span>
                                            @else
                                                <span class="badge bg-danger"> {{ $articleAssign->user->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Score Per Question</h1>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bar Chart</h5>
                </div>
                <div class="card-body">
                    <div class="chart w-100">
                        <div id="spq-bar"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Column Chart</h5>
                </div>
                <div class="card-body">
                    <div class="chart w-100">
                        <div id="spq-column"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Pie Chart</h5>
                </div>
                <div class="card-body text-center">
                    <div class="chart w-100">
                        <div id="spq-pie" style="max-width: 440px;margin:auto;"></div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Score Per User</h1>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bar Chart</h5>
                </div>
                <div class="card-body">
                    <div class="chart w-100">
                        <div id="spu-bar"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Column Chart</h5>
                </div>
                <div class="card-body">
                    <div class="chart w-100">
                        <div id="spu-column"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Pie Chart</h5>
                </div>
                <div class="card-body text-center">
                    <div class="chart w-100">
                        <div id="spu-pie" style="max-width: 440px;margin:auto;"></div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>

@endsection
@section('js')
    <script src="{{ asset('dist/js/datatables.js') }}"></script>
    <script>
        var scorePerQuestion = {!! $scorePerQuestion !!}
        var scorePerUser = {!! $scorePerUser !!}
    </script>
    <script src="{{ asset('js/summary.js') }}"></script>
@endsection
