<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index(CartService $service)
    {
        $cart = $service->cartFor(auth()->user())
            ->load('tenant', 'items.menu.tenant');

        if ($cart->items->isEmpty()) {
            return redirect()
                ->route('buyer.cart.index')
                ->with('status', 'Keranjang masih kosong. Tambahkan menu terlebih dahulu.');
        }

        return view('buyer.checkout.index', [
            'active' => 'Pesanan',
            'cart' => $cart,
        ]);
    }

    public function store(Request $request, CartService $service)
    {
        $data = $request->validate([
            'pickup_time' => ['required', 'date_format:H:i'],
            'note' => ['nullable', 'string', 'max:150'],
        ]);

        $user = auth()->user();

        $cart = $service->cartFor($user)
            ->load('tenant', 'items.menu.tenant');

        abort_if(
            $cart->items->isEmpty() || !$cart->tenant_id,
            422,
            'Keranjang kosong.'
        );

        // Periksa waktu pilihan minimal 10 menit dari sekarang.
        $now = now();
        $minimumPickup = $now->copy()->addMinutes(10);
        $selectedPickup = $now->copy()->setTimeFromTimeString(
            $data['pickup_time']
        );

        if ($selectedPickup->lt($minimumPickup)) {
            return back()
                ->withInput()
                ->withErrors([
                    'pickup_time' => 'Waktu pengambilan minimal 10 menit dari waktu pemesanan.',
                ]);
        }

        $order = DB::transaction(function () use ($cart, $data, $user) {
            $tenant = $cart->tenant()->lockForUpdate()->first();

            abort_unless(
                $tenant && $tenant->status === 'open',
                422,
                'Kantin sedang tutup.'
            );

            $locked = [];
            $total = 0;

            foreach ($cart->items as $item) {
                $menu = $item->menu_id
                    ? $item->menu()->lockForUpdate()->first()
                    : null;

                abort_unless(
                    $menu &&
                    $menu->tenant_id == $tenant->id &&
                    $menu->status === 'available' &&
                    $menu->stock >= $item->quantity,
                    422,
                    'Ada menu yang tidak tersedia atau stoknya kurang.'
                );

                $locked[] = [
                    'cart_item' => $item,
                    'menu' => $menu,
                ];

                $total += (int) $menu->price * (int) $item->quantity;
            }

            $order = Order::create([
                'order_number' => 'KG' . now()->format('ymdHis') . random_int(100, 999),
                'user_id' => $user->id,
                'tenant_id' => $tenant->id,
                'total' => $total,
                'status' => 'new',
                'pickup_time' => $data['pickup_time'],
                'pickup_code' => strtoupper(
                    substr(preg_replace('/\W/', '', $tenant->name), -2)
                ) . '-' . random_int(10, 99),
                'note' => $data['note'] ?? null,
            ]);

            foreach ($locked as $line) {
                $menu = $line['menu'];
                $item = $line['cart_item'];

                $order->items()->create([
                    'menu_id' => $menu->id,
                    'menu_name' => $menu->name,
                    'quantity' => $item->quantity,
                    'price' => $menu->price,
                ]);

                $menu->decrement('stock', $item->quantity);

                if ($menu->stock <= $item->quantity) {
                    $menu->update(['status' => 'unavailable']);
                }
            }

            $order->payment()->create([
                'amount' => $total,
                'status' => 'pending',
                'expires_at' => now()->addMinutes(30),
            ]);

            Notification::create([
                'user_id' => $user->id,
                'type' => 'order',
                'title' => 'Pesanan berhasil dibuat',
                'message' => "Pesanan {$order->order_number} di {$tenant->name} berhasil dibuat.",
            ]);

            Notification::create([
                'user_id' => $tenant->user_id,
                'type' => 'order',
                'title' => 'Pesanan baru masuk',
                'message' => $user->name . ' membuat pesanan ' . $order->order_number . '.',
            ]);

            $cart->items()->delete();
            $cart->update(['tenant_id' => null]);

            return $order;
        });

        return redirect()
            ->route('buyer.payment.show', $order)
            ->with(
                'status',
                'Pesanan dibuat. Selesaikan pembayaran simulasi untuk meneruskan pesanan.'
            );
    }
}
