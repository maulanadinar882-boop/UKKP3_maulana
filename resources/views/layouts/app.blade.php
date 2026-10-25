<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan Restoran')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-gray-300 flex flex-col min-h-screen border-r border-gray-800">
        <div class="px-5 py-5 text-lg font-semibold text-white border-b border-gray-800 tracking-wide">
            Pengaduan Resto
        </div>

        <nav class="flex-1 py-4 space-y-1 text-sm">
            @if (Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-5 py-2.5 border-l-2 transition
                          {{ request()->routeIs('admin.dashboard')
                              ? 'bg-gray-800 text-white border-white'
                              : 'border-transparent hover:bg-gray-800 hover:text-white' }}">
                    Dashboard Admin
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="block px-5 py-2.5 border-l-2 transition
                          {{ request()->routeIs('admin.users.*')
                              ? 'bg-gray-800 text-white border-white'
                              : 'border-transparent hover:bg-gray-800 hover:text-white' }}">
                    Kelola User
                </a>
                                <a href="{{ route('admin.complaints.index') }}"
                   class="block px-5 py-2.5 border-l-2 transition
                          {{ request()->routeIs('admin.complaints.*')
                              ? 'bg-gray-800 text-white border-white'
                              : 'border-transparent hover:bg-gray-800 hover:text-white' }}">
                    Pengaduan Masuk
                </a>
            @else
                <a href="{{ route('dashboard') }}"
                   class="block px-5 py-2.5 border-l-2 transition
                          {{ request()->routeIs('dashboard')
                              ? 'bg-gray-800 text-white border-white'
                              : 'border-transparent hover:bg-gray-800 hover:text-white' }}">
                    Dashboard
                </a>
                <a href="{{ route('complaints.create') }}"
                   class="block px-5 py-2.5 border-l-2 transition
                          {{ request()->routeIs('complaints.create')
                              ? 'bg-gray-800 text-white border-white'
                              : 'border-transparent hover:bg-gray-800 hover:text-white' }}">
                    Buat Pengaduan
                </a>
                <a href="{{ route('complaints.index') }}"
                   class="block px-5 py-2.5 border-l-2 transition
                          {{ request()->routeIs('complaints.index', 'complaints.show')
                              ? 'bg-gray-800 text-white border-white'
                              : 'border-transparent hover:bg-gray-800 hover:text-white' }}">
                    Riwayat Pengaduan
                </a>
            @endif
        </nav>

        <div class="px-5 py-4 border-t border-gray-800 text-sm">
            <p class="font-medium text-white truncate">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-500 truncate mb-3">{{ Auth::user()->email }}</p>
            <span class="inline-block text-[10px] tracking-widest px-2 py-0.5 rounded
                {{ Auth::user()->isAdmin()
                    ? 'bg-white text-gray-900'
                    : 'bg-gray-700 text-gray-200' }}">
                {{ Auth::user()->isAdmin() ? 'ADMIN' : 'USER' }}
            </span>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full text-left text-gray-400 hover:text-white text-sm transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
        </header>
        <main class="p-6 flex-1">
            @yield('content')
        </main>
    </div>

</body>
</html>