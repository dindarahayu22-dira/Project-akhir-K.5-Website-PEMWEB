<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;

class OrderController extends Controller
{
    /** Alur status: new -> processing -> ready -> completed (tolak: rejected). */
    private const NEXT = ['new' => 'processing', 'processing' => 'ready', 'ready' => 'completed'];

    private const MESSAGES = [
        'processing' => ['Pesanan diproses', 'Pesanan Anda sedang diproses oleh penjual.'],
        'ready'      => ['Pesanan siap diambil', 'Pesanan Anda sudah siap diambil di kantin.'],
        'completed'  => ['Pesanan selesai', 'Pesanan Anda telah selesai. Jangan lupa beri ulasan!'],
        'rejected'   => ['Pesanan ditolak', 'Maaf, pesanan Anda ditolak oleh penjual.'],
    ];

    public function dashboard()
    {
        $tenant = auth()->user()->tenant;
        $orders = $tenant->orders()->with('user', 'items.menu', 'payment');

        return view('seller.orders', [
            'active'    => 'Dashboard', 'tenant' => $tenant, 'showStats' => true,
            'stats'     => [
                'today'   => $tenant->orders()->whereDate('created_at', today())->count(),
                'pending' => $tenant->orders()->whereIn('status', ['new', 'processing'])->count(),
                'revenue' => (int) $tenant->orders()->where('status', 'completed')->sum('total'),
                'menus'   => $tenant->menus()->where('status', 'available')->count(),
            ],
            'orders'    => $orders->latest()->take(5)->get(),
        ]);
    }

    public function index()
    {
        $tenant = auth()->user()->tenant;
        return view('seller.orders', [
            'active' => 'Pesanan Masuk', 'tenant' => $tenant, 'showStats' => false,
            'orders' => $tenant->orders()->with('user', 'items.menu', 'payment')->latest()->get(),
        ]);
    }

    public function update(Order $order)
    {
        abort_unless($order->tenant_id === auth()->user()->tenant?->id, 403);   // hanya tenant miliknya
        $target = request('status') === 'rejected' ? 'rejected' : (self::NEXT[$order->status] ?? null);
        abort_if(! $target || ($target === 'rejected' && $order->status !== 'new'), 422, 'Perubahan status tidak valid.');

        $order->update(['status' => $target]);

        if ($target === 'rejected') {
            foreach ($order->items as $item) { $item->menu?->increment('stock', $item->quantity); }
        }

        [$title, $msg] = self::MESSAGES[$target];
        Notification::create(['user_id' => $order->user_id, 'type' => 'order', 'title' => $title, 'message' => $msg]);

        return back()->with('status', "Pesanan #{$order->order_number} → " . $title);
    }
}
