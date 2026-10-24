@extends('layouts.app')

@section('title', 'Buat Pengaduan')
@section('content')
<div class="page-heading"><div><h1>Buat Pengaduan</h1><p>Lengkapi detail laporan pelanggan</p></div></div>
<div class="panel"><div class="panel-body">
@if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Nama Lengkap</label><input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
<div class="col-md-6"><label class="form-label">No Meja</label><input type="text" name="table_number" class="form-control" value="{{ old('table_number') }}" required></div>
<div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email') }}" required></div>
<div class="col-md-6"><label class="form-label">No HP</label><input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required></div>
<div class="col-md-6"><label class="form-label">Kategori</label><select name="category" class="form-select" required><option value="">Pilih kategori</option><option value="Makanan" {{ old('category') == 'Makanan' ? 'selected' : '' }}>Makanan</option><option value="Pelayanan" {{ old('category') == 'Pelayanan' ? 'selected' : '' }}>Pelayanan</option><option value="Fasilitas" {{ old('category') == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option></select></div>
<div class="col-md-6"><label class="form-label">Lampiran</label><input type="file" name="attachment" class="form-control"><small class="text-muted">JPG, PNG, atau PDF, maksimal 2 MB</small></div>
<div class="col-12"><label class="form-label">Isi Pengaduan</label><textarea name="description" class="form-control" required>{{ old('description') }}</textarea></div>
</div>
<div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('complaints.index') }}" class="btn btn-outline-secondary">Batal</a><button type="submit" class="btn btn-primary"><i class="bi bi-send me-2"></i>Kirim Pengaduan</button></div>
</form>
</div></div>
@endsection