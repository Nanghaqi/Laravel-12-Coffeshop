<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBakuProduk extends Model
{
    protected $table = 'bahan_baku_produk';
    protected $fillable = ['produk_id', 'stok_id', 'jumlah', 'satuan_kebutuhan'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function stok()
    {
        return $this->belongsTo(Stok::class);
    }
}
