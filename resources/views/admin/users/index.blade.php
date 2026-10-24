@extends('layouts.app')

@section('title', 'Daftar Pengguna')
@section('content')
<div class="page-heading">
    <div><h1>Daftar User</h1><p>Kelola akun yang terdaftar pada sistem pengaduan</p></div>
    <span class="badge text-bg-light border">{{ $users->total() }} pengguna</span>
</div>

<div class="panel">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th>No</th><th>Nama</th><th>Email</th><th>Role</th><th>Status Email</th><th>Terdaftar</th></tr></thead>
            <tbody>
            @forelse($users as $key => $user)
                <tr>
                    <td>{{ $users->firstItem() + $key }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge-soft {{ $user->role === 'admin' ? 'badge-facility' : 'badge-service' }}">{{ ucfirst($user->role) }}</span></td>
                    <td>{!! $user->email_verified_at ? '<span class="text-success"><i class="bi bi-check-circle me-1"></i>Terverifikasi</span>' : '<span class="text-muted"><i class="bi bi-circle me-1"></i>Belum verifikasi</span>' !!}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Belum ada user terdaftar.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-3 pb-3">{{ $users->links() }}</div>
</div>
@endsection
