
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan status menu jika kolom belum tersedia.
        if (!Schema::hasColumn('menus', 'status')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->string('status', 20)->default('available');
            });
        }

        // Tambahkan snapshot nama menu jika kolom belum tersedia.
        if (!Schema::hasColumn('order_items', 'menu_name')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->string('menu_name')->nullable();
            });
        }

        // Isi nama menu berdasarkan data menu yang masih tersedia.
        DB::statement("
            UPDATE order_items
            INNER JOIN menus
                ON menus.id = order_items.menu_id
            SET order_items.menu_name = menus.name
            WHERE order_items.menu_name IS NULL
        ");

        // Berikan nama cadangan jika menu terkait tidak ditemukan.
        DB::table('order_items')
            ->whereNull('menu_name')
            ->update([
                'menu_name' => 'Menu tidak tersedia',
            ]);
    }

    public function down(): void
    {
        // Menghapus kolom tambahan jika migration dibatalkan.
        if (Schema::hasColumn('order_items', 'menu_name')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->dropColumn('menu_name');
            });
        }

        if (Schema::hasColumn('menus', 'status')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
