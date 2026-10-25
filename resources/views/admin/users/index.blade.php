@extends('layouts.app')

@section('title', 'Kelola User')
@section('content')

    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Daftar User Terdaftar</h2>
            <span class="text-sm text-gray-500">Total: {{ $users->count() }} user</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700">
                        <th class="px-3 py-2 border">No</th>
                        <th class="px-3 py-2 border">Nama</th>
                        <th class="px-3 py-2 border">Email</th>
                        <th class="px-3 py-2 border">Role</th>
                        <th class="px-3 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $i => $u)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2 border">{{ $i + 1 }}</td>
                            <td class="px-3 py-2 border font-medium">{{ $u->name }}</td>
                            <td class="px-3 py-2 border">{{ $u->email }}</td>
                            <td class="px-3 py-2 border">
                                @if ($u->id === Auth::id())
                                    <span class="px-2 py-0.5 rounded text-xs bg-gray-800 text-white">
                                        ADMIN (Anda)
                                    </span>
                                @else
                                    <form method="POST" action="{{ route('admin.users.updateRole', $u) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" onchange="this.form.submit()"
                                                class="text-xs border rounded px-2 py-1 bg-white focus:outline-none focus:ring-1 focus:ring-gray-800">
                                            <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>USER</option>
                                            <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>ADMIN</option>
                                        </select>
                                    </form>
                                @endif
                            </td>
                            <td class="px-3 py-2 border text-center">
                                @if ($u->id === Auth::id())
                                    <span class="text-gray-400 text-xs italic">-</span>
                                @else
                                    <div class="flex gap-3 items-center justify-center">
                                        {{-- Tombol Edit pakai data-attribute --}}
                                        <button type="button" 
                                                data-id="{{ $u->id }}"
                                                data-name="{{ $u->name }}"
                                                data-email="{{ $u->email }}"
                                                class="btn-edit text-blue-600 hover:underline text-xs font-medium">
                                            Edit
                                        </button>

                                        {{-- Tombol Hapus --}}
                                        <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-xs font-medium">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-4 border text-center text-gray-500">
                                Belum ada user terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL EDIT USER -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded shadow-lg w-96 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Data User</h3>
            
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" id="editName" required
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-800">
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="editEmail" required
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-800">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" id="btnCancelEdit"
                            class="px-4 py-2 border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-100">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-gray-900 text-white rounded text-sm hover:bg-black">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const inputName = document.getElementById('editName');
            const inputEmail = document.getElementById('editEmail');
            const btnCancel = document.getElementById('btnCancelEdit');

            // Event listener untuk semua tombol edit
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const email = this.getAttribute('data-email');

                    // Set action form ke URL update
                    form.action = '/admin/users/' + id;
                    
                    // Isi value input
                    inputName.value = name;
                    inputEmail.value = email;
                    
                    // Tampilkan modal
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });

            // Event listener tombol batal
            btnCancel.addEventListener('click', function () {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        });
    </script>
@endsection