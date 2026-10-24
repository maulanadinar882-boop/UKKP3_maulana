@extends('layouts.app')

@section('title', 'Detail Pengaduan')
@section('content')
<div class="page-heading"><div><h1>Detail Pengaduan</h1><p>Informasi lengkap laporan pelanggan</p></div><a href="{{ route('complaints.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a></div>
<div class="panel"><div class="panel-body">
<div class="row g-4">
<div class="col-md-6"><label class="text-muted small">Nama Lengkap</label><div class="fw-semibold">{{ $complaint->name }}</div></div>
<div class="col-md-6"><label class="text-muted small">No Meja</label><div class="fw-semibold">{{ $complaint->table_number }}</div></div>
<div class="col-md-6"><label class="text-muted small">Email</label><div>{{ $complaint->email }}</div></div>
<div class="col-md-6"><label class="text-muted small">No HP</label><div>{{ $complaint->phone }}</div></div>
<div class="col-md-6"><label class="text-muted small">Kategori</label><div><span class="badge-soft badge-food">{{ $complaint->category }}</span></div></div>
<div class="col-md-6"><label class="text-muted small">Lampiran</label><div>@if($complaint->attachment)<a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-paperclip me-1"></i>Lihat File</a>@else<span class="text-muted">Tidak ada lampiran</span>@endif</div></div>
<div class="col-12"><label class="text-muted small">Isi Pengaduan</label><div class="p-3 bg-light border rounded-2">{{ $complaint->description }}</div></div>
</div>
</div></div>
@endsection