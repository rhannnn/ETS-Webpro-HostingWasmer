@extends('layouts.admin')
@section('title', 'VIP Manifest | SPM Command')
@section('content')
<div class="caps text-gold">Reservation Control</div>
<h1 class="mt-2 font-display text-4xl font-extrabold uppercase">VIP Manifest</h1>

<form method="GET" class="mt-6 flex items-end gap-3">
    <div>
        <label class="label">Filter Status</label>
        <select name="status" class="field">
            <option value="">All</option>
            @foreach (['pending', 'approved', 'completed', 'cancelled'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn-gold">Filter</button>
</form>

<div class="card mt-6 overflow-x-auto">
    <table class="w-full min-w-[900px] text-left font-mono text-sm">
        <thead class="caps border-b border-gold/20 text-muted">
            <tr>
                <th class="p-4">Customer</th>
                <th class="p-4">Vehicle</th>
                <th class="p-4">Period</th>
                <th class="p-4">Total</th>
                <th class="p-4">Status</th>
                <th class="p-4">Update</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr class="border-b border-white/5 odd:bg-carbon/30">
                    <td class="p-4 font-body">{{ $booking->user->name }}<div class="text-xs text-muted">{{ $booking->user->email }}</div></td>
                    <td class="p-4">{{ $booking->car->name }}</td>
                    <td class="p-4">{{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }}</td>
                    <td class="p-4 text-gold">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    <td class="p-4 uppercase">{{ $booking->status }}</td>
                    <td class="p-4">
                        <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}" class="flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="field !w-auto !py-1">
                                @foreach (['pending', 'approved', 'completed', 'cancelled'] as $status)
                                    <option value="{{ $status }}" @selected($booking->status === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            <button class="btn-gold !px-3 !py-1 text-xs">Save</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="p-6 text-muted">Belum ada booking.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $bookings->links() }}</div>
@endsection
