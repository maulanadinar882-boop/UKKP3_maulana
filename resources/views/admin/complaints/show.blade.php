@extends('layouts.app')

@section('title', 'Detail Pengaduan Masuk')
@section('content')
    <div class="max-w-4xl">

        <a href="{{ route('admin.complaints.index') }}" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Daftar</a>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mt-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded shadow p-6 mt-3">
            
            <!-- Header -->
            <div class="flex justify-between items-start border-b border-gray-200 pb-4 mb-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $complaint->title }}</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Dikirim pada {{ $complaint->created_at->format('d-m-Y H:i') }}
                    </p>
                </div>
                
                <!-- Form Ubah Status -->
                <form method="POST" action="{{ route('admin.complaints.updateStatus', $complaint) }}" class="flex items-center gap-2">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()"
                            class="border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-gray-800 font-semibold
                            {{ $complaint->status === 'pending' ? 'bg-gray-100' : ($complaint->status === 'processing' ? 'bg-blue-50 text-blue-800' : 'bg-green-50 text-green-800') }}">
                        <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>PENDING</option>
                        <option value="processing" {{ $complaint->status === 'processing' ? 'selected' : '' }}>PROCESSING</option>
                        <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>RESOLVED</option>
                    </select>
                </form>
            </div>

            <!-- Info Pelanggan -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 bg-gray-50 p-4 rounded text-sm border border-gray-100">
                <div>
                    <p class="text-gray-500 text-xs mb-1">Kategori</p>
                    <p class="font-medium">{{ $complaint->category }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs mb-1">Nama Pelanggan</p>
                    <p class="font-medium">{{ $complaint->customer_name }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs mb-1">No. HP</p>
                    <p class="font-medium">{{ $complaint->phone }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs mb-1">Nomor Meja</p>
                    <p class="font-medium">{{ $complaint->table_number }}</p>
                </div>
            </div>

            <!-- Isi Pengaduan -->
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-800 mb-2">Isi Pengaduan:</h3>
                <div class="text-sm text-gray-700 whitespace-pre-line bg-white border border-gray-200 p-4 rounded">
                    {{ $complaint->content }}
                </div>
            </div>

            <!-- Lampiran File -->
            @if ($complaint->attachment)
                <div>
                    <h3 class="text-sm font-semibold text-gray-800 mb-2">Bukti Lampiran:</h3>
                    @php
                        $ext = pathinfo($complaint->attachment, PATHINFO_EXTENSION);
                    @endphp
                    
                    @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $complaint->attachment) }}" alt="Bukti Pengaduan" class="max-w-xs rounded border border-gray-200 shadow-sm">
                    @else
                        <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank" 
                           class="inline-block bg-gray-100 text-gray-800 px-4 py-2 rounded text-sm border border-gray-300 hover:bg-gray-200">
                            Lihat Lampiran ({{ strtoupper($ext) }})
                        </a>
                    @endif
                </div>
            @endif

        </div>
    </div>
@endsection