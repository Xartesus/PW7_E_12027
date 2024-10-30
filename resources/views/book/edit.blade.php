@extends('dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Book</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('book') }}">Books</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="image">Poster</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="{{ $book->title }}">
                            </div>
                            <div class="form-group" style="display: flex; justify-content: space-between">
                                <div style="width: 100%; padding-right: 5px"> 
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control" id="author" name="author" placeholder="{{ $book->author }}">
                                </div>
                                
                                <div style="width: 100%">
                                    <label for="pages">Pages</label>
                                    <input type="text" class="form-control" id="pages" name="pages" placeholder="{{ $book->pages }}">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection