@extends('layouts.app')

@section('title', 'Riwayat Pengaduan')
@section('content')

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-5">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Riwayat Pengaduan</h2>
                <p class="text-sm text-gray-500">Daftar pengaduan yang pernah Anda kirim.</p>
            </div>
            <a href="{{ route('complaints.create') }}"
               class="bg-gray-900 text-white px-4 py-2 rounded text-sm hover:bg-black transition">
                + Buat Pengaduan
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700">
                        <th class="px-3 py-2 border">No</th>
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
                            <td class="px-3 py-2 border font-medium">{{ $c->title }}</td>
                            <td class="px-3 py-2 border">
                                @php
                                    $badge = match ($c->status) {
                                        'pending' => 'bg-gray-200 text-gray-700',
                                        'processing' => 'bg-gray-700 text-white',
                                        'resolved' => 'bg-gray-900 text-white',
                                        default => 'bg-gray-200 text-gray-700',
                                    };
                                @endphp
                                <span class="px-2 py-0.5 rounded text-xs {{ $badge }}">
                                    {{ strtoupper($c->status) }}
                                </span>
                            </td>
                            <td class="px-3 py-2 border">{{ $c->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-3 py-2 border text-center">
                                <a href="{{ route('complaints.show', $c) }}"
                                   class="text-gray-800 hover:underline text-xs">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-6 border text-center text-gray-500">
                                Belum ada pengaduan. Klik tombol <b>Buat Pengaduan</b> untuk mulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection