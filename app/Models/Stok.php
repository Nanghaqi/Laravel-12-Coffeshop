<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stok';
    protected $fillable = ['nama_barang', 'stok_sekarang', 'stok_minimal', 'satuan', 'status'];
}
