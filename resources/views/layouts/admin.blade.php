<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    @include('partials.head')
    <title>@yield('title', 'SPM Command')</title>
</head>
<body class="min-h-screen lg:flex">
    <aside class="border-b border-gold/15 bg-panel p-5 lg:min-h-screen lg:w-64 lg:border-b-0 lg:border-r">
        <div class="font-display text-xl font-extrabold uppercase leading-tight">SPM Command
            <span class="caps block text-[10px] text-gold">Ops &amp; Telemetry</span>
        </div>
        <nav class="mt-8 flex gap-2 overflow-x-auto lg:flex-col">
            @php
                $menu = [
                    ['admin.dashboard', 'Operations Hub', 'admin.dashboard'],
                    ['admin.cars.index', 'Fleet Inventory', 'admin.cars.*'],
                    ['admin.bookings.index', 'VIP Manifest', 'admin.bookings.*'],
                ];
            @endphp
            @foreach ($menu as [$route, $label, $pattern])
                <a href="{{ route($route) }}"
                   class="whitespace-nowrap rounded px-4 py-3 text-sm {{ request()->routeIs($pattern) ? 'bg-gradient-to-b from-champagne to-bronze font-semibold text-void' : 'text-muted hover:bg-carbon' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>
        <div class="mt-8 space-y-3">
            <a href="{{ route('home') }}" class="caps block text-muted hover:text-gold">&larr; Return to public atelier</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="caps text-muted hover:text-gold">Logout</button>
            </form>
        </div>
    </aside>
    <main class="flex-1 p-5 lg:p-10">
        @include('partials.flash')
        @yield('content')
    </main>
</body>
</html>
