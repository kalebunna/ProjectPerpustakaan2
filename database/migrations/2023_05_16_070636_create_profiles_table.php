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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->string("nim")->nullable(true);
            $table->string("nama")->nullable(true);
            $table->string("kelamin")->nullable(true);
            $table->string("agama")->nullable(true);
            $table->string("tempat_lahir")->nullable(true);
            $table->string("tanggal_lahir")->nullable(true);
            $table->string("alamat")->nullable(true);
            $table->string("no_telp")->nullable(true);
            $table->string("token")->nullable(true);
            $table->foreign('user_id')->references('id')->on('users')->onCascade('delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
