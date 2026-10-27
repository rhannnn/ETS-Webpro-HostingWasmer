@extends('layouts.app')
@section('title', 'Register | Surabaya Prestige Motors')
@section('content')
<div class="mx-auto max-w-md px-5 py-16">
    <div class="card p-8">
        <div class="caps text-gold">New Member</div>
        <h1 class="mt-2 font-display text-3xl font-extrabold uppercase">Register</h1>
        <div class="mt-6">@include('partials.flash')</div>
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <div>
                <label class="label">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="field" required>
            </div>
            <div>
                <label class="label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="field" required>
            </div>
            <div>
                <label class="label">Password</label>
                <input type="password" name="password" class="field" required>
            </div>
            <div>
                <label class="label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="field" required>
            </div>
            <button class="btn-gold w-full">Create Account</button>
        </form>
        <p class="mt-6 text-sm text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-gold">Login</a></p>
    </div>
</div>
@endsection
