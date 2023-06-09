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
        Schema::create('peminjaman_buku', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peminjaman_id')->unsigned();
            $table->bigInteger('buku_id')->unsigned();
            $table->foreign('peminjaman_id')->references('id')->on('peminjamans')->onCascade('delete');
            $table->foreign('buku_id')->references('id')->on('bukus')->onCascade('delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_items');
    }
};
