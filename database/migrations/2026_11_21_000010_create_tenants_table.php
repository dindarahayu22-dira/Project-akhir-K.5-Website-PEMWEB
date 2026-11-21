<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('description', 120)->nullable();
            $table->string('location')->nullable();
            $table->string('stand', 10)->nullable();
            $table->string('distance', 20)->nullable();
            $table->time('opens_at')->default('07:00');
            $table->time('closes_at')->default('16:00');
            $table->string('status', 10)->default('closed'); // open | closed
            $table->decimal('rating', 2, 1)->default(0);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('tenants'); }
};
