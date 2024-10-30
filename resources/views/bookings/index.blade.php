@extends('dashboard') 
@section('content') 
<div class="content-header"> 
    <div class="container-fluid"> 
        <div class="row mb-2"> 
            <div class="col-sm-6"> 
                <h1 class="m-0">BOOKINGS</h1> 
            </div> 
            <!-- /.col --> 
            
            <div class="col-sm-6"> 
                <ol class="breadcrumb float-sm-right"> 
                    <li class="breadcrumb-item"> 
                        <a href="{{ url('bookings')}}">Bookings</a> 
                    </li> 
                    
                    <li class="breadcrumb-item active">Index</li> 
                </ol> 
            </div> 
            <!-- /.col -->    
        </div> 
        <!-- /.row --> 
    </div> 
    <!-- /.container-fluid --> 
</div> 
<!-- /.content-header -->

<!-- Main content --> 
<div class="content"> 
    <div class="container-fluid"> 
        <div class="row"> 
            <div class="col-12"> 
                <div class="card"> 
                    <div class="card-body">
                        <a href="{{ route('bookings.create') }}" class="btn btnmd btn-success mb-3">Add Booking</a> 
                        <div class="table-responsive p-0"> 
                            <table class="table table-hover text-no-wrap"> 
                                <thead> 
                                    <tr>
                                        <th class="text-center">Poster</th>
                                        <th class="text-center">Title</th> 
                                        <th class="text-center">Class</th> 
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Action</th>
                                    </tr> 
                                </thead> 
                                
                                <tbody> 
                                    @forelse ($bookings as $item) 
                                    <tr> 
                                        <td class="text-center">
                                            <img src="{{ asset($item->book->image) }}" alt="Book Image" width="100" height="100">
                                        </td>
                                        <td class="text-center">{{$item->book->title }}</td> 
                                        <td class="text-center">{{$item->class }}</td>
                                        <td class="text-center">{{$item->price }}</td>
                                        <td class="text-center"> 
                                            <form onsubmit="return confirm('Are You Sure ?');" action="{{ route('bookings.destroy', $item->id)}}" method="POST"> 
                                                <a href="{{ route('bookings.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a> 
                                                @csrf 
                                                @method('DELETE') 
                                                <button type="submit"class="btn btn-sm btn-danger">DELETE</button> 
                                            </form> 
                                        </td> 
                                    </tr> 
                                    @empty 
                                    <div class="alert alert-danger"> 
                                        Bookings Data Is Empty 
                                    </div> 
                                    @endforelse 
                                </tbody> 
                            </table> 
                        </div> 
                        {{ $bookings->links() }} 
                    </div> 
                    <!-- /.card-body --> 
                </div> 
                <!-- /.card --> 
            </div> 
            <!-- /.col-md-6 --> 
        </div> 
        <!-- /.row --> 
    </div> 
    <!-- /.container-fluid --> 
</div> 
@endsection