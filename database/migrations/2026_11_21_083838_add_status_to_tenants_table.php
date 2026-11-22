
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan status tanpa menghapus kolom is_open.
        if (!Schema::hasColumn('tenants', 'status')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->string('status', 10)
                    ->default('closed');
            });
        }

        // Sinkronkan status dengan nilai is_open yang sudah tersimpan.
        DB::statement("
            UPDATE tenants
            SET status = CASE
                WHEN is_open = 1 THEN 'open'
                ELSE 'closed'
            END
        ");
    }

    public function down(): void
    {
        // Hanya hapus kolom status yang ditambahkan migration ini.
        // Kolom is_open dan data tenant tetap dipertahankan.
        if (Schema::hasColumn('tenants', 'status')) {
            Schema::table('tenants', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
