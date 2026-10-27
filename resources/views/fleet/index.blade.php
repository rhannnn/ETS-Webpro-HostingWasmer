@extends('layouts.app')
@section('title', 'Fleet | Surabaya Prestige Motors')
@section('content')
<div class="mx-auto max-w-[1440px] px-5 py-12 lg:px-12"
     x-data="{
        open: false,
        car: {},
        start: '',
        end: '',
        pick(c) { this.car = c; this.open = true; },
        get days() {
            if (!this.start || !this.end) return 0;
            const d = (new Date(this.end) - new Date(this.start)) / 86400000 + 1;
            return d > 0 ? d : 0;
        },
        get total() { return this.days * (this.car.price || 0); },
        idr(n) { return 'IDR ' + new Intl.NumberFormat('id-ID').format(n); }
     }">
    <div class="caps text-gold">Fleet Registry</div>
    <h1 class="mt-2 font-display text-5xl font-extrabold uppercase">The Fleet</h1>
    <div class="mt-6">@include('partials.flash')</div>

    <form method="GET" class="card mt-8 grid gap-4 p-5 md:grid-cols-4">
        <div class="md:col-span-2">
            <label class="label">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau merek" class="field">
        </div>
        <div>
            <label class="label">Category</label>
            <select name="category" class="field">
                <option value="">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="label">Sort</label>
            <select name="sort" class="field">
                <option value="">Newest</option>
                <option value="price_asc" @selected(request('sort') === 'price_asc')>Price: Low to High</option>
                <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: High to Low</option>
            </select>
        </div>
        <div class="md:col-span-4">
            <button class="btn-gold">Filter</button>
            <a href="{{ route('fleet.index') }}" class="btn-dark ml-2">Reset</a>
        </div>
    </form>

    <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($cars as $car)
            @include('partials.car-card', ['car' => $car, 'modal' => true])
        @empty
            <p class="text-muted">Kendaraan tidak ditemukan.</p>
        @endforelse
    </div>
    <div class="mt-8">{{ $cars->links() }}</div>

    <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" @keydown.escape.window="open = false">
        <div @click.outside="open = false" class="card max-h-[92vh] w-full max-w-lg overflow-y-auto bg-panel p-6">
            <div class="flex items-start justify-between">
                <div>
                    <div class="caps text-gold">VIP Reservation Console</div>
                    <h3 class="mt-1 font-display text-2xl font-bold uppercase" x-text="car.name"></h3>
                    <div class="font-mono text-sm text-champagne" x-text="idr(car.price || 0) + ' / day'"></div>
                </div>
                <button type="button" @click="open = false" class="text-2xl text-muted hover:text-gold">&times;</button>
            </div>
            <form method="POST" :action="'{{ url('/fleet') }}/' + car.id + '/book'" class="mt-6 space-y-5">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label">Commence</label>
                        <input type="date" name="start_date" x-model="start" min="{{ date('Y-m-d') }}" class="field" required>
                    </div>
                    <div>
                        <label class="label">Conclude</label>
                        <input type="date" name="end_date" x-model="end" :min="start" class="field" required>
                    </div>
                </div>
                <div class="rounded border border-gold/20 bg-void p-4">
                    <div class="flex justify-between font-mono text-sm text-muted">
                        <span>Duration</span><span x-text="days + ' day(s)'"></span>
                    </div>
                    <div class="mt-2 flex items-end justify-between">
                        <span class="caps text-muted">Net Charter Total</span>
                        <span class="font-mono text-xl font-bold text-gold" x-text="idr(total)"></span>
                    </div>
                </div>
                <button class="btn-gold w-full" :disabled="days === 0">Confirm Booking</button>
            </form>
        </div>
    </div>
</div>
@endsection
