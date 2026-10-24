<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pengaduan Baru</title>
</head>
<body>
    <h2>Pengaduan Baru Masuk</h2>
    <p><strong>Nama:</strong> {{ $complaint->name }}</p>
    <p><strong>Email:</strong> {{ $complaint->email }}</p>
    <p><strong>No HP:</strong> {{ $complaint->phone }}</p>
    <p><strong>Kategori:</strong> {{ $complaint->category }}</p>
    <p><strong>Deskripsi:</strong></p>
    <p>{{ $complaint->description }}</p>

    @if ($complaint->attachment)
        <p><strong>Lampiran:</strong> Ada file terunggah ({{ basename($complaint->attachment) }})</p>
    @endif

    <hr>
    <small>Email otomatis dari sistem pengaduan restoran.</small>
</body>
</html>