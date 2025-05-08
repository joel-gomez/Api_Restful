<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return Author::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'birthdate' => 'required|date',
            'nationality' => 'required|string',
        ]);

        $author = Author::create($validated);

        return response()->json($author, 201);
    }

    public function show($id)
    {
        return Author::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string',
            'birthdate' => 'date',
            'nationality' => 'string',
        ]);

        $author->update($validated);

        return response()->json($author);
    }

    public function destroy($id)
    {
        Author::findOrFail($id)->delete();
        return response()->json(['message' => 'Autor eliminado.']);
    }
}
