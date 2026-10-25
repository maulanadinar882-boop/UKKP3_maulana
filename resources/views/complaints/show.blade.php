@extends('layouts.app')

@section('title', 'Detail Pengaduan')
@section('content')
    <div class="bg-white rounded shadow p-6 max-w-3xl">
        <a href="{{ route('complaints.index') }}" class="text-sm text-gray-500 hover:underline">&larr; Kembali</a>

        <h2 class="text-xl font-semibold text-gray-900 mt-3 mb-1">{{ $complaint->title }}</h2>
        <p class="text-xs text-gray-500 mb-4">
            Dikirim pada {{ $complaint->created_at->format('d-m-Y H:i') }}
            &middot;
            Status:
            <span class="px-2 py-0.5 rounded text-xs
                {{ $complaint->status === 'pending' ? 'bg-gray-200 text-gray-700' : 'bg-gray-900 text-white' }}">
                {{ strtoupper($complaint->status) }}
            </span>
        </p>

        <div class="border-t border-gray-200 pt-4 text-sm text-gray-700 whitespace-pre-line">
            {{ $complaint->content }}
        </div>
    </div>
@endsection