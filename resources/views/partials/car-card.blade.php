<article class="card group overflow-hidden transition hover:shadow-[0_0_35px_-8px_rgba(212,175,55,0.35)]">
    <a href="{{ route('fleet.show', $car) }}" class="relative block aspect-[16/10] overflow-hidden bg-carbon">
        <img src="{{ $car->image_url }}" alt="{{ $car->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        <span class="caps absolute left-3 top-3 rounded bg-void/80 px-2 py-1 text-gold">{{ $car->category }}</span>
        <span class="caps absolute right-3 top-3 rounded px-2 py-1 {{ $car->status === 'available' ? 'bg-gold text-void' : 'bg-red-500/80 text-white' }}">{{ $car->status }}</span>
    </a>
    <div class="p-5">
        <div class="caps text-bronze">{{ $car->brand }}</div>
        <h3 class="mt-1 font-display text-2xl font-bold uppercase leading-tight">{{ $car->name }}</h3>
        <div class="mt-4 grid grid-cols-2 gap-px overflow-hidden rounded border border-white/5 bg-white/5 text-center">
            <div class="bg-panel p-3">
                <div class="caps text-muted">Power</div>
                <div class="font-mono text-sm font-bold text-gold">{{ $car->hp }} BHP</div>
            </div>
            <div class="bg-panel p-3">
                <div class="caps text-muted">V-Max</div>
                <div class="font-mono text-sm font-bold text-gold">{{ $car->top_speed }} KM/H</div>
            </div>
        </div>
        <div class="mt-5 flex items-end justify-between gap-3">
            <div>
                <div class="caps text-muted">Rate Daily</div>
                <div class="font-mono text-lg font-bold text-gold">IDR {{ number_format($car->price_per_day, 0, ',', '.') }}</div>
            </div>
            @if (! empty($modal))
                @auth
                    <button type="button"
                            @click="pick({{ Js::from(['id' => $car->id, 'name' => $car->name, 'price' => (float) $car->price_per_day]) }})"
                            class="btn-gold !px-4 !py-2 text-xs {{ $car->status !== 'available' ? 'pointer-events-none opacity-40' : '' }}">
                        Book Vehicle
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn-gold !px-4 !py-2 text-xs">Login to Book</a>
                @endauth
            @else
                <a href="{{ route('fleet.show', $car) }}" class="btn-dark !px-4 !py-2 text-xs">Details</a>
            @endif
        </div>
    </div>
</article>
