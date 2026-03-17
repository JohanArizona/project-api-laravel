<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);

        return new BookResource(true, 'Daftar Buku', $books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'author'    => 'required|string|max:150',
            'publisher' => 'required|string|max:150',
            'year'      => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        $book = Book::create($validated);

        return new BookResource(true, 'Buku berhasil ditambahkan', $book);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return new BookResource(false, 'Buku tidak ditemukan', null);
        }

        return new BookResource(true, 'Detail Buku', $book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return new BookResource(false, 'Buku tidak ditemukan', null);
        }

        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'author'    => 'required|string|max:150',
            'publisher' => 'required|string|max:150',
            'year'      => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        $book->update($validated);

        return new BookResource(true, 'Buku berhasil diperbarui', $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return new BookResource(false, 'Buku tidak ditemukan', null);
        }

        $book->delete();

        return new BookResource(true, 'Buku berhasil dihapus', null);
    }
}