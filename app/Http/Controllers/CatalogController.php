<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'featuredCars' => Car::where('status', 'available')->latest()->take(3)->get(),
            'testimonials' => Testimonial::latest()->take(3)->get(),
            'availableCount' => Car::where('status', 'available')->count(),
        ]);
    }

    public function index(Request $request): View
    {
        $cars = Car::query()
            ->when($request->category, fn ($query, $category) => $query->where('category', $category))
            ->when($request->search, function ($query, $search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('brand', 'like', "%{$search}%");
                });
            })
            ->when($request->sort === 'price_asc', fn ($query) => $query->orderBy('price_per_day'))
            ->when($request->sort === 'price_desc', fn ($query) => $query->orderByDesc('price_per_day'))
            ->when(! $request->sort, fn ($query) => $query->latest())
            ->paginate(9)
            ->withQueryString();

        return view('fleet.index', [
            'cars' => $cars,
            'categories' => Car::CATEGORIES,
        ]);
    }

    public function show(Car $car): View
    {
        return view('fleet.show', compact('car'));
    }
}
