<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalCars' => Car::count(),
            'availableCars' => Car::where('status', 'available')->count(),
            'totalCustomers' => User::where('role', 'customer')->count(),
            'pendingBookings' => Booking::where('status', 'pending')->count(),
            'revenue' => Booking::whereIn('status', ['approved', 'completed'])->sum('total_price'),
            'latestBookings' => Booking::with(['user', 'car'])->latest()->take(5)->get(),
        ]);
    }
}
