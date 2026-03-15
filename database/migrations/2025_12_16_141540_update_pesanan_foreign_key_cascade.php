<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('detail_pesanan', function (Blueprint $table) {
            $table->dropForeign(['pesanan_id']);
            $table->foreign('pesanan_id')
                  ->references('id')
                  ->on('pesanan')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('detail_pesanan', function (Blueprint $table) {
            $table->dropForeign(['pesanan_id']);
            $table->foreign('pesanan_id')
                  ->references('id')
                  ->on('pesanan');
        });
    }
};
