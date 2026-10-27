@extends('layouts.app')
@section('title', 'My Bookings | Surabaya Prestige Motors')
@section('content')
<div class="mx-auto max-w-[1440px] px-5 py-12 lg:px-12">
    <div class="caps text-gold">VIP Manifest</div>
    <h1 class="mt-2 font-display text-5xl font-extrabold uppercase">My Bookings</h1>
    <div class="mt-6">@include('partials.flash')</div>
    <div class="card mt-8 overflow-x-auto">
        <table class="w-full min-w-[700px] text-left font-mono text-sm">
            <thead class="caps border-b border-gold/20 text-muted">
                <tr>
                    <th class="p-4">Vehicle</th>
                    <th class="p-4">Period</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Status</th>
                    <th class="p-4"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr class="border-b border-white/5 odd:bg-carbon/30">
                        <td class="p-4 font-body text-base">{{ $booking->car->brand }} {{ $booking->car->name }}</td>
                        <td class="p-4">{{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }}</td>
                        <td class="p-4 text-gold">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td class="p-4 uppercase">{{ $booking->status }}</td>
                        <td class="p-4 text-right">
                            @if ($booking->status === 'pending')
                                <form method="POST" action="{{ route('bookings.cancel', $booking) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn-dark !px-3 !py-1 text-xs">Cancel</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-muted">Belum ada booking.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $bookings->links() }}</div>
</div>
@endsection
