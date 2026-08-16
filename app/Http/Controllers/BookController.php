<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $books = Book::query()
        ->when($search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(5)
        ->withQueryString();

    return view('books.index', compact('books', 'search'));
}
    
    public function create()
{
    return view('books.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => ['required', 'string', 'min:3', 'max:255'],
        'author' => ['required', 'string', 'min:3', 'max:255'],
        'isbn' => ['nullable', 'string', 'max:20', 'unique:books,isbn'],
        'stock' => ['required', 'integer', 'min:0'],
    ]);

    Book::create($validated);

    return redirect()
        ->route('books.index')
        ->with('success', 'Buku berhasil ditambahkan.');
}

public function edit(Book $book)
{
    return view('books.edit', compact('book'));
}

public function update(Request $request, Book $book)
{
    $validated = $request->validate([
        'title' => ['required', 'string', 'min:3', 'max:255'],
        'author' => ['required', 'string', 'min:3', 'max:255'],
        'isbn' => [
            'nullable',
            'string',
            'max:20',
            Rule::unique('books', 'isbn')->ignore($book->id),
        ],
        'stock' => ['required', 'integer', 'min:0'],
    ]);

    $book->update($validated);

    return redirect()
        ->route('books.index')
        ->with('success', 'Data buku berhasil diperbarui.');
}

public function destroy(Book $book)
{
    $book->delete();

    return redirect()
        ->route('books.index')
        ->with('success', 'Buku berhasil dihapus.');
}

}