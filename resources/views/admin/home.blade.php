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
        <h1 class="h3 d-inline align-middle">User Management</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <p class="text-start m-4">
                    <button onclick="createUser()" class="btn btn-success">Add User</button>
                </p>
                <div class="card-body">
                    <table id="user_table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $i => $user)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <button class="btn btn-primary"
                                            onclick="editUser({{ $user->user_id }})">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form id="formEditUser" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">User Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body m-3">
                                <div class="col-12 mb-3" id="form_stok">
                                    <label class="form-label">Nama</label>
                                    <input name="name" id="name" class="form-control" placeholder="Input"
                                        spellcheck="false" data-ms-editor="true">
                                </div>
                                <div class="col-12 mb-3" id="form_stok">
                                    <label class="form-label">Username</label>
                                    <input name="username" id="username" class="form-control" placeholder="Input"
                                        spellcheck="false" data-ms-editor="true">
                                </div>
                                <div class="col-12 mb-3" id="form_stok">
                                    <label class="form-label">Password (isi jika ingin mengubah)</label>
                                    <input name="password" type="password" class="form-control" placeholder="Input"
                                        spellcheck="false" data-ms-editor="true">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>



    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Article Management</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <p class="text-start m-4">
                    <a href="{{ route('createArticle') }}" class="btn btn-success">Add Article</a>
                </p>
                <div class="card-body">
                    <table id="article_table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID - No</th>
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
                                    <td>{{ $article->article_id }} - {{ $article->no }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->year }}</td>
                                    <td>{{ $article->publication }}</td>
                                    <td>{{ $article->authors }}</td>
                                    <td>
                                        <a class="btn btn-info"
                                            href="{{ route('viewScore', ['article_id' => $article->article_id]) }}">Score</a>
                                        <a class="btn btn-primary"
                                            href="{{ route('editArticle', ['article_id' => $article->article_id]) }}">Edit</a>
                                        <button class="btn btn-danger"
                                            onclick="deleteArticle({{ $article->article_id }})">Delete</button>
                                        <form id="formDeleteArticle{{ $article->article_id }}"
                                            action="{{ route('deleteArticle', ['article_id' => $article->article_id]) }}"
                                            method="POST">
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="modalArticle" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form id="formEditArticle" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Edit File</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body m-3">
                                <div class="col-12 mb-3">
                                    <a id="article_file" target="_blank" href="" class="btn btn-primary">Download PDF</a>
                                </div>
                                <div class="col-12 mb-3">

                                    <label class="form-label">Upload File</label>
                                    <input type="file" name="file" class="form-control" placeholder="Input"
                                        spellcheck="false" data-ms-editor="true">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>



    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Assessment Management</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="user_assessment_table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>ID - No</th>
                                <th>Article</th>
                                <th>Asessed</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userArticles as $i => $userArt)
                                <tr>
                                    <td @if (count($userArt->articleAssignment) > 0) rowspan="{{ count($userArt->articleAssignment) }}" @endif>{{ $i + 1 }}</td>
                                    <td @if (count($userArt->articleAssignment) > 0) rowspan="{{ count($userArt->articleAssignment) }}" @endif>{{ $userArt->name }}</td>
                                    @if (count($userArt->articleAssignment) > 0)
                                        @foreach ($userArt->articleAssignment as $idx => $art)
                                            @if ($idx > 0)
                                                <tr>
                                            @endif
                                                <td>{{ $art->article->article_id ?? '-' }} - {{ $art->article->no ?? '-' }}</td>
                                                <td>{{ $art->article->title ?? '-' }}</td>
                                                <td>{{ $art->is_assessed == 1 ? 'Yes' : 'No' }}</td>
                                            @if ($idx > 0)
                                                </tr>
                                            @else
                                                    <td @if (count($userArt->article) > 0) rowspan="{{ count($userArt->article) }}" @endif>
                                                        <button class="btn btn-primary"
                                                            onclick="editUserAssignment({{ $userArt->user_id }})">Edit</button>
                                                    </td>
                                                </tr>
                                        @endif
                            @endforeach
                        @else
                            <td class="text-center" colspan="3">No article assigned</td>
                            <td @if (count($userArt->article) > 0) rowspan="{{ count($userArt->article) }}" @endif>
                                <button class="btn btn-primary"
                                    onclick="editUserAssignment({{ $userArt->user_id }})">Edit</button>
                            </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="modalUserAssessment" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form id="formAssignUser" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Assignment Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body m-3">
                                <div class="col-12 mb-3" id="form_stok">
                                    <label class="form-label">First Article ID to remove</label>
                                    <input name="first_id_rem" class="form-control" placeholder="Input" spellcheck="false"
                                        data-ms-editor="true">
                                </div>
                                <div class="col-12 mb-3" id="form_stok">
                                    <label class="form-label">Last Article ID to remove</label>
                                    <input name="last_id_rem" class="form-control" placeholder="Input" spellcheck="false"
                                        data-ms-editor="true">
                                </div>

                                <div class="col-12 mb-3" id="form_stok">
                                    <label class="form-label">First Article ID to add</label>
                                    <input name="first_id" class="form-control" placeholder="Input" spellcheck="false"
                                        data-ms-editor="true">
                                </div>
                                <div class="col-12 mb-3" id="form_stok">
                                    <label class="form-label">Last Article ID to add</label>
                                    <input name="last_id" class="form-control" placeholder="Input" spellcheck="false"
                                        data-ms-editor="true">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('dist/js/datatables.js') }}"></script>
    <script>
        var users = {!! $users !!}
        var articles = {!! $articles !!}
    </script>
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
