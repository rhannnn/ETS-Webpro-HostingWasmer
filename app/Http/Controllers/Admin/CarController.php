<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CarController extends Controller
{
    public function index(): View
    {
        $cars = Car::latest()->paginate(10);

        return view('admin.cars.index', compact('cars'));
    }

    public function create(): View
    {
        return view('admin.cars.create', ['categories' => Car::CATEGORIES]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:Supercar,Luxury Sedan,Motorsport,SUV'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'hp' => ['required', 'integer', 'min:1'],
            'top_speed' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:available,rented'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $data['image'] = $request->file('image')->store('cars', 'public');

        Car::create($data);

        return redirect()->route('admin.cars.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function show(Car $car): View
    {
        return view('admin.cars.show', compact('car'));
    }

    public function edit(Car $car): View
    {
        return view('admin.cars.edit', [
            'car' => $car,
            'categories' => Car::CATEGORIES,
        ]);
    }

    public function update(Request $request, Car $car): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:Supercar,Luxury Sedan,Motorsport,SUV'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'hp' => ['required', 'integer', 'min:1'],
            'top_speed' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:available,rented'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }

            $data['image'] = $request->file('image')->store('cars', 'public');
        } else {
            unset($data['image']);
        }

        $car->update($data);

        return redirect()->route('admin.cars.index')->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Car $car): RedirectResponse
    {
        if ($car->image && Storage::disk('public')->exists($car->image)) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Kendaraan dan file gambar berhasil dihapus.');
    }
}
