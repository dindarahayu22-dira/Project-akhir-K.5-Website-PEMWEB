<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $tab =$request->query('tab', 'all');

        $orders = Order::where('user_id', auth()->id())
            ->with(['tenant', 'items.menu', 'payment'])
            ->latest()
            ->get();

        return view('buyer.orders.index', [
            'active' => 'Riwayat',
            'orders' => $orders,
            'tab'    => $tab,
        ]);
    }

    public function reorder(Order $order, \App\Services\CartService $service)
    {
        abort_unless((int)$order->user_id === (int)auth()->id(), 403);
        $order->load('items.menu.tenant');
        foreach ($order->items as $item) {
            $menu=$item->menu;
            if ($menu && $menu->isOrderable()) $service->add(auth()->user(), $menu, min((int)$item->quantity, (int)$menu->stock));
        }
        return redirect()->route('buyer.cart.index')->with('status','Menu yang masih tersedia dari pesanan sebelumnya ditambahkan ke keranjang.');
    }
}
