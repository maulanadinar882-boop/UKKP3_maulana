<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pengaduan Restoran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-8">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Daftar Akun</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                <small class="text-gray-500">Minimal 8 karakter</small>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Sudah punya akun?
            <a href="/login" class="text-blue-600 hover:underline">Login di sini</a>
        </p>
    </div>
</body>
</html>