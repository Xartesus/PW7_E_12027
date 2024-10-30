<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookings;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BookingsController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        $bookings = Bookings::latest()->paginate(5);

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $book = Book::all();
        return view('bookings.create', compact('book'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_book' => 'required',
            'class' => 'required',
            'price' => 'required'
        ]);

        Bookings::create([ 
            'id_book' => $request->id_book, 
            'class' => $request->class, 
            'price' => $request->price
        ]); 

        try {
            return redirect()->route('bookings.index')->with('success', 'Booking Created Successfully!');
        } catch (Exception $e) {
            return redirect()->route('bookings.index')->with('error', 'Error Occured During Process');
        }
    }

    public function edit($id)
    {
        $bookings = Bookings::find($id);
        $book = Book::all();
        return view('bookings.edit', compact('bookings', 'book'));
    }

    public function update(Request $request, $id)
    {
        $bookings = Bookings::find($id);

        $this->validate($request, [
            'id_book' => 'nullable', 
            'class' => 'nullable', 
            'price' => 'nullable'
        ]);

        if ($request->filled('id_book')) {
            $bookings->id_book = $request->id_book;
        }
        if ($request->filled('class')) {
            $bookings->class = $request->class;
        }
        if ($request->filled('price')) {
            $bookings->price = $request->price;
        }

        $bookings->save();
        return redirect()->route('bookings.index')->with(['success' => 'Data Changed Successfully!']);
    }

    public function destroy($id) 
    { 
        $bookings = Bookings::find($id); 
        $bookings->delete(); 
        return redirect()->route('bookings.index')->with(['success' => 'Data Deleted Successfully!']); 
    }
}
