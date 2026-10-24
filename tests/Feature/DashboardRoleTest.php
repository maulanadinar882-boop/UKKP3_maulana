<?php

use App\Models\User;

it('menampilkan dashboard khusus admin', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('Dashboard Admin')
        ->assertSee('Total User');
});

it('menampilkan dashboard khusus user', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('Pengaduan Saya')
        ->assertSee('Ajukan Pengaduan');
});
