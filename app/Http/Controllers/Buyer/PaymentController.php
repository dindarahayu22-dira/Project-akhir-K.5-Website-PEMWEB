<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

/** Pembayaran SIMULASI (tanpa payment gateway sungguhan). */
class PaymentController extends Controller
{
    private const METHODS = [
        'bank_transfer'   => 'Transfer Bank',
        'ewallet'         => 'E-Wallet',
        'virtual_account' => 'Virtual Account',
        'cash'            => 'Bayar di Kantin',
    ];

    public function index()
    {
        $order = Order::where('user_id', auth()->id())
            ->whereHas('payment', fn ($q) => $q->where('status', 'pending'))
            ->latest()
            ->first();

        if ($order) {
            return redirect()->route('buyer.payment.show', $order);
        }

        // Jika ada data checkout di session tetapi record Order belum dibuat di DB,
        // tetap tampilkan halaman pembayaran agar tampilan sesuai desain Figma.
        if (session()->has('kantingo_checkout')) {
            return view('buyer.payment.show', [
                'active'  => 'Pembayaran',
                'order'   => null,
                'payment' => null,
                'methods' => self::METHODS,
            ]);
        }

        return view('buyer.payment.empty', [
            'active' => 'Pembayaran',
        ]);
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        $order->load('tenant', 'items.menu', 'payment');

        $payment = $order->payment;
        if ($payment && $payment->status === 'pending' && !empty($payment->expires_at)) {
            $expiresAt = $payment->expires_at instanceof Carbon
                ? $payment->expires_at
                : Carbon::parse($payment->expires_at);

            if ($expiresAt->isPast()) {
                \Illuminate\Support\Facades\DB::transaction(function () use ($payment, $order) {
                    $payment->update(['status' => 'expired']);
                    $order->update(['status' => 'cancelled']);
                    foreach ($order->items as $item) { if ($item->menu_id) { $item->menu()->increment('stock', $item->quantity); $item->menu()->update(['status' => 'available']); } }
                });
            }
        }

        return view('buyer.payment.show', [
            'active'  => 'Pembayaran',
            'order'   => $order,
            'payment' => $payment,
            'methods' => self::METHODS,
        ]);
    }


    public function pay(Request $request, Order $order)
    {
        abort_unless(
            (int) $order->user_id === (int) auth()->id(),
            403
        );

        $data = $request->validate([
            'method' => [
                'required',
                'in:' . implode(',', array_keys(self::METHODS)),
            ],
        ]);

        $payment = $order->payment;

        if (!$payment) {
            return redirect()
                ->route('buyer.orders.index')
                ->with('error', 'Data pembayaran tidak ditemukan.');
        }

        if ($order->status === 'cancelled' || $payment->status === 'failed') {
            return redirect()
                ->route('buyer.orders.index')
                ->with('error', 'Pesanan sudah dibatalkan. Silakan buat pesanan baru.');
        }

        if ($payment->status !== 'pending' || $order->status !== 'new') {
            return redirect()
                ->route('buyer.orders.index')
                ->with('error', 'Pembayaran tidak dapat diproses karena status pesanan tidak sesuai.');
        }

        $payment->update([
            'method'  => $data['method'],
            'status'  => 'paid',
            'paid_at' => now(),
        ]);

        Notification::create([
            'user_id' => auth()->id(),
            'type'    => 'payment',
            'title'   => 'Pembayaran berhasil',
            'message' => 'Pembayaran sebesar Rp '
                . number_format($order->total, 0, ',', '.')
                . ' berhasil.',
        ]);

        if ($order->tenant && !empty($order->tenant->user_id)) {
            Notification::create([
                'user_id' => $order->tenant->user_id,
                'type'    => 'payment',
                'title'   => 'Pembayaran dikonfirmasi',
                'message' => "Pembayaran #{$order->order_number} berstatus Dibayar.",
            ]);
        }

        session()->forget('kantingo_checkout');

        return redirect()
            ->route('buyer.orders.index')
            ->with('status', 'Pembayaran berhasil. Pesananmu diteruskan ke kantin.');
    }

    public function cancel(Order $order)
    {
        abort_unless($order->user_id === auth()->id() && $order->status === 'new', 403);
        $order->update(['status' => 'cancelled']);
        if ($order->payment) {
            $order->payment->update(['status' => 'failed']);
        }
        foreach ($order->items as $item) {
            if ($item->menu_id) { $item->menu()->increment('stock', $item->quantity); $item->menu()->update(['status' => 'available']); }
        }

        session()->forget('kantingo_checkout');

        return redirect()->route('buyer.orders.index', ['tab' => 'cancelled'])
            ->with('status', 'Pesanan dibatalkan.');
    }
}