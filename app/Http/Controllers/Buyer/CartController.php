<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Menu;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(CartService $service)
    {
        $cart = $service->cartFor(auth()->user())->load('tenant','items.menu.tenant','items.menu.category');
        return view('buyer.cart.index', ['active'=>'Keranjang','cart'=>$cart]);
    }
    public function add(Request $request, Menu $menu, CartService $service)
    {
        $data = $request->validate(['quantity'=>['nullable','integer','min:1','max:10']]);
        $service->add(auth()->user(), $menu, (int)($data['quantity'] ?? 1));
        if ($request->boolean('buy_now')) return redirect()->route('buyer.checkout.index');
        return redirect()->route('buyer.cart.index')->with('status','Menu berhasil ditambahkan ke keranjang.');
    }
    public function store(Request $request, CartService $service)
    {
        $data=$request->validate(['menu_id'=>['required','integer','exists:menus,id'],'quantity'=>['nullable','integer','min:1','max:10']]);
        $service->add(auth()->user(), Menu::with('tenant')->findOrFail($data['menu_id']), (int)($data['quantity']??1));
        if ($request->boolean('buy_now')) return redirect()->route('buyer.checkout.index');
        return redirect()->route('buyer.cart.index')->with('status','Menu berhasil ditambahkan ke keranjang.');
    }
    public function update(Request $request, CartItem $item)
    {
        $cart = auth()->user()->cart;
        abort_unless($cart && $item->cart_id === $cart->id, 403);
        if ($request->filled('action') && !$request->filled('quantity')) { $request->merge(['quantity'=>$request->input('action')==='increase' ? $item->quantity+1 : max(1,$item->quantity-1)]); }
        if ($request->filled('action') && !$request->filled('quantity')) { $request->merge(['quantity'=>$request->input('action')==='increase' ? $item->quantity+1 : max(1,$item->quantity-1)]); }
        $data=$request->validate(['quantity'=>['required','integer','min:1','max:10']]);
        $menu=$item->menu;
        abort_unless($menu && $menu->isOrderable(), 422, 'Menu tidak tersedia.');
        abort_if($data['quantity'] > $menu->stock, 422, 'Jumlah melebihi stok.');
        $item->update(['quantity'=>$data['quantity']]);
        return back()->with('status','Jumlah menu diperbarui.');
    }
    public function destroy(CartItem $item)
    {
        $cart=auth()->user()->cart;
        abort_unless($cart && $item->cart_id === $cart->id,403);
        $item->delete();
        if (!$cart->items()->exists()) $cart->update(['tenant_id'=>null]);
        return back()->with('status','Menu dihapus dari keranjang.');
    }
    public function checkout() { return redirect()->route('buyer.checkout.index'); }
    public function processCheckout(Request $request) { return redirect()->route('buyer.checkout.store', $request->all()); }
}
