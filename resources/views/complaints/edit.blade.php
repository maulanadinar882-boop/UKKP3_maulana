@extends('layouts.app')

@section('title', 'Edit Pengaduan')
@section('content')
<div class="page-heading"><div><h1>Edit Pengaduan</h1><p>Perbarui data laporan pelanggan</p></div></div>
<div class="panel"><div class="panel-body">
@if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form action="{{ route('complaints.update', $complaint->id) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Nama Lengkap</label><input type="text" name="name" class="form-control" value="{{ old('name', $complaint->name) }}" required></div>
<div class="col-md-6"><label class="form-label">No Meja</label><input type="text" name="table_number" class="form-control" value="{{ old('table_number', $complaint->table_number) }}" required></div>
<div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $complaint->email) }}" required></div>
<div class="col-md-6"><label class="form-label">No HP</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $complaint->phone) }}" required></div>
<div class="col-md-6"><label class="form-label">Kategori</label><select name="category" class="form-select" required><option value="Makanan" {{ old('category', $complaint->category) == 'Makanan' ? 'selected' : '' }}>Makanan</option><option value="Pelayanan" {{ old('category', $complaint->category) == 'Pelayanan' ? 'selected' : '' }}>Pelayanan</option><option value="Fasilitas" {{ old('category', $complaint->category) == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option></select></div>
<div class="col-md-6"><label class="form-label">Lampiran Baru</label><input type="file" name="attachment" class="form-control">@if($complaint->attachment)<small class="text-muted">Saat ini: {{ basename($complaint->attachment) }}</small>@endif</div>
<div class="col-12"><label class="form-label">Isi Pengaduan</label><textarea name="description" class="form-control" required>{{ old('description', $complaint->description) }}</textarea></div>
</div>
<div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('complaints.index') }}" class="btn btn-outline-secondary">Batal</a><button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-2"></i>Perbarui Pengaduan</button></div>
</form>
</div></div>
@endsection