<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = ['nama_pelanggan', 'jenis', 'status', 'total_harga', 'tanggal_pesanan'];

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
