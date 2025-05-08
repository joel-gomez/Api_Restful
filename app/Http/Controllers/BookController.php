<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('author')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'isbn' => 'required|string|unique:books',
            'published_date' => 'required|date',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    public function show($id)
    {
        return Book::with('author')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'string',
            'isbn' => 'string|unique:books,isbn,' . $id,
            'published_date' => 'date',
            'author_id' => 'exists:authors,id',
        ]);

        $book->update($validated);

        return response()->json($book);
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return response()->json(['message' => 'Libro eliminado.']);
    }
}
