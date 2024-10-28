<?php

namespace App\Http\Controllers;

use Exceptioin;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
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
            'pages' => 'required'
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'pages' => $request->pages
        ]);

        try {
            return redirect()->route('book.index');
        } catch (Exception $e) {
            return redirect()->route('book.index');
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
            'title' => 'required',
            'author' => 'required',
            'pages' => 'required'
        ]);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'pages' => $request->pages
        ]);

        return redirect()->route('book.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        $book->delete();

        return redirect()->route('book.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
