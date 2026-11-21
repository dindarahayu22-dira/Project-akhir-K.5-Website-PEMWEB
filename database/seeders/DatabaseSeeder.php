<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Review;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Semua akun demo memakai password: rahasia123
        $budi   = User::create(['name' => 'Budi Santoso', 'email' => 'budi@email.com', 'password' => 'rahasia123', 'role' => 'buyer', 'nim' => '12345678', 'phone' => '0812 3456 7890']);
        $dinda  = User::create(['name' => 'Dinda Rahayu', 'email' => 'dinda@email.com', 'password' => 'rahasia123', 'role' => 'buyer', 'nim' => '255150601111034']);

        $sari   = User::create(['name' => 'Bu Sari', 'email' => 'sari@kantin.test', 'password' => 'rahasia123', 'role' => 'seller', 'phone' => '0812 3456 7890']);
        $barokah = User::create(['name' => 'Pak Barokah', 'email' => 'barokah@kantin.test', 'password' => 'rahasia123', 'role' => 'seller']);
        $mang   = User::create(['name' => 'Mang Ujang', 'email' => 'ujang@kantin.test', 'password' => 'rahasia123', 'role' => 'seller']);

        $food  = Category::create(['name' => 'Makanan']);
        $drink = Category::create(['name' => 'Minuman']);

        $fik = Tenant::create(['user_id' => $sari->id, 'name' => 'Kantin FILKOM', 'description' => 'Makanan & minuman untuk civitas FILKOM',
            'location' => 'Gedung FILKOM, Lantai 1', 'stand' => '04', 'distance' => '50 m', 'rating' => 4.8]);
        $feb = Tenant::create(['user_id' => $barokah->id, 'name' => 'Kantin FEB', 'description' => 'Aneka minuman dan makanan ringan',
            'location' => 'Gedung FEB, Lantai 4', 'stand' => '02', 'distance' => '100 m', 'rating' => 4.7]);
        $ft = Tenant::create(['user_id' => $mang->id, 'name' => 'Kantin FT', 'description' => 'Siomay dan jajanan favorit',
            'location' => 'Gedung FT, Lantai G', 'stand' => '07', 'distance' => '150 m', 'rating' => 4.9]);

        $nasi   = Menu::create(['tenant_id' => $fik->id, 'category_id' => $food->id, 'name' => 'Nasi Goreng', 'price' => 12000, 'stock' => 30,
            'description' => 'Nasi goreng khas nusantara dengan racikan bumbu gurih istimewa, telur mata sapi, ayam suwir, kerupuk renyah, dan acar timun segar.']);
        $mie    = Menu::create(['tenant_id' => $fik->id, 'category_id' => $food->id, 'name' => 'Mie Ayam', 'price' => 10000, 'stock' => 25, 'description' => 'Mie ayam dengan topping ayam kecap dan pangsit.']);
        $esteh  = Menu::create(['tenant_id' => $fik->id, 'category_id' => $drink->id, 'name' => 'Es Teh Manis', 'price' => 5000, 'stock' => 50, 'description' => 'Teh manis dingin segar.']);
        $jus    = Menu::create(['tenant_id' => $feb->id, 'category_id' => $drink->id, 'name' => 'Jus Alpukat', 'price' => 8000, 'stock' => 20, 'description' => 'Jus alpukat segar dengan susu cokelat.']);
        $siomay = Menu::create(['tenant_id' => $ft->id, 'category_id' => $food->id, 'name' => 'Siomay', 'price' => 9000, 'stock' => 15, 'description' => 'Siomay ikan dengan saus kacang.']);

        // Pesanan berjalan milik Budi (Diproses) — sama dengan contoh di Figma
        $this->order($budi, $fik, 'KP2505120021', 'processing', now()->setTime(12, 30), 'FK-82', [[$nasi, 1], [$esteh, 2]], 'paid', 'Tanpa sambal, es tidak terlalu banyak');

        // Riwayat selesai
        $o2 = $this->order($budi, $feb, 'KP2505120014', 'completed', now()->subMonths(6)->setDate(2025, 5, 12)->setTime(11, 15), 'EB-11', [[$jus, 2]], 'paid');
        $o3 = $this->order($budi, $ft, 'KP2505080071', 'completed', now()->setDate(2025, 5, 8)->setTime(9, 45), 'FT-07', [[$siomay, 1]], 'paid');
        Review::create(['user_id' => $budi->id, 'order_id' => $o3->id, 'tenant_id' => $ft->id, 'rating' => 5, 'tags' => ['Rasa mantap'],
            'comment' => 'Siomay-nya enak dan hangat.', 'tenant_response' => 'Terima kasih sudah mampir!', 'responded_at' => now()]);

        // Pesanan baru Dinda (masuk ke dashboard Bu Sari)
        $this->order($dinda, $fik, 'KP2505120002', 'new', now()->setTime(12, 35), 'IK-35', [[$mie, 2]], 'pending');

        Notification::create(['user_id' => $budi->id, 'type' => 'order', 'title' => 'Pesanan berhasil dibuat', 'message' => 'Pesanan Anda di Kantin FIK telah berhasil dibuat.']);
        Notification::create(['user_id' => $budi->id, 'type' => 'payment', 'title' => 'Pembayaran berhasil', 'message' => 'Pembayaran sebesar Rp 22.000 berhasil.']);
        Notification::create(['user_id' => $budi->id, 'type' => 'order', 'title' => 'Pesanan diproses', 'message' => 'Pesanan Anda sedang diproses oleh penjual.']);
        Notification::create(['user_id' => $sari->id, 'type' => 'order', 'title' => 'Pesanan baru masuk', 'message' => 'Budi Santoso memesan 2 menu, total Rp 22.000.']);
    }

    private function order(User $user, Tenant $tenant, string $no, string $status, $at, string $code, array $lines, string $pay, ?string $note = null): Order
    {
        $total = collect($lines)->sum(fn ($l) => $l[0]->price * $l[1]);

        $order = Order::create(['order_number' => $no, 'user_id' => $user->id, 'tenant_id' => $tenant->id, 'total' => $total, 'status' => $status,
            'pickup_time' => 'Hari ini, ' . $at->format('H:i'), 'pickup_code' => $code, 'note' => $note, 'created_at' => $at, 'updated_at' => $at]);

        foreach ($lines as [$menu, $qty]) {
            $order->items()->create(['menu_id' => $menu->id, 'quantity' => $qty, 'price' => $menu->price]);
        }

        $order->payment()->create(['amount' => $total, 'method' => 'ewallet', 'status' => $pay,
            'expires_at' => $pay === 'pending' ? now()->addDay() : $at->copy()->addMinutes(15), 'paid_at' => $pay === 'paid' ? $at : null]);

        return $order;
    }
}
