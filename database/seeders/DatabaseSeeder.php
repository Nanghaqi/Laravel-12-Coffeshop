<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stok;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\BahanBakuProduk;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Stok::truncate();
        Kategori::truncate();
        Produk::truncate();
        BahanBakuProduk::truncate();
        $stokData = [
            [
                'nama_barang' => 'Cup Paper',
                'stok_sekarang' => 500,
                'stok_minimal' => 100,
                'satuan' => 'pcs',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Sedotan',
                'stok_sekarang' => 1000,
                'stok_minimal' => 200,
                'satuan' => 'pcs',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Tutup Cup',
                'stok_sekarang' => 500,
                'stok_minimal' => 100,
                'satuan' => 'pcs',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Kopi Bubuk',
                'stok_sekarang' => 5,
                'stok_minimal' => 1,
                'satuan' => 'kg',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Susu Cair',
                'stok_sekarang' => 10,
                'stok_minimal' => 2,
                'satuan' => 'liter',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Gula Pasir',
                'stok_sekarang' => 20,
                'stok_minimal' => 5,
                'satuan' => 'kg',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Es Batu',
                'stok_sekarang' => 50,
                'stok_minimal' => 10,
                'satuan' => 'kg',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Coklat Bubuk',
                'stok_sekarang' => 3,
                'stok_minimal' => 1,
                'satuan' => 'kg',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Vanilla Syrup',
                'stok_sekarang' => 5,
                'stok_minimal' => 1,
                'satuan' => 'liter',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Teh Celup',
                'stok_sekarang' => 100,
                'stok_minimal' => 20,
                'satuan' => 'pcs',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Sirup Gula',
                'stok_sekarang' => 8,
                'stok_minimal' => 2,
                'satuan' => 'liter',
                'status' => 'aman',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($stokData as $data) {
            Stok::create($data);
        }
        $kategoriData = [
            ['nama' => 'Kopi', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Non-Kopi', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Tea', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Snack', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Dessert', 'created_at' => now(), 'updated_at' => now()]
        ];

        foreach ($kategoriData as $data) {
            Kategori::create($data);
        }
        $produkData = [
            [
                'nama' => 'Espresso',
                'kategori_id' => 1,
                'harga' => 15000,
                'deskripsi' => 'Kopi espresso murni',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Cappuccino',
                'kategori_id' => 1,
                'harga' => 20000,
                'deskripsi' => 'Espresso dengan susu steamed',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Latte',
                'kategori_id' => 1,
                'harga' => 22000,
                'deskripsi' => 'Espresso dengan banyak susu',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Americano',
                'kategori_id' => 1,
                'harga' => 18000,
                'deskripsi' => 'Espresso dengan air panas',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Mocha',
                'kategori_id' => 1,
                'harga' => 23000,
                'deskripsi' => 'Espresso dengan coklat dan susu',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Milo Dinosaur',
                'kategori_id' => 2,
                'harga' => 18000,
                'deskripsi' => 'Milo dengan extra bubuk milo',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Green Tea Latte',
                'kategori_id' => 2,
                'harga' => 20000,
                'deskripsi' => 'Green tea dengan susu',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Teh Tarik',
                'kategori_id' => 3,
                'harga' => 12000,
                'deskripsi' => 'Teh susu khas Malaysia',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Thai Tea',
                'kategori_id' => 3,
                'harga' => 15000,
                'deskripsi' => 'Teh thailand dengan rasa khas',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Red Velvet',
                'kategori_id' => 4,
                'harga' => 25000,
                'deskripsi' => 'Red velvet dengan cream cheese',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($produkData as $data) {
            Produk::create($data);
        }


        $bahanProdukData = [

            ['produk_id' => 1, 'stok_id' => 4, 'jumlah' => 0.015, 'satuan_kebutuhan' => 'kg'],
            ['produk_id' => 2, 'stok_id' => 4, 'jumlah' => 0.015, 'satuan_kebutuhan' => 'kg'], ['produk_id' => 2, 'stok_id' => 5, 'jumlah' => 0.15, 'satuan_kebutuhan' => 'liter'],
            ['produk_id' => 3, 'stok_id' => 4, 'jumlah' => 0.015, 'satuan_kebutuhan' => 'kg'], ['produk_id' => 3, 'stok_id' => 5, 'jumlah' => 0.2, 'satuan_kebutuhan' => 'liter'],
            ['produk_id' => 4, 'stok_id' => 4, 'jumlah' => 0.015, 'satuan_kebutuhan' => 'kg'],
            ['produk_id' => 5, 'stok_id' => 4, 'jumlah' => 0.015, 'satuan_kebutuhan' => 'kg'], ['produk_id' => 5, 'stok_id' => 5, 'jumlah' => 0.15, 'satuan_kebutuhan' => 'liter'], ['produk_id' => 5, 'stok_id' => 8, 'jumlah' => 0.02, 'satuan_kebutuhan' => 'kg'],
            ['produk_id' => 6, 'stok_id' => 5, 'jumlah' => 0.2, 'satuan_kebutuhan' => 'liter'], ['produk_id' => 6, 'stok_id' => 6, 'jumlah' => 0.02, 'satuan_kebutuhan' => 'kg'],
            ['produk_id' => 7, 'stok_id' => 5, 'jumlah' => 0.25, 'satuan_kebutuhan' => 'liter'], ['produk_id' => 7, 'stok_id' => 6, 'jumlah' => 0.03, 'satuan_kebutuhan' => 'kg'],
            ['produk_id' => 8, 'stok_id' => 10, 'jumlah' => 2, 'satuan_kebutuhan' => 'pcs'], ['produk_id' => 8, 'stok_id' => 5, 'jumlah' => 0.15, 'satuan_kebutuhan' => 'liter'], ['produk_id' => 8, 'stok_id' => 6, 'jumlah' => 0.03, 'satuan_kebutuhan' => 'kg'],
            ['produk_id' => 9, 'stok_id' => 5, 'jumlah' => 0.2, 'satuan_kebutuhan' => 'liter'], ['produk_id' => 9, 'stok_id' => 11, 'jumlah' => 0.05, 'satuan_kebutuhan' => 'liter'],
            ['produk_id' => 10, 'stok_id' => 6, 'jumlah' => 0.1, 'satuan_kebutuhan' => 'kg'], ['produk_id' => 10, 'stok_id' => 8, 'jumlah' => 0.05, 'satuan_kebutuhan' => 'kg'],         ];

        foreach ($bahanProdukData as $data) {
            BahanBakuProduk::create($data);
        }

        $this->command->info('✅ Database berhasil di-seed dengan data dummy!');
        $this->command->info('Total Stok: ' . Stok::count());
        $this->command->info('Total Kategori: ' . Kategori::count());
        $this->command->info('Total Produk: ' . Produk::count());
        $this->command->info('Total Bahan Baku Produk: ' . BahanBakuProduk::count());
    }
}
