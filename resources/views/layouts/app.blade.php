<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    @include('partials.head')
    <title>@yield('title', 'Surabaya Prestige Motors')</title>
</head>
<body class="min-h-screen flex flex-col">
    <header class="sticky top-0 z-40 border-b border-gold/15 bg-void/85 backdrop-blur-xl">
        <div class="mx-auto flex max-w-[1440px] items-center justify-between px-5 py-4 lg:px-12">
            <a href="{{ route('home') }}" class="font-display text-lg font-extrabold uppercase leading-tight tracking-tight">
                Surabaya Prestige
                <span class="caps block text-[10px] text-gold">Motorsport &amp; Luxury</span>
            </a>
            <nav class="hidden items-center gap-8 font-mono text-xs uppercase tracking-widest md:flex">
                <a href="{{ route('home') }}" class="hover:text-gold">Home</a>
                <a href="{{ route('fleet.index') }}" class="hover:text-gold">Fleet</a>
                <a href="{{ route('testimonials.index') }}" class="hover:text-gold">Testimonials</a>
                @auth
                    <a href="{{ route('bookings.index') }}" class="hover:text-gold">My Bookings</a>
                @endauth
            </nav>
            <div class="flex items-center gap-3">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-dark !px-4 !py-2 text-xs">Ops Console</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn-gold !px-4 !py-2 text-xs">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-dark !px-4 !py-2 text-xs">Login</a>
                    <a href="{{ route('register') }}" class="btn-gold !px-4 !py-2 text-xs">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-gold/15 bg-panel">
        <div class="mx-auto grid max-w-[1440px] gap-8 px-5 py-12 lg:grid-cols-3 lg:px-12">
            <div>
                <div class="font-display text-lg font-extrabold uppercase">Surabaya Prestige</div>
                <p class="mt-3 text-sm text-muted">High-performance automotive hire and bespoke track curation across Surabaya and East Java.</p>
            </div>
            <div>
                <div class="caps text-gold">Headquarters</div>
                <p class="mt-3 text-sm text-muted">Jl. Mayjen Sungkono No. 188<br>Surabaya Barat, Jawa Timur 60225</p>
            </div>
            <div>
                <div class="caps text-gold">Operational Hours</div>
                <p class="mt-3 font-mono text-sm text-muted">Concierge Desk: 24/7/365</p>
            </div>
        </div>
        <div class="border-t border-white/5 py-4 text-center font-mono text-[11px] uppercase tracking-widest text-muted">
            &copy; {{ date('Y') }} Surabaya Prestige Motors
        </div>
    </footer>
</body>
</html>
