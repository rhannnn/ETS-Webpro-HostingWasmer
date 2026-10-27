@csrf
<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label class="label">Nama Kendaraan</label>
        <input type="text" name="name" value="{{ old('name', $car->name ?? '') }}" class="field" required>
    </div>
    <div>
        <label class="label">Brand</label>
        <input type="text" name="brand" value="{{ old('brand', $car->brand ?? '') }}" class="field" required>
    </div>
    <div>
        <label class="label">Category</label>
        <select name="category" class="field">
            @foreach ($categories as $category)
                <option value="{{ $category }}" @selected(old('category', $car->category ?? '') === $category)>{{ $category }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">Status</label>
        <select name="status" class="field">
            @foreach (['available', 'rented'] as $status)
                <option value="{{ $status }}" @selected(old('status', $car->status ?? 'available') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">Engine Power (BHP)</label>
        <input type="number" name="hp" value="{{ old('hp', $car->hp ?? '') }}" class="field" required>
    </div>
    <div>
        <label class="label">Top Speed (KM/H)</label>
        <input type="number" name="top_speed" value="{{ old('top_speed', $car->top_speed ?? '') }}" class="field" required>
    </div>
    <div class="md:col-span-2">
        <label class="label">Daily Tariff (IDR)</label>
        <input type="number" step="1" name="price_per_day" value="{{ old('price_per_day', isset($car) ? (int) $car->price_per_day : '') }}" class="field" required>
    </div>
    <div class="md:col-span-2" x-data="{ preview: '{{ isset($car) && $car->image ? $car->image_url : '' }}' }">
        <label class="label">Vehicle Image (JPG/PNG/WEBP, max 2MB)</label>
        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="field"
               @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview"
               {{ isset($car) ? '' : 'required' }}>
        <img x-show="preview" :src="preview" class="mt-4 max-h-56 rounded border border-gold/20">
    </div>
</div>
<div class="mt-8 flex gap-3">
    <a href="{{ route('admin.cars.index') }}" class="btn-dark">Cancel</a>
    <button class="btn-gold">Save Vehicle</button>
</div>
