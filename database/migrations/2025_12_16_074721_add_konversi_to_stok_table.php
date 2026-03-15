<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('stok', function (Blueprint $table) {
            $table->string('satuan_dasar')->nullable()->after('satuan');
            $table->decimal('faktor_konversi', 8, 4)->default(1)->after('satuan_dasar');
        });
    }

    public function down()
    {
        Schema::table('stok', function (Blueprint $table) {
            $table->dropColumn(['satuan_dasar', 'faktor_konversi']);
        });
    }
};
