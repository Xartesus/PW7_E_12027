@extends('dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Booking</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('book') }}">Bookings</a></li>
                    <li class="breadcrumb-item active">Add Booking</li>
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
                        <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data" id="form">
                            @csrf
                            <div class="form-group" style="display: flex; justify-content: space-between">
                                <div style="width: 100%; padding-right: 5px"> 
                                    <label for="class">Class</label>
                                    <input type="text" class="form-control" id="class" name="class" placeholder="Enter Class' Level">
                                    <div class="error" style="color: red;"> </div>
                                </div>
                                
                                <div style="width: 100%">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price">
                                    <div class="error" style="color: red;"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_book">Book</label>
                                <select id="id_book" name="id_book">
                                    <option value="" disabled selected>Select a Book</option>
                                    @forelse ($book as $item)
                                        <option value="{{$item->id }}">{{$item->title }}</option>
                                    @empty
                                        <option value="">No Books Available</option>
                                    @endforelse
                                </select>
                                <div class="error" style="color: red;"> </div>
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
    const form = document.getElementById('form');
    const classInput = document.getElementById('class');
    const priceInput = document.getElementById('price');
    const idBookInput = document.getElementById('id_book');

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
        const classValue = classInput.value.trim();
        const priceValue = priceInput.value.trim();
        const idBookValue = idBookInput.value.trim();

        let isValid = true;

        if (classValue === '') {
            setError(classInput, '! Class Cannot Be Empty');
            isValid = false;
        } else {
            setSuccess(classInput);
        }

        if (priceValue === '') {
            setError(priceInput, '! Price Cannot Be Empty');
            isValid = false;
        } else {
            setSuccess(priceInput);
        }

        if (idBookValue === '') {
            setError(idBookInput, '! Book Cannot Be Empty');
            isValid = false;
        } else {
            setSuccess(idBookInput);
        }

        return isValid;
    };
</script>
@endsection