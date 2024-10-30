<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BookController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        $book = Book::latest()->paginate(5);

        return view('book.index', compact('book'));
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'pages' => 'required',
            'image' => 'required|image'
        ]);

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('public/image'), $imageName);
        $imagePath = 'public/image/' . $imageName;

        Book::create([ 
            'title' => $request->title, 
            'author' => $request->author, 
            'pages' => $request->pages,
            'image' => $imagePath
        ]); 

        try {
            return redirect()->route('book.index')->with('success', 'Book Added Successfully!');
        } catch (Exception $e) {
            return redirect()->route('book.index')->with('error', 'Error Occured During Process');
        }
    }

    public function edit($id)
    {
        $book = Book::find($id);
        return view('book.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        $this->validate($request, [
            'title' => 'nullable', 
            'author' => 'nullable', 
            'pages' => 'nullable',
            'image' => 'nullable|image'
        ]);

        if ($request->filled('title')) {
            $book->title = $request->title;
        }
        if ($request->filled('author')) {
            $book->author = $request->author;
        }
        if ($request->filled('pages')) {
            $book->pages = $request->pages;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('public/image'), $imageName);
            $imagePath = 'public/image/' . $imageName;

            if (File::exists(public_path($book->image))) {
                File::delete(public_path($book->image));
            }
            $book->image = $imagePath;
        }

        $book->save();
        return redirect()->route('book.index')->with(['success' => 'Data Changed Successfully!']);
    }

    public function destroy($id) 
    { 
        $book = Book::find($id);
        File::delete(public_path($book->image));
        $book->delete(); 
        return redirect()->route('book.index')->with(['success' => 'Data Deleted Successfully!']); 
    }
}
