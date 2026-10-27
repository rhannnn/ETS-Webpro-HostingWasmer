@extends('layouts.app')
@section('title', 'Surabaya Prestige Motors | Luxury Rent Car & Motorsport')
@section('content')
<section class="relative overflow-hidden">
    <div class="absolute -top-32 left-1/4 h-[500px] w-[500px] rounded-full bg-gold/10 blur-[140px]"></div>
    <div class="relative mx-auto max-w-[1440px] px-5 py-24 lg:px-12 lg:py-36">
        <div class="inline-flex items-center gap-2 rounded-full bg-carbon/80 px-3 py-1.5">
            <span class="h-2 w-2 animate-ping rounded-full bg-gold"></span>
            <span class="caps text-gold">Surabaya Atelier // 24/7 VIP Concierge</span>
        </div>
        <h1 class="mt-6 max-w-4xl font-display text-5xl font-extrabold uppercase leading-none tracking-tight lg:text-7xl">
            Drive The <br>
            <span class="bg-gradient-to-r from-gold via-champagne to-gold bg-clip-text text-transparent">Extraordinary</span> <br>
            In Surabaya
        </h1>
        <p class="mt-6 max-w-2xl text-lg text-muted">Penyewaan supercar, luxury sedan dan kendaraan motorsport terbaik di Surabaya dan Jawa Timur.</p>
        <div class="mt-8 flex flex-wrap gap-4">
            <a href="{{ route('fleet.index') }}" class="btn-gold">Explore The Fleet</a>
            <a href="{{ route('testimonials.index') }}" class="btn-dark">Client Testimonials</a>
        </div>
        <div class="card mt-14 grid max-w-3xl grid-cols-3 divide-x divide-white/5 text-center">
            <div class="p-5">
                <div class="font-mono text-2xl font-bold text-gold">{{ $availableCount }}</div>
                <div class="caps text-muted">Available</div>
            </div>
            <div class="p-5">
                <div class="font-mono text-2xl font-bold text-gold">100%</div>
                <div class="caps text-muted">Insured</div>
            </div>
            <div class="p-5">
                <div class="font-mono text-2xl font-bold text-gold">24/7</div>
                <div class="caps text-muted">Concierge</div>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-[1440px] px-5 py-16 lg:px-12">
    <div class="caps text-gold">01 // Featured</div>
    <h2 class="mt-2 font-display text-4xl font-bold uppercase">Featured Fleet</h2>
    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($featuredCars as $car)
            @include('partials.car-card', ['car' => $car])
        @empty
            <p class="text-muted">Belum ada kendaraan tersedia.</p>
        @endforelse
    </div>
</section>

<section class="mx-auto max-w-[1440px] px-5 pb-20 lg:px-12">
    <div class="caps text-gold">02 // Voices</div>
    <h2 class="mt-2 font-display text-4xl font-bold uppercase">Client Testimonials</h2>
    <div class="mt-8 grid gap-6 md:grid-cols-3">
        @forelse ($testimonials as $testimonial)
            @include('partials.testimonial-card', ['testimonial' => $testimonial])
        @empty
            <p class="text-muted">Belum ada testimoni.</p>
        @endforelse
    </div>
</section>
@endsection
