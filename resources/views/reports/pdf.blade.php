<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Laporan Peminjaman</title>

    <style>
        body {
            color: #1e293b;
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        h1 {
            margin-bottom: 5px;
            text-align: center;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 20px;
            text-align: center;
        }

        .filters {
            background: #f1f5f9;
            margin-bottom: 20px;
            padding: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background: #2563eb;
            color: white;
            padding: 9px;
            text-align: left;
        }

        td {
            border: 1px solid #cbd5e1;
            padding: 8px;
        }

        tr:nth-child(even) {
            background: #f8fafc;
        }

        .empty {
            color: #64748b;
            padding: 20px;
            text-align: center;
        }

        .footer {
            color: #64748b;
            font-size: 10px;
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <h1>Laporan Peminjaman Buku</h1>

    <p class="subtitle">
        Sistem Informasi Perpustakaan
    </p>

    <div class="filters">
        <strong>Periode:</strong>
        {{ ! empty($filters['start_date'])
            ? \Carbon\Carbon::parse($filters['start_date'])->format('d-m-Y')
            : 'Semua' }}

        sampai

        {{ ! empty($filters['end_date'])
            ? \Carbon\Carbon::parse($filters['end_date'])->format('d-m-Y')
            : 'Semua' }}

        &nbsp; | &nbsp;

        <strong>Status:</strong>

        @if (($filters['status'] ?? null) === 'borrowed')
            Dipinjam
        @elseif (($filters['status'] ?? null) === 'overdue')
            Terlambat
        @elseif (($filters['status'] ?? null) === 'returned')
            Dikembalikan
        @else
            Semua Status
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Anggota</th>
                <th>NIM</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($loans as $loan)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $loan->member->name }}</td>

                    <td>{{ $loan->member->nim }}</td>

                    <td>{{ $loan->book->title }}</td>

                    <td>
                        {{ $loan->loan_date->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $loan->due_date->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $loan->return_date?->format('d-m-Y') ?? '-' }}
                    </td>

                    <td>
                        @if ($loan->status === 'returned')
                            Dikembalikan
                        @elseif ($loan->due_date->lt(today()))
                            Terlambat
                        @else
                            Dipinjam
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty">
                        Data peminjaman tidak ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer">
        Dicetak pada {{ now()->format('d-m-Y H:i') }}
    </p>
</body>
</html>