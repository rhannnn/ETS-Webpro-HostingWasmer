@extends('layouts.admin')
@section('title', $car->name . ' | SPM Command')
@section('content')
<div class="caps text-gold">{{ $car->brand }} // {{ $car->category }}</div>
<h1 class="mt-2 font-display text-4xl font-extrabold uppercase">{{ $car->name }}</h1>
<div class="card mt-8 max-w-3xl overflow-hidden">
    <img src="{{ $car->image_url }}" alt="{{ $car->name }}" class="w-full">
    <div class="grid grid-cols-2 gap-4 p-6 font-mono text-sm">
        <div><span class="text-muted">BHP</span> <span class="text-gold">{{ $car->hp }}</span></div>
        <div><span class="text-muted">V-MAX</span> <span class="text-gold">{{ $car->top_speed }} KM/H</span></div>
        <div><span class="text-muted">STATUS</span> <span class="uppercase text-gold">{{ $car->status }}</span></div>
        <div><span class="text-muted">RATE</span> <span class="text-gold">IDR {{ number_format($car->price_per_day, 0, ',', '.') }}</span></div>
    </div>
</div>
<a href="{{ route('admin.cars.index') }}" class="btn-dark mt-6">Back</a>
@endsection
