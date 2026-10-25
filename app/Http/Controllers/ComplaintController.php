<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // ==========================================
    // FITUR UNTUK USER
    // ==========================================

    // Daftar pengaduan milik user yang login
    public function index()
    {
        $complaints = Complaint::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('complaints.index', compact('complaints'));
    }

    // Form buat pengaduan
    public function create()
    {
        return view('complaints.create');
    }

    // Simpan pengaduan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => ['required', 'string'],
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'table_number' => ['required', 'string', 'max:10'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        Complaint::create([
            'user_id' => Auth::id(),
            'category' => $validated['category'],
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'table_number' => $validated['table_number'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'attachment' => $attachmentPath,
            'status' => 'pending',
        ]);

        return redirect()->route('complaints.index')
            ->with('success', 'Pengaduan berhasil dikirim.');
    }

    // Detail pengaduan (User)
    public function show(Complaint $complaint)
    {
        // Pastikan user hanya bisa melihat detail pengaduannya sendiri
        if ($complaint->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pengaduan ini.');
        }

        return view('complaints.show', compact('complaint'));
    }

    // ==========================================
    // FITUR UNTUK ADMIN
    // ==========================================

    // Daftar semua pengaduan masuk (Admin)
    public function adminIndex()
    {
        $complaints = Complaint::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.complaints.index', compact('complaints'));
    }

    // Detail pengaduan (Admin)
    public function adminShow(Complaint $complaint)
    {
        return view('admin.complaints.show', compact('complaint'));
    }

    // Ubah status pengaduan (Admin)
    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => ['required', 'in:pending,processing,resolved'],
        ]);

        $complaint->update(['status' => $request->status]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui menjadi ' . strtoupper($request->status));
    }
}