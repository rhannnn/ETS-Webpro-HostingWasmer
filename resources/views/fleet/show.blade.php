@extends('layouts.app')
@section('title', $car->name . ' | Surabaya Prestige Motors')
@section('content')
<div class="mx-auto grid max-w-[1440px] gap-10 px-5 py-12 lg:grid-cols-2 lg:px-12">
    <div class="card overflow-hidden">
        <img src="{{ $car->image_url }}" alt="{{ $car->name }}" class="w-full object-cover">
    </div>
    <div>
        @include('partials.flash')
        <div class="caps text-bronze">{{ $car->brand }} // {{ $car->category }}</div>
        <h1 class="mt-2 font-display text-5xl font-extrabold uppercase leading-tight">{{ $car->name }}</h1>
        <div class="mt-6 overflow-hidden rounded border border-white/5">
            <div class="flex justify-between bg-carbon/30 px-4 py-3 font-mono text-sm"><span class="text-muted">POWER</span><span class="text-gold">{{ $car->hp }} BHP</span></div>
            <div class="flex justify-between px-4 py-3 font-mono text-sm"><span class="text-muted">TOP SPEED</span><span class="text-gold">{{ $car->top_speed }} KM/H</span></div>
            <div class="flex justify-between bg-carbon/30 px-4 py-3 font-mono text-sm"><span class="text-muted">STATUS</span><span class="text-gold uppercase">{{ $car->status }}</span></div>
            <div class="flex justify-between px-4 py-3 font-mono text-sm"><span class="text-muted">RATE DAILY</span><span class="text-gold">IDR {{ number_format($car->price_per_day, 0, ',', '.') }}</span></div>
        </div>

        @if ($car->status === 'available')
            @auth
                <form method="POST" action="{{ route('bookings.store', $car) }}" class="card mt-8 space-y-4 p-6"
                      x-data="{ start: '', end: '', price: {{ (float) $car->price_per_day }},
                        get days() { if (!this.start || !this.end) return 0; const d = (new Date(this.end) - new Date(this.start)) / 86400000 + 1; return d > 0 ? d : 0; } }">
                    @csrf
                    <div class="caps text-gold">Reserve This Vehicle</div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="label">Start Date</label>
                            <input type="date" name="start_date" x-model="start" min="{{ date('Y-m-d') }}" class="field" required>
                        </div>
                        <div>
                            <label class="label">End Date</label>
                            <input type="date" name="end_date" x-model="end" :min="start" class="field" required>
                        </div>
                    </div>
                    <div class="font-mono text-sm text-muted">
                        Total: <span class="text-lg font-bold text-gold" x-text="'IDR ' + new Intl.NumberFormat('id-ID').format(days * price)"></span>
                    </div>
                    <button class="btn-gold w-full" :disabled="days === 0">Book Now</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-gold mt-8">Login untuk Booking</a>
            @endauth
        @else
            <div class="mt-8 rounded border border-red-400/40 bg-red-500/10 px-4 py-3 font-mono text-sm text-red-300">Kendaraan sedang disewa.</div>
        @endif
        <a href="{{ route('fleet.index') }}" class="caps mt-8 inline-block text-muted hover:text-gold">&larr; Back to fleet</a>
    </div>
</div>
@endsection
