<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Daftar semua user
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    // Update data user (Nama & Email)
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return back()->with('success', "Data user {$user->name} berhasil diperbarui.");
    }

    // Ubah role user (user <-> admin)
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'in:user,admin'],
        ]);

        // Cegah admin mengubah role dirinya sendiri (agar tidak terkunci)
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat mengubah role akun sendiri.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', "Role {$user->name} berhasil diubah menjadi {$request->role}.");
    }

    // Hapus user
    public function destroy(User $user)
    {
        // Cegah admin menghapus dirinya sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', "User {$user->name} berhasil dihapus.");
    }
}   