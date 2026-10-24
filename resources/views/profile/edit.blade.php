<x-app-layout>
    @section('title', 'Profil Saya')
    <div class="page-heading"><div><h1>Profil Saya</h1><p>Kelola informasi akun dan keamanan</p></div></div>
    <div class="row g-3">
        <div class="col-lg-8"><div class="panel mb-3"><div class="panel-body">@include('profile.partials.update-profile-information-form')</div></div><div class="panel mb-3"><div class="panel-body">@include('profile.partials.update-password-form')</div></div></div>
        <div class="col-lg-4"><div class="panel border-danger"><div class="panel-body">@include('profile.partials.delete-user-form')</div></div></div>
    </div>
</x-app-layout>
