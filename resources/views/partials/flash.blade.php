@if (session('success'))
    <div class="mb-6 rounded border border-gold/40 bg-gold/10 px-4 py-3 font-mono text-sm text-champagne">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="mb-6 rounded border border-red-400/40 bg-red-500/10 px-4 py-3 font-mono text-sm text-red-300">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
