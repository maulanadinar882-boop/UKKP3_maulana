<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComplaintNotification;

class ComplaintController extends Controller
{
    /**
     * Daftar semua pengaduan.
     */
    public function index()
    {
        $complaints = Complaint::latest()->paginate(10);
        return view('complaints.index', compact('complaints'));
    }

    /**
     * Form tambah pengaduan.
     */
    public function create()
    {
        return view('complaints.create');
    }

    /**
     * Simpan pengaduan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'table_number' => 'required|string|max:10', // <-- TAMBAHKAN INI
            'email'        => 'required|email|max:100',
            'phone'        => 'required|string|max:20',
            'category'     => 'required|string|max:50',
            'description'  => 'required|string',
            'attachment'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Upload file jika ada
        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')
                ->store('attachments', 'public');
        }

        $complaint = Complaint::create($validated);

        // Kirim email notifikasi ke pelapor
        // (hapus/comment jika belum ingin kirim email)
        try {
            Mail::to($complaint->email)->send(new ComplaintNotification($complaint));
        } catch (\Exception $e) {
            // Biarkan pengaduan tetap tersimpan meski email gagal
            \Log::error('Gagal kirim email: ' . $e->getMessage());
        }

        return redirect()->route('complaints.index')
            ->with('success', 'Pengaduan berhasil dikirim.');
    }

    /**
     * Detail satu pengaduan.
     */
    public function show(Complaint $complaint)
    {
        return view('complaints.show', compact('complaint'));
    }

    /**
     * Form edit pengaduan.
     */
    public function edit(Complaint $complaint)
    {
        return view('complaints.edit', compact('complaint'));
    }

    /**
     * Update pengaduan.
     */
    public function update(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'table_number'=> 'required|string|max:10',
            'email'       => 'required|email|max:100',
            'phone'       => 'required|string|max:20',
            'category'    => 'required|string|max:50',
            'description' => 'required|string',
            'attachment'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Jika ada file baru, hapus file lama lalu simpan yang baru
        if ($request->hasFile('attachment')) {
            if ($complaint->attachment && Storage::disk('public')->exists($complaint->attachment)) {
                Storage::disk('public')->delete($complaint->attachment);
            }
            $validated['attachment'] = $request->file('attachment')
                ->store('attachments', 'public');
        }

        $complaint->update($validated);

        return redirect()->route('complaints.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    /**
     * Hapus pengaduan.
     */
    public function destroy(Complaint $complaint)
    {
        // Hapus file lampiran jika ada
        if ($complaint->attachment && Storage::disk('public')->exists($complaint->attachment)) {
            Storage::disk('public')->delete($complaint->attachment);
        }

        $complaint->delete();

        return redirect()->route('complaints.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
