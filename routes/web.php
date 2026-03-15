<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::prefix('menu')->group(function () {
    Route::get('/', [AdminController::class, 'menu'])->name('menu.index');
    Route::get('/create', [AdminController::class, 'createMenu'])->name('menu.create');
    Route::post('/', [AdminController::class, 'storeMenu'])->name('menu.store');
    Route::get('/{id}/edit', [AdminController::class, 'editMenu'])->name('menu.edit');
    Route::put('/{id}', [AdminController::class, 'updateMenu'])->name('menu.update');
    Route::delete('/{id}', [AdminController::class, 'destroyMenu'])->name('menu.destroy');
    Route::get('/menu/{id}/bahan', [AdminController::class, 'bahanMenu'])->name('menu.bahan');
    Route::post('/menu/{id}/bahan', [AdminController::class, 'storeBahanMenu'])->name('menu.bahan.store');
});
Route::prefix('pesanan')->group(function () {
    Route::get('/', [AdminController::class, 'pesanan'])->name('pesanan.index');
    Route::get('/create', [AdminController::class, 'createPesanan'])->name('pesanan.create');
    Route::post('/', [AdminController::class, 'storePesanan'])->name('pesanan.store');
    Route::get('/{id}', [AdminController::class, 'showPesanan'])->name('pesanan.show');
    Route::patch('/{id}/status', [AdminController::class, 'updateStatusPesanan'])->name('pesanan.update-status');
    Route::delete('/{id}', [AdminController::class, 'destroyPesanan'])->name('pesanan.destroy');
});
Route::prefix('inventori')->group(function () {
    Route::get('/', [AdminController::class, 'inventori'])->name('inventori.index');
    Route::get('/create', [AdminController::class, 'createStok'])->name('inventori.create');
    Route::post('/', [AdminController::class, 'storeStok'])->name('inventori.store');
    Route::get('/{id}/edit', [AdminController::class, 'editStok'])->name('inventori.edit');
    Route::put('/{id}', [AdminController::class, 'updateStok'])->name('inventori.update');
    Route::delete('/{id}', [AdminController::class, 'destroyStok'])->name('inventori.destroy');
    Route::patch('/{id}/restock', [AdminController::class, 'restockStok'])->name('inventori.restock');
});
Route::prefix('laporan')->group(function () {
    Route::get('/', [AdminController::class, 'laporan'])->name('laporan.index');
    Route::post('/generate', [AdminController::class, 'generateLaporan'])->name('laporan.generate');
    Route::get('/create', [AdminController::class, 'createLaporan'])->name('laporan.create');
    Route::post('/', [AdminController::class, 'storeLaporan'])->name('laporan.store');
});
Route::prefix('kategori')->group(function () {
    Route::get('/', [AdminController::class, 'kategori'])->name('kategori.index');
    Route::get('/create', [AdminController::class, 'createKategori'])->name('kategori.create');
    Route::post('/', [AdminController::class, 'storeKategori'])->name('kategori.store');
    Route::get('/{id}/edit', [AdminController::class, 'editKategori'])->name('kategori.edit');
    Route::put('/{id}', [AdminController::class, 'updateKategori'])->name('kategori.update');
    Route::delete('/{id}', [AdminController::class, 'destroyKategori'])->name('kategori.destroy');
});
Route::get('/setup-initial-data', function() {
    $packagingData = [
        [
            'nama_barang' => 'Cup Paper',
            'stok_sekarang' => 500,
            'stok_minimal' => 100,
            'satuan' => 'pcs',
            'status' => 'aman'
        ],
        [
            'nama_barang' => 'Sedotan',
            'stok_sekarang' => 1000,
            'stok_minimal' => 200,
            'satuan' => 'pcs',
            'status' => 'aman'
        ],
        [
            'nama_barang' => 'Tutup Cup',
            'stok_sekarang' => 500,
            'stok_minimal' => 100,
            'satuan' => 'pcs',
            'status' => 'aman'
        ]
    ];

    foreach ($packagingData as $data) {
        $stok = \App\Models\Stok::firstOrCreate(
            ['nama_barang' => $data['nama_barang']],
            $data
        );
        echo "Created: " . $data['nama_barang'] . " (ID: " . $stok->id . ")<br>";
    }

    echo "<br> Packaging data berhasil dibuat!";
});
Route::get('/setup-bahan-baku', function() {
    $bahanBakuData = [
        [
            'nama_barang' => 'Kopi Bubuk',
            'stok_sekarang' => 5,
            'stok_minimal' => 1,
            'satuan' => 'kg',
            'status' => 'aman'
        ],
        [
            'nama_barang' => 'Susu Cair',
            'stok_sekarang' => 10,
            'stok_minimal' => 2,
            'satuan' => 'liter',
            'status' => 'aman'
        ],
        [
            'nama_barang' => 'Gula Pasir',
            'stok_sekarang' => 20,
            'stok_minimal' => 5,
            'satuan' => 'kg',
            'status' => 'aman'
        ],
        [
            'nama_barang' => 'Es Batu',
            'stok_sekarang' => 50,
            'stok_minimal' => 10,
            'satuan' => 'kg',
            'status' => 'aman'
        ],
        [
            'nama_barang' => 'Coklat Bubuk',
            'stok_sekarang' => 3,
            'stok_minimal' => 1,
            'satuan' => 'kg',
            'status' => 'aman'
        ],
        [
            'nama_barang' => 'Vanilla Syrup',
            'stok_sekarang' => 5,
            'stok_minimal' => 1,
            'satuan' => 'liter',
            'status' => 'aman'
        ]
    ];

    foreach ($bahanBakuData as $data) {
        $stok = \App\Models\Stok::firstOrCreate(
            ['nama_barang' => $data['nama_barang']],
            $data
        );
        echo "Created: " . $data['nama_barang'] . " (ID: " . $stok->id . ")<br>";
    }

    echo "<br> Bahan baku berhasil dibuat!";
});
Route::get('/setup-kategori', function() {
    $kategoriData = [
        ['nama' => 'Kopi'],
        ['nama' => 'Non-Kopi'],
        ['nama' => 'Tea'],
        ['nama' => 'Snack'],
        ['nama' => 'Dessert']
    ];

    foreach ($kategoriData as $data) {
        $kategori = \App\Models\Kategori::firstOrCreate($data);
        echo "Created: " . $data['nama'] . " (ID: " . $kategori->id . ")<br>";
    }

    echo "<br> Kategori berhasil dibuat!";
});
Route::get('/setup-produk', function() {
    $produkData = [
        [
            'nama' => 'Espresso',
            'kategori_id' => 1,
            'harga' => 15000,
            'deskripsi' => 'Kopi espresso murni',
            'tersedia' => true
        ],
        [
            'nama' => 'Cappuccino',
            'kategori_id' => 1,
            'harga' => 20000,
            'deskripsi' => 'Espresso dengan susu steamed',
            'tersedia' => true
        ],
        [
            'nama' => 'Latte',
            'kategori_id' => 1,
            'harga' => 22000,
            'deskripsi' => 'Espresso dengan banyak susu',
            'tersedia' => true
        ],
        [
            'nama' => 'Americano',
            'kategori_id' => 1,
            'harga' => 18000,
            'deskripsi' => 'Espresso dengan air panas',
            'tersedia' => true
        ],
        [
            'nama' => 'Milo Dinosaur',
            'kategori_id' => 2,
            'harga' => 18000,
            'deskripsi' => 'Milo dengan extra bubuk milo',
            'tersedia' => true
        ]
    ];

    foreach ($produkData as $data) {
        $produk = \App\Models\Produk::firstOrCreate(
            ['nama' => $data['nama']],
            $data
        );
        echo "Created: " . $data['nama'] . " (ID: " . $produk->id . ")<br>";
    }

    echo "<br> Produk berhasil dibuat!";
});
Route::get('/setup-bahan-baku-produk', function() {
    \App\Models\BahanBakuProduk::truncate();
    $bahanProdukData = [
        [
            'produk_id' => 1,
            'stok_id' => 1,
            'jumlah' => 0.015,
            'satuan_kebutuhan' => 'kg'
        ],
        [
            'produk_id' => 1,
            'stok_id' => 2,
            'jumlah' => 0,
            'satuan_kebutuhan' => 'liter'
        ],
        [
            'produk_id' => 2,
            'stok_id' => 1,
            'jumlah' => 0.015,
            'satuan_kebutuhan' => 'kg'
        ],
        [
            'produk_id' => 2,
            'stok_id' => 2,
            'jumlah' => 0.15,
            'satuan_kebutuhan' => 'liter'
        ],
        [
            'produk_id' => 3,
            'stok_id' => 1,
            'jumlah' => 0.015, 
            'satuan_kebutuhan' => 'kg'
        ],
        [
            'produk_id' => 3,
            'stok_id' => 2,
            'jumlah' => 0.2, 
            'satuan_kebutuhan' => 'liter'
        ],
        [
            'produk_id' => 4,
            'stok_id' => 1,
            'jumlah' => 0.015, 
            'satuan_kebutuhan' => 'kg'
        ],
        [
            'produk_id' => 5,
            'stok_id' => 3,
            'jumlah' => 0.02, 
            'satuan_kebutuhan' => 'kg'
        ],
        [
            'produk_id' => 5,
            'stok_id' => 2,
            'jumlah' => 0.2, 
            'satuan_kebutuhan' => 'liter'
        ]
    ];

    foreach ($bahanProdukData as $data) {
        if ($data['jumlah'] > 0) {
            \App\Models\BahanBakuProduk::create($data);
        }
    }

    echo "✅ Bahan baku produk berhasil dihubungkan!<br><br>";

    $produk = \App\Models\Produk::with('bahanBaku.stok')->get();

    foreach ($produk as $p) {
        echo "<strong>" . $p->nama . "</strong><br>";
        foreach ($p->bahanBaku as $bahan) {
            echo "- " . $bahan->stok->nama_barang . ": " . $bahan->jumlah . " " . $bahan->satuan_kebutuhan . "<br>";
        }
        echo "<br>";
    }
});


