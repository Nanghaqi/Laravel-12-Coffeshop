<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'produk';
    protected $fillable = ['nama', 'kategori_id', 'harga', 'deskripsi', 'tersedia'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }

    public function bahanBaku()
    {
        return $this->hasMany(BahanBakuProduk::class);
    }
}
