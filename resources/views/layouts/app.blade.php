<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Pengaduan Restoran')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --sidebar-width: 256px; --ink: #172033; --muted: #667085; --line: #e7eaf0; --brand: #1d6b52; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'DM Sans', sans-serif; background: #f4f6f8; color: var(--ink); }
        .sidebar { position: fixed; inset: 0 auto 0 0; width: var(--sidebar-width); z-index: 1040; display: flex; flex-direction: column; background: #18251f; color: #fff; transition: transform .2s ease; }
        .brand { height: 76px; display: flex; align-items: center; gap: 11px; padding: 0 22px; border-bottom: 1px solid rgba(255,255,255,.08); color: #fff; text-decoration: none; }
        .brand-mark { width: 38px; height: 38px; display: grid; place-items: center; border-radius: 8px; background: #d9e8df; color: #1d6b52; font-size: 20px; }
        .brand strong { font-size: 16px; }
        .side-menu { padding: 18px 12px; }
        .side-label { padding: 8px 12px 6px; color: #91a298; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .side-link { display: flex; align-items: center; gap: 12px; height: 44px; margin: 3px 0; padding: 0 12px; border-radius: 7px; color: #bac7c0; text-decoration: none; font-weight: 600; }
        .side-link i { width: 20px; font-size: 18px; }
        .side-link:hover, .side-link.active { background: rgba(255,255,255,.09); color: #fff; }
        .side-link.active { box-shadow: inset 3px 0 0 #7ec5a5; }
        .side-footer { margin-top: auto; padding: 12px; border-top: 1px solid rgba(255,255,255,.08); }
        .user-block { display: flex; align-items: center; gap: 10px; padding: 10px 8px; margin-bottom: 4px; }
        .avatar { width: 36px; height: 36px; flex: 0 0 36px; border-radius: 50%; display: grid; place-items: center; background: #d9e8df; color: var(--brand); font-weight: 700; }
        .user-block strong, .user-block small { display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .main-shell { margin-left: var(--sidebar-width); min-height: 100vh; }
        .topbar { height: 76px; display: flex; align-items: center; justify-content: space-between; padding: 0 32px; background: #fff; border-bottom: 1px solid var(--line); }
        .mobile-toggle { display: none; border: 0; background: transparent; color: var(--ink); font-size: 22px; }
        .topbar-title { font-size: 14px; color: var(--muted); }
        .content-area { padding: 28px 32px 48px; }
        .page-heading { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
        .page-heading h1 { margin: 0; font-size: 28px; line-height: 1.2; font-weight: 700; }
        .page-heading p { margin: 5px 0 0; color: var(--muted); font-size: 14px; }
        .panel { background: #fff; border: 1px solid var(--line); border-radius: 8px; }
        .panel-body { padding: 24px; }
        .btn { border-radius: 7px; font-weight: 600; }
        .btn-primary { border-color: var(--brand); background: var(--brand); }
        .btn-primary:hover, .btn-primary:focus { border-color: #15533f; background: #15533f; }
        .btn-outline-secondary { border-color: var(--line); color: #44505e; }
        .form-control, .form-select { min-height: 44px; border-color: var(--line); border-radius: 7px; }
        textarea.form-control { min-height: 120px; }
        .form-control:focus, .form-select:focus { border-color: #7da998; box-shadow: 0 0 0 3px rgba(29,107,82,.1); }
        .form-label { margin-bottom: 7px; font-size: 13px; font-weight: 700; }
        .table { margin-bottom: 0; border-color: var(--line); }
        .table thead th { padding: 13px 14px; background: #f7f8fa; color: #667085; font-size: 12px; text-transform: uppercase; border-bottom: 1px solid var(--line); }
        .table tbody td { padding: 15px 14px; color: #3f4b5b; vertical-align: middle; border-color: #eef0f3; }
        .table tbody tr:hover { background: #fafbfb; }
        .badge-soft { padding: 7px 9px; border-radius: 6px; font-weight: 600; }
        .badge-food { background: #edf7f2; color: #287054; }
        .badge-service { background: #edf4fb; color: #356c99; }
        .badge-facility { background: #fff4e6; color: #9a641d; }
        .icon-btn { width: 34px; height: 34px; display: inline-grid; place-items: center; padding: 0; border-radius: 6px; }
        .alert { border-radius: 7px; }
        .sidebar-backdrop { display: none; }
        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-shell { margin-left: 0; }
            .topbar { padding: 0 20px; }
            .mobile-toggle { display: inline-grid; place-items: center; }
            .content-area { padding: 22px 20px 40px; }
            .sidebar-backdrop { position: fixed; inset: 0; z-index: 1039; background: rgba(10,18,14,.42); }
            .sidebar-backdrop.show { display: block; }
        }
        @media (max-width: 575.98px) { .page-heading { align-items:flex-start; } .page-heading h1 { font-size:24px; } .content-area { padding-inline:14px; } .panel-body { padding:18px; } }
    </style>
</head>
<body>
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>
<aside class="sidebar" id="sidebar">
    <a href="{{ route('dashboard') }}" class="brand">
        <span class="brand-mark"><i class="bi bi-shop"></i></span>
        <strong>Sistem Pengaduan</strong>
    </a>
    <nav class="side-menu flex-grow-1">
        <div class="side-label">Menu Utama</div>
        <a href="{{ route('dashboard') }}" class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-grid"></i><span>Dashboard</span></a>
        <a href="{{ route('complaints.index') }}" class="side-link {{ request()->routeIs('complaints.*') ? 'active' : '' }}"><i class="bi bi-chat-square-text"></i><span>Pengaduan</span></a>
        <a href="{{ route('complaints.create') }}" class="side-link {{ request()->routeIs('complaints.create') ? 'active' : '' }}"><i class="bi bi-plus-square"></i><span>Buat Pengaduan</span></a>
        @if(Auth::user()->role === 'admin')
        <div class="side-label mt-3">Administrasi</div>
        <a href="{{ route('admin.users.index') }}" class="side-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="bi bi-people"></i><span>Daftar User</span></a>
        @endif
        <div class="side-label mt-3">Akun</div>
        <a href="{{ route('profile.edit') }}" class="side-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"><i class="bi bi-person"></i><span>Profil Saya</span></a>
    </nav>
    <div class="side-footer">
        <div class="user-block">
            <span class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</span>
            <div><strong>{{ Auth::user()->name ?? 'Pengguna' }}</strong><small class="text-white-50">{{ Auth::user()->email ?? '' }}</small></div>
        </div>
        <form method="POST" action="{{ route('logout') }}">@csrf<button class="side-link w-100 border-0 bg-transparent" type="submit"><i class="bi bi-box-arrow-right"></i><span>Keluar</span></button></form>
    </div>
</aside>
<div class="main-shell">
    <header class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="mobile-toggle" id="mobileToggle" type="button" aria-label="Buka menu"><i class="bi bi-list"></i></button>
            <span class="topbar-title">Panel Pengelolaan</span>
        </div>
        <span class="badge text-bg-light border"><i class="bi bi-circle-fill text-success me-2" style="font-size:7px"></i>Sistem Aktif</span>
    </header>
    <main class="content-area">
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot ?? '' }}
        @endif
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    document.getElementById('mobileToggle')?.addEventListener('click', () => { sidebar.classList.add('open'); backdrop.classList.add('show'); });
    backdrop.addEventListener('click', () => { sidebar.classList.remove('open'); backdrop.classList.remove('show'); });
</script>
</body>
</html>