@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-2xl font-semibold mb-4">Selamat Datang, {{ Auth::user()->name }}</h2>
        <p class="text-gray-600">Ini adalah halaman dashboard pengaduan restoran.</p>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 p-4 rounded border border-blue-200">
                <h3 class="font-bold text-blue-800">Total Pengaduan</h3>
                <p class="text-2xl">0</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded border border-yellow-200">
                <h3 class="font-bold text-yellow-800">Diproses</h3>
                <p class="text-2xl">0</p>
            </div>
            <div class="bg-green-50 p-4 rounded border border-green-200">
                <h3 class="font-bold text-green-800">Selesai</h3>
                <p class="text-2xl">0</p>
            </div>
        </div>
    </div>
@endsection