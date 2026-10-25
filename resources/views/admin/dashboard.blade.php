@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('content')
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-2xl font-semibold mb-2">Panel Admin</h2>
        <p class="text-gray-600">Selamat datang di panel administrator sistem pengaduan.</p>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 p-4 rounded border border-blue-200">
                <h3 class="font-bold text-blue-800">Total User</h3>
                <p class="text-2xl">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded border border-yellow-200">
                <h3 class="font-bold text-yellow-800">Total Admin</h3>
                <p class="text-2xl">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded border border-green-200">
                <h3 class="font-bold text-green-800">Total User Biasa</h3>
                <p class="text-2xl">{{ \App\Models\User::where('role', 'user')->count() }}</p>
            </div>
        </div>
    </div>
@endsection