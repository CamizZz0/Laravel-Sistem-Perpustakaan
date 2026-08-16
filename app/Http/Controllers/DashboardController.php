<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalStock = Book::sum('stock');
        $totalMembers = Member::count();

        $activeLoans = Loan::where('status', 'borrowed')->count();

        $overdueLoans = Loan::where('status', 'borrowed')
            ->whereDate('due_date', '<', today())
            ->count();

        $outOfStockBooks = Book::where('stock', 0)->count();

        $recentLoans = Loan::with(['member', 'book'])
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact(
            'totalBooks',
            'totalStock',
            'totalMembers',
            'activeLoans',
            'overdueLoans',
            'outOfStockBooks',
            'recentLoans',
        ));
    }
}