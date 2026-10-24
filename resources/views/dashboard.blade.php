@extends('layouts.app')

@section('title', $isAdmin ? 'Dashboard Admin' : 'Dashboard Pengguna')
@section('content')
@if($isAdmin)
<div class="page-heading">
    <div><h1>Dashboard Admin</h1><p>Ringkasan pengelolaan seluruh sistem pengaduan</p></div>
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary"><i class="bi bi-people me-2"></i>Kelola User</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3"><div class="panel"><div class="panel-body"><div class="text-muted small mb-2">Total Pengaduan</div><div class="d-flex align-items-center justify-content-between"><h2 class="mb-0">{{ $complaintsCount }}</h2><span class="avatar"><i class="bi bi-chat-square-text"></i></span></div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="panel"><div class="panel-body"><div class="text-muted small mb-2">Hari Ini</div><div class="d-flex align-items-center justify-content-between"><h2 class="mb-0">{{ $todayCount }}</h2><span class="avatar"><i class="bi bi-calendar-check"></i></span></div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="panel"><div class="panel-body"><div class="text-muted small mb-2">7 Hari Terakhir</div><div class="d-flex align-items-center justify-content-between"><h2 class="mb-0">{{ $weekCount }}</h2><span class="avatar"><i class="bi bi-calendar-week"></i></span></div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="panel"><div class="panel-body"><div class="text-muted small mb-2">Total User</div><div class="d-flex align-items-center justify-content-between"><h2 class="mb-0">{{ $userCount }}</h2><span class="avatar"><i class="bi bi-person-lines-fill"></i></span></div></div></div></div>
</div>
@else
<div class="page-heading">
    <div><h1>Halo, {{ Auth::user()->name }}</h1><p>Ringkasan pengaduan yang Anda kirimkan</p></div>
    <a href="{{ route('complaints.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Ajukan Pengaduan</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="panel"><div class="panel-body"><div class="text-muted small mb-2">Pengaduan Saya</div><div class="d-flex align-items-center justify-content-between"><h2 class="mb-0">{{ $complaintsCount }}</h2><span class="avatar"><i class="bi bi-chat-square-text"></i></span></div></div></div></div>
    <div class="col-md-4"><div class="panel"><div class="panel-body"><div class="text-muted small mb-2">Dikirim Hari Ini</div><div class="d-flex align-items-center justify-content-between"><h2 class="mb-0">{{ $todayCount }}</h2><span class="avatar"><i class="bi bi-calendar-check"></i></span></div></div></div></div>
    <div class="col-md-4"><div class="panel"><div class="panel-body"><div class="text-muted small mb-2">7 Hari Terakhir</div><div class="d-flex align-items-center justify-content-between"><h2 class="mb-0">{{ $weekCount }}</h2><span class="avatar"><i class="bi bi-clock-history"></i></span></div></div></div></div>
</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="panel h-100"><div class="panel-body">
            <div class="d-flex justify-content-between align-items-center mb-4"><div><h5 class="mb-1">Aktivitas 7 Hari</h5><p class="text-muted mb-0 small">Jumlah pengaduan per hari</p></div><span class="badge text-bg-light border">{{ $weekCount }} total</span></div>
            @php $maxWeekly = max(collect($weeklyCounts)->max('total') ?? 0, 1); @endphp
            <div class="d-flex align-items-end justify-content-between gap-2" style="height:190px;padding-top:12px">
                @foreach($weeklyCounts as $day)
                    <div class="d-flex flex-column align-items-center justify-content-end flex-fill" style="height:100%">
                        <small class="mb-2 fw-semibold">{{ $day['total'] }}</small>
                        <div class="rounded-top" style="width:min(44px,70%);height:{{ max(($day['total'] / $maxWeekly) * 130, 6) }}px;background:#1d6b52"></div>
                        <small class="text-muted mt-2">{{ $day['label'] }}</small>
                    </div>
                @endforeach
            </div>
        </div></div>
    </div>
    <div class="col-lg-4">
        <div class="panel h-100"><div class="panel-body">
            <h5 class="mb-1">Kategori Pengaduan</h5><p class="text-muted small mb-4">Distribusi seluruh laporan</p>
            @foreach(['Makanan', 'Pelayanan', 'Fasilitas'] as $category)
                @php $total = $categoryCounts[$category] ?? 0; $percentage = $complaintsCount > 0 ? round(($total / $complaintsCount) * 100) : 0; $categoryClass = $category === 'Makanan' ? 'badge-food' : ($category === 'Pelayanan' ? 'badge-service' : 'badge-facility'); @endphp
                <div class="mb-4"><div class="d-flex justify-content-between mb-2"><span class="badge-soft {{ $categoryClass }}">{{ $category }}</span><strong>{{ $total }}</strong></div><div class="progress" style="height:6px"><div class="progress-bar bg-success" style="width:{{ $percentage }}%"></div></div></div>
            @endforeach
        </div></div>
    </div>
</div>

<div class="panel"><div class="d-flex justify-content-between align-items-center px-4 py-3 border-bottom"><div><h5 class="mb-1">{{ $isAdmin ? 'Pengaduan Terbaru' : 'Pengaduan Saya Terbaru' }}</h5><p class="text-muted small mb-0">{{ $isAdmin ? 'Laporan yang paling baru diterima' : 'Laporan terakhir yang Anda kirimkan' }}</p></div><a href="{{ route('complaints.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a></div>
<div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Pelapor</th><th>Meja</th><th>Kategori</th><th>Waktu</th><th class="text-end">Aksi</th></tr></thead><tbody>
@forelse($recentComplaints as $item)
<tr><td><strong>{{ $item->name }}</strong><div class="text-muted small">{{ $item->email }}</div></td><td><span class="badge bg-light text-dark border">Meja {{ $item->table_number }}</span></td><td>{{ $item->category }}</td><td>{{ $item->created_at->diffForHumans() }}</td><td class="text-end"><a href="{{ route('complaints.show', $item->id) }}" class="btn btn-outline-secondary icon-btn" title="Detail"><i class="bi bi-eye"></i></a></td></tr>
@empty<tr><td colspan="5" class="text-center text-muted py-5">Belum ada pengaduan.</td></tr>@endforelse
</tbody></table></div></div>
@endsection