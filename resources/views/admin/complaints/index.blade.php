@extends('layouts.app')

@section('title', 'Pengaduan Masuk')
@section('content')

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-5">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Daftar Pengaduan Masuk</h2>
                <p class="text-sm text-gray-500">Semua keluhan dari pelanggan terkumpul di sini.</p>
            </div>
            <span class="text-sm text-gray-500">Total: {{ $complaints->count() }} pengaduan</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700">
                        <th class="px-3 py-2 border">No</th>
                        <th class="px-3 py-2 border">Pelanggan</th>
                        <th class="px-3 py-2 border">Kategori</th>
                        <th class="px-3 py-2 border">Judul</th>
                        <th class="px-3 py-2 border">Status</th>
                        <th class="px-3 py-2 border">Tanggal</th>
                        <th class="px-3 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($complaints as $i => $c)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2 border">{{ $i + 1 }}</td>
                            <td class="px-3 py-2 border">
                                <div class="font-medium">{{ $c->customer_name }}</div>
                                <div class="text-xs text-gray-500">{{ $c->table_number }}</div>
                            </td>
                            <td class="px-3 py-2 border">{{ $c->category }}</td>
                            <td class="px-3 py-2 border font-medium">{{ $c->title }}</td>
                            <td class="px-3 py-2 border">
                                @php
                                    $badge = match ($c->status) {
                                        'pending' => 'bg-gray-200 text-gray-700',
                                        'processing' => 'bg-blue-100 text-blue-800',
                                        'resolved' => 'bg-green-100 text-green-800',
                                        default => 'bg-gray-200 text-gray-700',
                                    };
                                @endphp
                                <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $badge }}">
                                    {{ strtoupper($c->status) }}
                                </span>
                            </td>
                            <td class="px-3 py-2 border">{{ $c->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-3 py-2 border text-center">
                                <a href="{{ route('admin.complaints.show', $c) }}"
                                   class="text-gray-800 hover:underline text-xs">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-6 border text-center text-gray-500">
                                Belum ada pengaduan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection