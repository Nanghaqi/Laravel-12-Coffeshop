<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bahan_baku_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->foreignId('stok_id')->constrained('stok')->onDelete('cascade');
            $table->decimal('jumlah', 10, 3);
            $table->string('satuan_kebutuhan'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bahan_baku_produk');
    }
};
