<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\User;

class CartService
{
    public function cartFor(User $user): Cart { return Cart::firstOrCreate(['user_id' => $user->id]); }

    public function add(User $user, Menu $menu, int $qty = 1): void
    {
        $menu->loadMissing('tenant');
        abort_unless($menu->isOrderable(), 422, 'Menu sedang tidak tersedia atau kantin sedang tutup.');
        $cart = $this->cartFor($user);
        if ($cart->tenant_id && (int)$cart->tenant_id !== (int)$menu->tenant_id) $cart->items()->delete();
        $cart->update(['tenant_id' => $menu->tenant_id]);
        $item = $cart->items()->firstOrNew(['menu_id' => $menu->id]);
        $newQty = ($item->exists ? (int)$item->quantity : 0) + max(1, $qty);
        abort_if($newQty > $menu->stock, 422, 'Jumlah melebihi stok yang tersedia.');
        $item->quantity = min(10, $newQty);
        $item->save();
    }
    public function count(User $user): int { return (int) $this->cartFor($user)->items()->count(); }
}
