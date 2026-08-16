<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filters = $this->validateFilters($request);

        $query = Loan::with(['member', 'book'])
            ->latest('loan_date');

        $this->applyFilters($query, $filters);

        $loans = $query->paginate(10)->withQueryString();

        return view('reports.index', compact('loans'));
    }

    public function pdf(Request $request)
    {
        $filters = $this->validateFilters($request);

        $query = Loan::with(['member', 'book'])
            ->latest('loan_date');

        $this->applyFilters($query, $filters);

        $loans = $query->get();

        $pdf = Pdf::loadView('reports.pdf', [
            'loans' => $loans,
            'filters' => $filters,
        ])->setPaper('a4', 'landscape');

        return $pdf->download(
            'laporan-peminjaman-' . now()->format('Y-m-d') . '.pdf'
        );
    }

    private function validateFilters(Request $request): array
    {
        return $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
            'status' => [
                'nullable',
                'in:borrowed,overdue,returned',
            ],
        ]);
    }

    private function applyFilters($query, array $filters): void
    {
        if (! empty($filters['start_date'])) {
            $query->whereDate(
                'loan_date',
                '>=',
                $filters['start_date']
            );
        }

        if (! empty($filters['end_date'])) {
            $query->whereDate(
                'loan_date',
                '<=',
                $filters['end_date']
            );
        }

        if (($filters['status'] ?? null) === 'borrowed') {
            $query->where('status', 'borrowed')
                ->whereDate('due_date', '>=', today());
        }

        if (($filters['status'] ?? null) === 'overdue') {
            $query->where('status', 'borrowed')
                ->whereDate('due_date', '<', today());
        }

        if (($filters['status'] ?? null) === 'returned') {
            $query->where('status', 'returned');
        }
    }
}