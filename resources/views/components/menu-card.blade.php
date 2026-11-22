@props(['menu'])
<article class="menu-card">
    <a href="{{ route('buyer.menu.show', $menu) }}" class="menu-thumb tile-{{ $menu->id % 5 }}">
        @if ($menu->image) <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"> @else <span>{{ mb_substr($menu->name, 0, 1) }}</span> @endif
        <em class="pill tone-peach">{{ str_replace('Kantin ', '', $menu->tenant->name) }}</em>
    </a>
    <h3>{{ $menu->name }}</h3>
    <p class="muted small">{{ $menu->tenant->name }}</p>
    <div class="menu-foot">
        <strong class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</strong>
        @if ($menu->isOrderable())
            <form method="POST" action="{{ route('buyer.cart.add', $menu) }}">@csrf<button class="add-btn" aria-label="Tambah {{ $menu->name }} ke keranjang">+</button></form>
        @else
            <span class="pill tone-red">Habis</span>
        @endif
    </div>
</article>
