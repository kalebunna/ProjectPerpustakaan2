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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peminjaman_id')->unsigned();
            $table->date('tgl_pengembalian');
            $table->string('denda', 255);
            $table->text('pengembalian');
            $table->string('status_kembali', 50);
            $table->foreign('peminjaman_id')->references('id')->on('peminjamans')->onCascade('delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
