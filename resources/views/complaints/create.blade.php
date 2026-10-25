@extends('layouts.app')

@section('title', 'Buat Pengaduan')
@section('content')
    <div class="bg-white rounded shadow p-6 max-w-2xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-1">Buat Pengaduan Baru</h2>
        <p class="text-sm text-gray-500 mb-6">Sampaikan keluhan atau masukan Anda mengenai layanan restoran.</p>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Pengaduan</label>
                    <select name="category" required
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800 bg-white">
                        <option value="" disabled {{ old('category') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                        <option value="Pelayanan" {{ old('category') == 'Pelayanan' ? 'selected' : '' }}>Pelayanan</option>
                        <option value="Makanan/Minuman" {{ old('category') == 'Makanan/Minuman' ? 'selected' : '' }}>Makanan / Minuman</option>
                        <option value="Fasilitas" {{ old('category') == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                        <option value="Kebersihan" {{ old('category') == 'Kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                        <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- No Meja -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Meja</label>
                    <input type="text" name="table_number" value="{{ old('table_number') }}" required
                           placeholder="Contoh: Meja 04"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800">
                </div>

                <!-- Nama Pelanggan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', Auth::user()->name) }}" required
                           placeholder="Nama lengkap"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800">
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                           placeholder="Contoh: 081234567890"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800">
                </div>
            </div>

            <!-- Judul Pengaduan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Pengaduan</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       placeholder="Contoh: Pelayanan lambat saat makan malam"
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800">
            </div>

            <!-- Isi Pengaduan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Pengaduan</label>
                <textarea name="content" rows="5" required
                          placeholder="Jelaskan detail keluhan Anda..."
                          class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800">{{ old('content') }}</textarea>
            </div>

            <!-- Upload File -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti (Opsional)</label>
                <input type="file" name="attachment" accept=".jpg,.jpeg,.png,.pdf"
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-800 focus:border-gray-800 bg-white file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF (Maks 2MB)</p>
            </div>

            <div class="flex gap-2">
                <button type="submit"
                        class="bg-gray-900 text-white px-5 py-2 rounded text-sm hover:bg-black transition">
                    Kirim Pengaduan
                </button>
                <a href="{{ route('complaints.index') }}"
                   class="border border-gray-300 text-gray-700 px-5 py-2 rounded text-sm hover:bg-gray-100 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection