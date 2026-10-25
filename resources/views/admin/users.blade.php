@extends('layouts.app')

@section('title', 'Manajemen User')
@section('content')
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Daftar User</h2>
        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-3 py-2 border">No</th>
                    <th class="px-3 py-2 border">Nama</th>
                    <th class="px-3 py-2 border">Email</th>
                    <th class="px-3 py-2 border">Role</th>
                    <th class="px-3 py-2 border">Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $i => $u)
                    <tr>
                        <td class="px-3 py-2 border">{{ $i + 1 }}</td>
                        <td class="px-3 py-2 border">{{ $u->name }}</td>
                        <td class="px-3 py-2 border">{{ $u->email }}</td>
                        <td class="px-3 py-2 border">
                            <span class="px-2 py-0.5 rounded text-xs
                                {{ $u->role === 'admin' ? 'bg-yellow-500 text-black' : 'bg-blue-500 text-white' }}">
                                {{ strtoupper($u->role) }}
                            </span>
                        </td>
                        <td class="px-3 py-2 border">{{ $u->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection