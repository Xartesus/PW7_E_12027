@extends('dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Booking</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('bookings') }}">Bookings</a></li>
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
                        <form action="{{ route('bookings.update', $bookings->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group" style="display: flex; justify-content: space-between">
                                <div style="width: 100%; padding-right: 5px"> 
                                    <label for="class">Class</label>
                                    <input type="text" class="form-control" id="class" name="class" placeholder="{{ $bookings->class }}">
                                </div>
                                
                                <div style="width: 100%">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="{{ $bookings->price }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_book">Book</label>
                                <select id="id_book" name="id_book">
                                    <option style="background-color: blue; color: white" value="{{ $bookings->id_book }}">{{ $bookings->book->title }}</option>
                                    @foreach ($book as $item)
                                        @if ($item->id != $bookings->id_book)
                                        {
                                            <option value="{{$item->id }}">{{$item->title }}</option>
                                        }
                                        @endif
                                    @endforeach
                                </select>
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