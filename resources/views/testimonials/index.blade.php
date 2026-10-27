@extends('layouts.app')
@section('title', 'Testimonials | Surabaya Prestige Motors')
@section('content')
<div class="mx-auto max-w-[1440px] px-5 py-12 lg:px-12">
    <div class="caps text-gold">Client Voices</div>
    <h1 class="mt-2 font-display text-5xl font-extrabold uppercase">Testimonials</h1>
    <div class="mt-6">@include('partials.flash')</div>

    @auth
        <form method="POST" action="{{ route('testimonials.store') }}" class="card mt-8 max-w-2xl space-y-4 p-6">
            @csrf
            <div class="caps text-gold">Share Your Experience</div>
            <div>
                <label class="label">Rating</label>
                <select name="rating" class="field">
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }} / 5</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="label">Comment</label>
                <textarea name="comment" rows="3" maxlength="500" class="field" required>{{ old('comment') }}</textarea>
            </div>
            <button class="btn-gold">Submit</button>
        </form>
    @else
        <p class="mt-8 text-muted"><a href="{{ route('login') }}" class="text-gold">Login</a> untuk menulis testimoni.</p>
    @endauth

    <div class="mt-10 grid gap-6 md:grid-cols-3">
        @forelse ($testimonials as $testimonial)
            @include('partials.testimonial-card', ['testimonial' => $testimonial])
        @empty
            <p class="text-muted">Belum ada testimoni.</p>
        @endforelse
    </div>
    <div class="mt-8">{{ $testimonials->links() }}</div>
</div>
@endsection
