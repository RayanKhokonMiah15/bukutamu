<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku_tamus', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('instansi');
    $table->string('no_telepon')->nullable();
    $table->text('keperluan');
    $table->timestamp('waktu_datang')->useCurrent();
    $table->string('foto_wajah')->nullable();
    $table->string('status')->default('pending');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_tamus');
    }
};
