<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        return view('testimonials.index', [
            'testimonials' => Testimonial::latest()->paginate(9),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'comment' => ['required', 'string', 'max:500'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ]);

        Testimonial::create([
            'user_name' => $request->user()->name,
            'comment' => $data['comment'],
            'rating' => $data['rating'],
        ]);

        return back()->with('success', 'Terima kasih atas testimoni Anda.');
    }
}
