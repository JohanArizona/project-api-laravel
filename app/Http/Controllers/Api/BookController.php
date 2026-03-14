<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json([
            'success' => true,
            'message' => 'List Data Books',
            'data' => $books
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|integer',
        ]);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
        ]);

        if ($book) {
            return response()->json([
                'success' => true,
                'message' => 'Book Created',
                'data' => $book
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Book Failed to Save',
                'data' => null
            ], 400);
        }
    }

    public function show($id)
    {
        $book = Book::find($id);

        if ($book) {
            return response()->json([
                'success' => true,
                'message' => 'Book Detail',
                'data' => $book
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Book Not Found',
                'data' => null
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|integer',
        ]);

        $book = Book::find($id);

        if ($book) {
            $book->update([
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'year' => $request->year,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Book Updated',
                'data' => $book
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Book Not Found',
                'data' => null
            ], 404);
        }
    }

     public function destroy($id)
    {
        $book = Book::find($id);

        if ($book) {
            $book->delete();

            return response()->json([
                'success' => true,
                'message' => 'Book Deleted',
                'data' => null
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Book Not Found',
                'data' => null
            ], 404);
        }
    }
    //
}
