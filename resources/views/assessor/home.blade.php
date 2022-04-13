@extends('layouts.admin.app')

@section('content')
@if (Session::has('message'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-icon">
            <i class="far fa-fw fa-bell"></i>
        </div>
        <div class="alert-message">
            <strong>{{ Session::get('message') }}</strong>
        </div>
    </div>
@elseif (Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <div class="alert-icon">
        <i class="far fa-fw fa-bell"></i>
    </div>
    <div class="alert-message">
        <strong>{{ Session::get('error') }}</strong>
    </div>
</div>
@endif

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Assessment</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">List of Assigned Article</h5>
                </div>
                <div class="card-body">
                    <table id="main_table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Year</th>
                                <th>Publication</th>
                                <th>Authors</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $i => $article)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->year }}</td>
                                    <td>{{ $article->publication }}</td>
                                    <td>{{ $article->authors }}</td>
                                    <td>
                                        @if($article->articleAssignment[0]->is_assessed==1)
                                        <a href="{{ route('assess', ['article_id' => $article->article_id]) }}"
                                            class="btn btn-success">Done</a>
                                        @else
                                        <a href="{{ route('assess', ['article_id' => $article->article_id]) }}"
                                            class="btn btn-primary">Assess</a>
                                        @endif
                                        </td>
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
    <script src="{{ asset('dist/js/datatables.js') }}"></script>
    <script>
        // DATATABLE INIT
        LANG_DT = {
            "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
            "sProcessing": "Sedang memproses...",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sSearch": "Cari:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Pertama",
                "sPrevious": "Sebelumnya",
                "sNext": "Selanjutnya",
                "sLast": "Terakhir"
            }
        }
        DT_MAIN = $("#main_table").DataTable({
            "language": LANG_DT
        })
    </script>
@endsection
