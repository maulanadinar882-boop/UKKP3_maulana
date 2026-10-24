<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    $isAdmin = request()->user()->role === 'admin';
    $complaintQuery = $isAdmin
        ? \App\Models\Complaint::query()
        : \App\Models\Complaint::where('email', request()->user()->email);

    $complaintsCount = (clone $complaintQuery)->count();
    $todayCount = (clone $complaintQuery)->whereDate('created_at', today())->count();
    $weekCount = (clone $complaintQuery)->where('created_at', '>=', now()->subDays(7))->count();
    $categoryCounts = (clone $complaintQuery)->selectRaw('category, COUNT(*) as total')
        ->groupBy('category')
        ->pluck('total', 'category');
    $recentComplaints = (clone $complaintQuery)->latest()->take(5)->get();

    $weeklyCounts = collect(range(6, 0))->map(function ($daysAgo) use ($complaintQuery) {
        $date = today()->subDays($daysAgo);

        return [
            'label' => $date->translatedFormat('D'),
            'total' => (clone $complaintQuery)->whereDate('created_at', $date)->count(),
        ];
    });

    $userCount = $isAdmin ? \App\Models\User::count() : null;

    return view('dashboard', compact(
        'isAdmin',
        'complaintsCount',
        'todayCount',
        'weekCount',
        'categoryCounts',
        'recentComplaints',
        'weeklyCounts',
        'userCount'
    ));
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', function () {
        $users = \App\Models\User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    })->name('admin.users.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('complaints', ComplaintController::class);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';