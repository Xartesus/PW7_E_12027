@extends('dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Book</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('book') }}">Books</a></li>
                    <li class="breadcrumb-item active">Add Book</li>
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
                        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image">Poster</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <div class="error" style="color: red;"> </div>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                                <div class="error" style="color: red;"> </div>
                            </div>
                            <div class="form-group" style="display: flex; justify-content: space-between">
                                <div style="width: 100%; padding-right: 5px"> 
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control" id="author" name="author" placeholder="Enter Author">
                                    <div class="error" style="color: red;"> </div>
                                </div>
                                
                                <div style="width: 100%">
                                    <label for="pages">Pages</label>
                                    <input type="text" class="form-control" id="pages" name="pages" placeholder="Enter Pages">
                                    <div class="error" style="color: red;"> </div>
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

<script>
    const form = document.querySelector('form');
    const titleInput = document.getElementById('title');
    const authorInput = document.getElementById('author');
    const pagesInput = document.getElementById('pages');
    const imageInput = document.getElementById('image');

    form.addEventListener('submit', e => {
        const isValid = validateInputs();

        if (!isValid) {
            e.preventDefault();
        }
     });

    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    }

    const setSuccess = element => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    };

    const validateInputs = () => {
        const titleValue = titleInput.value.trim();
        const authorValue = authorInput.value.trim();
        const pagesValue = pagesInput.value.trim();
        const imageValue = imageInput.value.trim();

        let isValid = true;

        if (titleValue === '') {
            setError(titleInput, '! Title Cannot Be Empty');
            isValid = false;
        } else {
            setSuccess(titleInput);
        }

        if (authorValue === '') {
            setError(authorInput, '! Author Cannot Be Empty');
            isValid = false;
        } else {
            setSuccess(authorInput);
        }

        if (pagesValue === '') {
            setError(pagesInput, '! Pages Cannot Be Empty');
            isValid = false;
        } else {
            setSuccess(pagesInput);
        }

        if (imageValue === '') {
            setError(imageInput, '! Image Cannot Be Empty');
            isValid = false;
        } else {
            setSuccess(imageInput);
        }

        return isValid;
    };
</script>
@endsection