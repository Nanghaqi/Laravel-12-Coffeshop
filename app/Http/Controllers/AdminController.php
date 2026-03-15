<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Stok;
use App\Models\Laporan;
use App\Models\Kategori;
use App\Models\BahanBakuProduk;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPendapatanHariIni = Pesanan::whereDate('created_at', today())->sum('total_harga');
        $totalPesananHariIni = Pesanan::whereDate('created_at', today())->count();
        $stokHampirHabis = Stok::whereRaw('stok_sekarang <= stok_minimal')->count();
        $pesananPending = Pesanan::where('status', 'pending')->count();

        $pesananTerbaru = Pesanan::with('detailPesanan.produk')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPendapatanHariIni',
            'totalPesananHariIni',
            'stokHampirHabis',
            'pesananPending',
            'pesananTerbaru'
        ));
    }

    public function menu()
    {
        $produk = Produk::with('kategori')->get();
        $kategori = Kategori::all();
        return view('menu.index', compact('produk', 'kategori'));
    }

    public function createMenu()
    {
        $kategori = Kategori::all();
        return view('menu.create', compact('kategori'));
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required|numeric',
        ]);

        Produk::create($request->all());
        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan');
    }

    public function editMenu($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('menu.edit', compact('produk', 'kategori'));
    }

    public function updateMenu(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required|numeric',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui');
    }

    public function destroyMenu($id)
    {
        Produk::find($id)->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus');
    }

    public function pesanan()
    {
        $pesanan = Pesanan::with('detailPesanan.produk')->latest()->get();
        return view('pesanan.index', compact('pesanan'));
    }

    public function createPesanan()
    {
        $produk = Produk::where('tersedia', true)->get();
        return view('pesanan.create', compact('produk'));
    }

    public function storePesanan(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'jenis' => 'required',
            'produk_id' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;
            $detailPesanan = [];
            $totalJumlahPesanan = array_sum($request->jumlah);
            if (!$this->cekStokPackaging($totalJumlahPesanan)) {
                DB::rollBack();
                return back()->with('error', 'Stok packaging (cup/sedotan/tutup) tidak cukup!')->withInput();
            }
            foreach ($request->produk_id as $index => $produkId) {
                $jumlah = $request->jumlah[$index];

                if (!$this->cekStokCukup($produkId, $jumlah)) {
                    $produk = Produk::find($produkId);
                    DB::rollBack();
                    return back()->with('error', 'Stok bahan baku tidak cukup untuk ' . $produk->nama)->withInput();
                }
            }
            foreach ($request->produk_id as $index => $produkId) {
                $jumlah = $request->jumlah[$index];
                $this->kurangiStokBahanBaku($produkId, $jumlah);
                $produk = Produk::find($produkId);
                $subtotal = $produk->harga * $jumlah;
                $total += $subtotal;

                $detailPesanan[] = [
                    'produk_id' => $produkId,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ];
            }
            $this->kurangiStokPackaging($totalJumlahPesanan);
            $pesanan = Pesanan::create([
                'nama_pelanggan' => $request->nama_pelanggan,
                'jenis' => $request->jenis,
                'status' => 'pending',
                'total_harga' => $total,
            ]);
            foreach ($detailPesanan as $detail) {
                $pesanan->detailPesanan()->create($detail);
            }

            DB::commit();

            Log::info('Pesanan berhasil dibuat: ' . $pesanan->id .
                    ' untuk ' . $request->nama_pelanggan .
                    ' total: Rp ' . number_format($total, 0, ',', '.'));

            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error membuat pesanan: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage())->withInput();
        }
    }
    private function cekStokCukup($produkId, $jumlah)
    {
        $bahanBakuList = BahanBakuProduk::where('produk_id', $produkId)
            ->where('jumlah', '>', 0)
            ->with('stok')
            ->get();

        $produk = Produk::find($produkId);
        Log::info('Cek stok untuk: ' . $produk->nama . ' (Jumlah: ' . $jumlah . ')');

        foreach ($bahanBakuList as $bahan) {
            $stok = $bahan->stok;
            if (!$stok) {
                Log::error('Stok tidak ditemukan untuk bahan ID: ' . $bahan->stok_id);
                return false;
            }

            $butuh = $bahan->jumlah * $jumlah;
            $butuhKonversi = $this->konversiSatuan($butuh, $bahan->satuan_kebutuhan, $stok->satuan);

            Log::info('Bahan: ' . $stok->nama_barang .
                    ', Butuh: ' . $butuhKonversi . ' ' . $stok->satuan .
                    ', Tersedia: ' . $stok->stok_sekarang . ' ' . $stok->satuan);

            if ($stok->stok_sekarang < $butuhKonversi) {
                Log::warning('Stok bahan tidak cukup: ' . $stok->nama_barang);
                return false;
            }
        }

        return true;
    }

    private function kurangiStokBahanBaku($produkId, $jumlahPesanan)
    {
        $bahanBakuList = BahanBakuProduk::where('produk_id', $produkId)
            ->where('jumlah', '>', 0)
            ->with('stok')
            ->get();

        foreach ($bahanBakuList as $bahan) {
            $stok = $bahan->stok;
            if (!$stok) continue;

            $butuh = $bahan->jumlah * $jumlahPesanan;
            $butuhKonversi = $this->konversiSatuan($butuh, $bahan->satuan_kebutuhan, $stok->satuan);

            $stokLama = $stok->stok_sekarang;
            $stok->stok_sekarang -= $butuhKonversi;

            if ($stok->stok_sekarang <= $stok->stok_minimal) {
                $stok->status = 'hampir habis';
                Log::warning('Stok hampir habis: ' . $stok->nama_barang);
            }

            if ($stok->stok_sekarang < 0) {
                $stok->stok_sekarang = 0;
                Log::error('Stok menjadi 0 untuk: ' . $stok->nama_barang);
            }

            $stok->save();

            Log::info('Kurangi stok: ' . $stok->nama_barang .
                    ' -' . $butuhKonversi . ' ' . $stok->satuan .
                    ' (Dari: ' . $stokLama . ' → Ke: ' . $stok->stok_sekarang . ')');
        }
    }
    private function cekStokPackaging($jumlahPesanan)
    {
        $cup = Stok::where('nama_barang', 'like', '%cup%')->first();
        $sedotan = Stok::where('nama_barang', 'like', '%sedotan%')->first();
        $tutup = Stok::where('nama_barang', 'like', '%tutup%')->first();

        $errors = [];

        if (!$cup) $errors[] = 'Cup Paper tidak ditemukan';
        if (!$sedotan) $errors[] = 'Sedotan tidak ditemukan';
        if (!$tutup) $errors[] = 'Tutup Cup tidak ditemukan';

        if (!empty($errors)) {
            Log::error('Packaging error: ' . implode(', ', $errors));
            return false;
        }

        if ($cup->stok_sekarang < $jumlahPesanan) {
            Log::warning('Cup tidak cukup: butuh ' . $jumlahPesanan . ', ada ' . $cup->stok_sekarang);
            return false;
        }

        if ($sedotan->stok_sekarang < $jumlahPesanan) {
            Log::warning('Sedotan tidak cukup: butuh ' . $jumlahPesanan . ', ada ' . $sedotan->stok_sekarang);
            return false;
        }

        if ($tutup->stok_sekarang < $jumlahPesanan) {
            Log::warning('Tutup tidak cukup: butuh ' . $jumlahPesanan . ', ada ' . $tutup->stok_sekarang);
            return false;
        }

        return true;
    }

    private function kurangiStokPackaging($jumlahPesanan)
    {
        $cup = Stok::where('nama_barang', 'like', '%cup%')->first();
        $sedotan = Stok::where('nama_barang', 'like', '%sedotan%')->first();
        $tutup = Stok::where('nama_barang', 'like', '%tutup%')->first();

        if ($cup) {
            $cup->stok_sekarang -= $jumlahPesanan;
            if ($cup->stok_sekarang <= $cup->stok_minimal) $cup->status = 'hampir habis';
            $cup->save();
        }

        if ($sedotan) {
            $sedotan->stok_sekarang -= $jumlahPesanan;
            if ($sedotan->stok_sekarang <= $sedotan->stok_minimal) $sedotan->status = 'hampir habis';
            $sedotan->save();
        }

        if ($tutup) {
            $tutup->stok_sekarang -= $jumlahPesanan;
            if ($tutup->stok_sekarang <= $tutup->stok_minimal) $tutup->status = 'hampir habis';
            $tutup->save();
        }

        Log::info('Packaging dikurangi: Cup -' . $jumlahPesanan . ', Sedotan -' . $jumlahPesanan . ', Tutup -' . $jumlahPesanan);
    }
    private function konversiSatuan($jumlah, $dariSatuan, $keSatuan)
    {
        if ($dariSatuan === $keSatuan) {
            return $jumlah;
        }

        if ($dariSatuan === 'gram' && $keSatuan === 'kg') {
            return $jumlah / 1000;
        }
        if ($dariSatuan === 'kg' && $keSatuan === 'gram') {
            return $jumlah * 1000;
        }
        if ($dariSatuan === 'ml' && $keSatuan === 'liter') {
            return $jumlah / 1000;
        }
        if ($dariSatuan === 'liter' && $keSatuan === 'ml') {
            return $jumlah * 1000;
        }

        return $jumlah;
    }

    public function bahanMenu($id)
    {
        $produk = Produk::findOrFail($id);
        $stokList = Stok::all();
        return view('menu.bahan', compact('produk', 'stokList'));
    }

    public function storeBahanMenu(Request $request, $id)
    {
        BahanBakuProduk::where('produk_id', $id)->delete();

        foreach ($request->stok_id as $index => $stokId) {
            if ($stokId && $request->jumlah[$index]) {
                BahanBakuProduk::create([
                    'produk_id' => $id,
                    'stok_id' => $stokId,
                    'jumlah' => $request->jumlah[$index],
                    'satuan_kebutuhan' => $request->satuan_kebutuhan[$index],
                ]);
            }
        }

        return redirect()->route('menu.index')->with('success', 'Bahan baku berhasil disimpan');
    }

    public function restockStok(Request $request, $id)
    {
        $request->validate([
            'tambahan_stok' => 'required|numeric|min:0',
        ]);

        $stok = Stok::findOrFail($id);
        $stok->stok_sekarang += $request->tambahan_stok;

        if ($stok->stok_sekarang > $stok->stok_minimal) {
            $stok->status = 'aman';
        }

        $stok->save();
        return redirect()->route('inventori.index')->with('success', 'Stok berhasil ditambahkan');
    }

    public function showPesanan($id)
    {
        $pesanan = Pesanan::with('detailPesanan.produk')->findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }

    public function updateStatusPesanan(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => $request->status]);
        return redirect()->route('pesanan.index')->with('success', 'Status pesanan diperbarui');
    }

    public function destroyPesanan($id)
    {
        Pesanan::destroy($id);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus');
    }

    public function inventori()
    {
        $stok = Stok::all();
        return view('stok.index', compact('stok'));
    }

    public function createStok()
    {
        return view('stok.create');
    }

    public function storeStok(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok_sekarang' => 'required|integer',
            'stok_minimal' => 'required|integer',
            'satuan' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = $request->stok_sekarang <= $request->stok_minimal ? 'hampir habis' : 'aman';

        Stok::create($data);
        return redirect()->route('inventori.index')->with('success', 'Stok berhasil ditambahkan');
    }
    public function editStok($id)
    {
        $stok = Stok::findOrFail($id);
        return view('stok.edit', compact('stok'));
    }
    public function updateStok(Request $request, $id)
    {
        $stok = Stok::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required',
            'stok_sekarang' => 'required|integer',
            'stok_minimal' => 'required|integer',
            'satuan' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = $request->stok_sekarang <= $request->stok_minimal ? 'hampir habis' : 'aman';

        $stok->update($data);
        return redirect()->route('inventori.index')->with('success', 'Stok berhasil diperbarui');
    }
    public function destroyStok($id)
    {
        Stok::destroy($id);
        return redirect()->route('inventori.index')->with('success', 'Stok berhasil dihapus');
    }

    public function laporan()
    {
        $laporan = Laporan::orderBy('tanggal', 'desc')->get();
        $totalPendapatan = $laporan->sum('total_pendapatan');
        $totalPesanan = $laporan->sum('total_pesanan');
        return view('laporan.index', compact('laporan', 'totalPendapatan', 'totalPesanan'));
    }

    public function createLaporan()
    {
        return view('laporan.create');
    }

    public function storeLaporan(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pesanan = Pesanan::whereBetween('tanggal_pesanan', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->get();

        $totalPendapatan = $pesanan->sum('total_harga');
        $totalPesanan = $pesanan->count();

        Laporan::create([
            'tanggal' => now(),
            'total_pesanan' => $totalPesanan,
            'total_pendapatan' => $totalPendapatan,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil digenerate');
    }

    public function kategori()
    {
        $kategori = Kategori::withCount('produk')->get();
        return view('kategori.index', compact('kategori'));
    }

    public function createKategori()
    {
        return view('kategori.create');
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kategori',
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }
    public function editKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }
    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:kategori,nama,' . $id,
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }
    public function destroyKategori($id)
    {
        $kategori = Kategori::findOrFail($id);

        if ($kategori->produk()->count() > 0) {
            return redirect()->route('kategori.index')->with('error', 'Tidak bisa menghapus kategori yang memiliki produk');
        }

        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
