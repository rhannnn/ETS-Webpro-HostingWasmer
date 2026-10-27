<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Outfit:wght@400;500&family=JetBrains+Mono:wght@500;700&family=Material+Symbols+Outlined" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                void: '#0A0A0C',
                panel: '#17181C',
                carbon: '#23252B',
                gold: '#D4AF37',
                champagne: '#E5C07B',
                bronze: '#C5A059',
                ink: '#F3F4F6',
                muted: '#d0c5af'
            },
            fontFamily: {
                display: ['Syne', 'sans-serif'],
                body: ['Outfit', 'sans-serif'],
                mono: ['JetBrains Mono', 'monospace']
            }
        }
    }
}
</script>
<style>
    [x-cloak] { display: none !important; }
    body { background: #0A0A0C; color: #F3F4F6; font-family: 'Outfit', sans-serif; }
    .btn-gold { background: linear-gradient(to bottom, #E5C07B, #C5A059); color: #0A0A0C; font-family: 'Syne', sans-serif; font-weight: 600; text-transform: uppercase; letter-spacing: .05em; padding: .75rem 1.5rem; border-radius: .25rem; box-shadow: inset 0 1px 0 rgba(255,255,255,.4); transition: all .2s; display: inline-block; text-align: center; }
    .btn-gold:hover { box-shadow: 0 0 24px rgba(212,175,55,.45); transform: scale(1.02); }
    .btn-dark { background: #17181C; color: #F3F4F6; border: 1px solid rgba(212,175,55,.3); font-family: 'Syne', sans-serif; text-transform: uppercase; letter-spacing: .05em; padding: .75rem 1.5rem; border-radius: .25rem; transition: all .2s; display: inline-block; text-align: center; }
    .btn-dark:hover { border-color: #D4AF37; color: #E5C07B; }
    .card { background: rgba(23,24,28,.75); backdrop-filter: blur(24px); border: 1px solid rgba(212,175,55,.2); border-radius: .5rem; }
    .field { width: 100%; background: rgba(10,10,12,.8); border: 1px solid rgba(255,255,255,.1); border-radius: .25rem; padding: .65rem .85rem; font-family: 'JetBrains Mono', monospace; font-size: .875rem; color: #F3F4F6; outline: none; }
    .field:focus { border-color: #D4AF37; box-shadow: 0 0 12px -2px rgba(212,175,55,.4); }
    .label { display: block; font-family: 'JetBrains Mono', monospace; font-size: 11px; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: #d0c5af; margin-bottom: .35rem; }
    .caps { font-family: 'JetBrains Mono', monospace; font-size: 11px; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; }
</style>
