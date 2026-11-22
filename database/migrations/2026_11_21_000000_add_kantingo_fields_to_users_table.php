<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 10)->default('buyer')->after('password');   // buyer | seller
            $table->string('nim', 20)->nullable()->unique()->after('role');
            $table->string('phone', 20)->nullable()->after('nim');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'nim', 'phone']);
        });
    }
};
