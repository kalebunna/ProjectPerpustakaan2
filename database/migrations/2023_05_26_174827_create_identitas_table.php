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
        Schema::create('identitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah', 50);
            $table->string("nama_aplikasi", 50);
            $table->string("alamat", 50);
            $table->string("tahun_ajaran", 30);
            $table->string("logo", 255);
            $table->string("denda", 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas');
    }
};
