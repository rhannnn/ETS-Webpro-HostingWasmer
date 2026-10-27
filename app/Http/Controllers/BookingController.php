<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request): View
    {
        $bookings = $request->user()
            ->bookings()
            ->with('car')
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request, Car $car): RedirectResponse
    {
        $data = $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        if ($car->status !== 'available') {
            return back()->withErrors(['start_date' => 'Kendaraan sedang tidak tersedia.']);
        }

        $overlap = Booking::where('car_id', $car->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where('start_date', '<=', $data['end_date'])
            ->where('end_date', '>=', $data['start_date'])
            ->exists();

        if ($overlap) {
            return back()->withErrors(['start_date' => 'Kendaraan sudah dipesan pada rentang tanggal tersebut.']);
        }

        $days = Carbon::parse($data['start_date'])->diffInDays(Carbon::parse($data['end_date'])) + 1;

        Booking::create([
            'user_id' => $request->user()->id,
            'car_id' => $car->id,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'total_price' => $days * $car->price_per_day,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat, menunggu persetujuan admin.');
    }

    public function cancel(Request $request, Booking $booking): RedirectResponse
    {
        abort_unless($booking->user_id === $request->user()->id, 403);
        abort_unless($booking->status === 'pending', 403);

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking dibatalkan.');
    }
}
