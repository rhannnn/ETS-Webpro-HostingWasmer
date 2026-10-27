<div class="card p-6">
    <div class="font-mono text-gold">{{ str_repeat('★', $testimonial->rating) }}<span class="text-white/20">{{ str_repeat('★', 5 - $testimonial->rating) }}</span></div>
    <p class="mt-4 italic text-muted">"{{ $testimonial->comment }}"</p>
    <div class="caps mt-5 text-ink">{{ $testimonial->user_name }}</div>
</div>
