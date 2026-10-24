@extends('layouts.app')

@section('title', 'Data Pengaduan')
@section('content')
<div class="page-heading"><div><h1>Data Pengaduan</h1><p>Kelola seluruh laporan dari pelanggan</p></div><a href="{{ route('complaints.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Buat Pengaduan</a></div>
@if(session('success'))<div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>@endif
<div class="panel"><div class="table-responsive">
<table class="table align-middle">
<thead><tr><th>No</th><th>Pelapor</th><th>No Meja</th><th>Kategori</th><th>Email</th><th>No HP</th><th class="text-center">Lampiran</th><th class="text-end">Aksi</th></tr></thead>
<tbody>
@forelse($complaints as $key => $item)
<tr><td>{{ $complaints->firstItem() + $key }}</td><td><strong>{{ $item->name }}</strong></td><td><span class="badge bg-light text-dark border">Meja {{ $item->table_number }}</span></td><td>@php $categoryClass = $item->category === 'Makanan' ? 'badge-food' : ($item->category === 'Pelayanan' ? 'badge-service' : 'badge-facility'); @endphp<span class="badge-soft {{ $categoryClass }}">{{ $item->category }}</span></td><td>{{ $item->email }}</td><td>{{ $item->phone }}</td><td class="text-center">@if($item->attachment)@php $ext = strtolower(pathinfo($item->attachment, PATHINFO_EXTENSION)); @endphp@if(in_array($ext, ['jpg','jpeg','png']))<a href="{{ asset('storage/' . $item->attachment) }}" target="_blank"><img src="{{ asset('storage/' . $item->attachment) }}" alt="Bukti" style="width:48px;height:48px;border-radius:6px;object-fit:cover"></a>@else<a href="{{ asset('storage/' . $item->attachment) }}" target="_blank" class="text-danger"><i class="bi bi-file-earmark-pdf fs-4"></i></a>@endif@else<span class="text-muted">-</span>@endif</td><td class="text-end"><a href="{{ route('complaints.show', $item->id) }}" class="btn btn-outline-secondary icon-btn" title="Detail"><i class="bi bi-eye"></i></a><a href="{{ route('complaints.edit', $item->id) }}" class="btn btn-outline-secondary icon-btn ms-1" title="Edit"><i class="bi bi-pencil"></i></a><form action="{{ route('complaints.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">@csrf @method('DELETE')<button class="btn btn-outline-danger icon-btn ms-1" title="Hapus"><i class="bi bi-trash"></i></button></form></td></tr>
@empty<tr><td colspan="8" class="text-center text-muted py-5">Belum ada data pengaduan.</td></tr>@endforelse
</tbody></table>
</div><div class="px-3 pb-3">{{ $complaints->links() }}</div></div>
@endsection