<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('stok_sekarang');
            $table->integer('stok_minimal');
            $table->string('satuan');
            $table->string('status')->default('aman');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok');
    }
};
