<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member', 'book'])
            ->latest('loan_date')
            ->paginate(10);

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();

        $books = Book::where('stock', '>', 0)
            ->orderBy('title')
            ->get();

        return view('loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => ['required', 'exists:members,id'],
            'book_id' => ['required', 'exists:books,id'],
            'loan_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:loan_date'],
        ]);

        DB::transaction(function () use ($validated) {
            $book = Book::query()
                ->lockForUpdate()
                ->findOrFail($validated['book_id']);

            if ($book->stock < 1) {
                throw ValidationException::withMessages([
                    'book_id' => 'Stok buku sudah habis.',
                ]);
            }

            $alreadyBorrowed = Loan::query()
                ->where('member_id', $validated['member_id'])
                ->where('book_id', $validated['book_id'])
                ->where('status', 'borrowed')
                ->exists();

            if ($alreadyBorrowed) {
                throw ValidationException::withMessages([
                    'book_id' => 'Anggota masih meminjam buku yang sama.',
                ]);
            }

            Loan::create([
                ...$validated,
                'status' => 'borrowed',
            ]);

            $book->decrement('stock');
        });

        return redirect()
            ->route('loans.index')
            ->with('success', 'Peminjaman berhasil disimpan.');
    }

    public function returnBook(Loan $loan)
{
    $returned = DB::transaction(function () use ($loan) {
        $lockedLoan = Loan::query()
            ->lockForUpdate()
            ->findOrFail($loan->id);

        if ($lockedLoan->status === 'returned') {
            return false;
        }

        $book = Book::query()
            ->lockForUpdate()
            ->findOrFail($lockedLoan->book_id);

        $lockedLoan->update([
            'status' => 'returned',
            'return_date' => today(),
        ]);

        $book->increment('stock');

        return true;
    });

    if (! $returned) {
        return redirect()
            ->route('loans.index')
            ->with('error', 'Buku tersebut sudah dikembalikan.');
    }

    return redirect()
        ->route('loans.index')
        ->with('success', 'Buku berhasil dikembalikan dan stok telah ditambahkan.');
}
}