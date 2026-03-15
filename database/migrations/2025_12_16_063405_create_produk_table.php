<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');;
            $table->decimal('harga', 10, 2);
            $table->text('deskripsi')->nullable();
            $table->boolean('tersedia')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk');
    }
};
