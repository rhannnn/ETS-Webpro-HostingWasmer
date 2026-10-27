<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request): View
    {
        $bookings = Booking::with(['user', 'car'])
            ->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,approved,completed,cancelled'],
        ]);

        $booking = Booking::with('car')->findOrFail($id);

        DB::transaction(function () use ($booking, $data) {
            $booking->update(['status' => $data['status']]);

            if ($data['status'] === 'approved') {
                $booking->car->update(['status' => 'rented']);
            }

            if (in_array($data['status'], ['completed', 'cancelled'], true)) {
                $booking->car->update(['status' => 'available']);
            }
        });

        return back()->with('success', 'Status booking berhasil diperbarui.');
    }
}
