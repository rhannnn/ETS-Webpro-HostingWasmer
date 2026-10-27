@extends('layouts.admin')
@section('title', 'Fleet Inventory | SPM Command')
@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
    <div>
        <div class="caps text-gold">Fleet Master Inventory</div>
        <h1 class="mt-2 font-display text-4xl font-extrabold uppercase">Fleet Inventory</h1>
    </div>
    <a href="{{ route('admin.cars.create') }}" class="btn-gold">+ Add Vehicle</a>
</div>

<div class="card mt-8 overflow-x-auto">
    <table class="w-full min-w-[800px] text-left font-mono text-sm">
        <thead class="caps border-b border-gold/20 text-muted">
            <tr>
                <th class="p-4">Image</th>
                <th class="p-4">Vehicle</th>
                <th class="p-4">Category</th>
                <th class="p-4">Rate / Day</th>
                <th class="p-4">Status</th>
                <th class="p-4 text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cars as $car)
                <tr class="border-b border-white/5 odd:bg-carbon/30">
                    <td class="p-4"><img src="{{ $car->image_url }}" class="h-12 w-20 rounded object-cover" alt=""></td>
                    <td class="p-4 font-body text-base">{{ $car->brand }} {{ $car->name }}</td>
                    <td class="p-4">{{ $car->category }}</td>
                    <td class="p-4 text-gold">IDR {{ number_format($car->price_per_day, 0, ',', '.') }}</td>
                    <td class="p-4 uppercase">{{ $car->status }}</td>
                    <td class="p-4">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.cars.edit', $car) }}" class="btn-dark !px-3 !py-1 text-xs">Edit</a>
                            <form method="POST" action="{{ route('admin.cars.destroy', $car) }}" onsubmit="return confirm('Hapus kendaraan ini beserta gambarnya?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-dark !px-3 !py-1 text-xs !text-red-300">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="p-6 text-muted">Belum ada kendaraan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $cars->links() }}</div>
@endsection
