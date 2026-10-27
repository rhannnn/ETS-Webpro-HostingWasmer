@extends('layouts.admin')
@section('title', 'Operations Hub | SPM Command')
@section('content')
<div class="caps text-gold">Dispatch &amp; Fleet Core</div>
<h1 class="mt-2 font-display text-4xl font-extrabold uppercase">Operations Hub</h1>

<div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
    @php
        $stats = [
            ['Total Fleet', $totalCars],
            ['Available', $availableCars],
            ['Customers', $totalCustomers],
            ['Pending Bookings', $pendingBookings],
            ['Revenue (IDR)', number_format($revenue, 0, ',', '.')],
        ];
    @endphp
    @foreach ($stats as [$label, $value])
        <div class="card p-5">
            <div class="caps text-muted">{{ $label }}</div>
            <div class="mt-2 font-mono text-2xl font-bold text-gold">{{ $value }}</div>
        </div>
    @endforeach
</div>

<div class="card mt-10 overflow-x-auto">
    <div class="caps border-b border-gold/20 p-4 text-gold">Latest Bookings</div>
    <table class="w-full min-w-[600px] text-left font-mono text-sm">
        <tbody>
            @forelse ($latestBookings as $booking)
                <tr class="border-b border-white/5 odd:bg-carbon/30">
                    <td class="p-4 font-body">{{ $booking->user->name }}</td>
                    <td class="p-4">{{ $booking->car->name }}</td>
                    <td class="p-4 text-gold">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    <td class="p-4 uppercase">{{ $booking->status }}</td>
                </tr>
            @empty
                <tr><td class="p-6 text-muted">Belum ada booking.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
