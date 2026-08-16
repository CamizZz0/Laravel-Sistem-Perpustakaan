<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $members = Member::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nim', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('major', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('members.index', compact('members', 'search'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9]+$/',
                'unique:members,nim',
            ],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:members,email'],
            'major' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:1000'],
        ]);

        Member::create($validated);

        return redirect()
            ->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Member $member)
{
    return view('members.edit', compact('member'));
}

public function update(Request $request, Member $member)
{
    $validated = $request->validate([
        'nim' => [
            'required',
            'string',
            'max:20',
            'regex:/^[0-9]+$/',
            Rule::unique('members', 'nim')->ignore($member->id),
        ],
        'name' => ['required', 'string', 'min:3', 'max:255'],
        'email' => [
            'nullable',
            'email',
            'max:255',
            Rule::unique('members', 'email')->ignore($member->id),
        ],
        'major' => ['required', 'string', 'max:255'],
        'phone' => ['nullable', 'string', 'max:20'],
        'address' => ['nullable', 'string', 'max:1000'],
    ]);

    $member->update($validated);

    return redirect()
        ->route('members.index')
        ->with('success', 'Data anggota berhasil diperbarui.');
}

public function destroy(Member $member)
{
    $hasLoanHistory = Loan::where('member_id', $member->id)->exists();

    if ($hasLoanHistory) {
        return redirect()
            ->route('members.index')
            ->with('error', 'Anggota tidak dapat dihapus karena sudah memiliki riwayat peminjaman.');
    }

    $member->delete();

    return redirect()
        ->route('members.index')
        ->with('success', 'Anggota berhasil dihapus.');
}

}