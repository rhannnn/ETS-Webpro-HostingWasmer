@extends('layouts.app')
@section('title', 'Login | Surabaya Prestige Motors')
@section('content')
<div class="mx-auto max-w-md px-5 py-16">
    <div class="card p-8">
        <div class="caps text-gold">Private Access</div>
        <h1 class="mt-2 font-display text-3xl font-extrabold uppercase">Login</h1>
        <div class="mt-6">@include('partials.flash')</div>
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="field" required autofocus>
            </div>
            <div>
                <label class="label">Password</label>
                <input type="password" name="password" class="field" required>
            </div>
            <label class="flex items-center gap-2 text-sm text-muted">
                <input type="checkbox" name="remember" class="accent-yellow-500"> Remember me
            </label>
            <button class="btn-gold w-full">Login</button>
        </form>
        <p class="mt-6 text-sm text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-gold">Register</a></p>
    </div>
</div>
@endsection
