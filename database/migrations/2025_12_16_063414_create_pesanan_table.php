<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->enum('jenis', ['dine_in', 'takeaway']);
            $table->enum('status', ['pending', 'diproses', 'selesai']);
            $table->decimal('total_harga', 10, 2);
            $table->dateTime('tanggal_pesanan')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
};
