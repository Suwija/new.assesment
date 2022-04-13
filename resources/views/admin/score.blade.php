@extends('layouts.admin.app')

@section('content')

    <div class="mb-3">
        <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
    </div>

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Article Score</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="h5 d-inline align-middle">{{ $article->title }}</h5>
                    </div>
                    <table class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Question</th>
                                <th>User</th>
                                <th>Score</th>
                                <th>Sum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($qustionnaire as $i => $quest)
                                <tr>
                                    <td @if (count($quest->articleQuestionnaire) > 0) rowspan="{{ count($quest->articleQuestionnaire) }}" @endif>{{ $i + 1 }}</td>
                                    <td @if (count($quest->articleQuestionnaire) > 0) rowspan="{{ count($quest->articleQuestionnaire) }}" @endif>{{ $quest->question }}</td>
                                    @foreach ($quest->articleQuestionnaire as $idx => $det)
                                        @if ($idx > 0)
                                <tr>
                            @endif
                            <td>{{ $det->user->name }}</td>
                            <td>{{ $det->score }}</td>
                            @if ($idx > 0)
                                </tr>
                            @else
                            <td @if (count($quest->articleQuestionnaire) > 0) rowspan="{{ count($quest->articleQuestionnaire) }}" @endif>{{ $quest['sum'] }}</td>
                            @endif
                            @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
