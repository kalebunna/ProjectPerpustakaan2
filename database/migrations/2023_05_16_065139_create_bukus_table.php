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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("kategori_id")->unsigned();
            $table->string("judul_buku", 150);
            $table->string("pengarang", 50);
            $table->string("penerbit", 50);
            $table->string("tahun_terbit", 50);
            $table->string("gambar", 50);
            $table->string("jumlah_halaman", 50);
            $table->string("stok_buku", 50);
            $table->string("bahasa", 50);
            $table->text("sinopsis");
            $table->string("label_buku", 50);
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onCascade('delete');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
