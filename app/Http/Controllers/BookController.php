<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    // Get Data (Read)
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('publisher')) {
            $query->where('Publisher', $request->input('publisher'));
        }
        
        if ($request->has('year')) {
            $query->where('Publish Date (Year)', (int) $request->input('year'));
        }

        $books = $query->take(10)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'List data buku',
            'data' => $books
        ], 200);
    }

    // Add Data (Create)
    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required',
            'Authors' => 'required',
            'Publisher' => 'required',
            'Publish Date (Year)' => 'required|integer'
        ]);

        $book = new Book();
        $book->Title = $request->Title;
        $book->Authors = $request->Authors;
        $book->Publisher = $request->Publisher;
        $book->{'Publish Date (Year)'} = (int) $request->{'Publish Date (Year)'};
        $book->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil ditambahkan',
            'data' => $book
        ], 201);
    }

    // Get Data (Read One)
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $book
        ], 200);
    }

    // Update Data (Update)
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        $book->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil diupdate',
            'data' => $book
        ], 200);
    }

    // Destroy Data (Delete)
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        $book->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil dihapus'
        ], 200);
    }
}