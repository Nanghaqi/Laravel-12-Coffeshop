@extends('layouts.app')

@section('title', 'Edit Menu')
@section('subtitle', 'Edit Produk')

@section('content')
<div class="w-full">
    <div class="metal-border rounded-xl p-8">
        <h3 class="text-2xl font-bold text-white mb-6">
            Edit Menu: {{ $produk->nama }}
        </h3>
        <form action="{{ route('menu.update', $produk->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">
                    Nama Produk
                </label>
                <input type="text"
                       name="nama"
                       value="{{ old('nama', $produk->nama) }}"
                       class="form-input @error('nama') border-red-500 @enderror"
                       placeholder="Contoh: Cappuccino"
                       required>
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">
                    Kategori
                </label>
                <select name="kategori_id"
                        class="form-input @error('kategori_id') border-red-500 @enderror"
                        required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}"
                            {{ old('kategori_id', $produk->kategori_id) == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">
                    Harga
                </label>
                <input type="number"
                       name="harga"
                       value="{{ old('harga', $produk->harga) }}"
                       class="form-input @error('harga') border-red-500 @enderror"
                       placeholder="Contoh: 25000"
                       min="0"
                       required>
                @error('harga')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">
                    Deskripsi
                </label>
                <textarea name="deskripsi"
                          rows="3"
                          class="form-input @error('deskripsi') border-red-500 @enderror"
                          placeholder="Deskripsi singkat menu (opsional)">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center space-x-2">
                    <input type="checkbox"
                           name="tersedia"
                           value="1"
                           {{ old('tersedia', $produk->tersedia) ? 'checked' : '' }}
                           class="rounded border-gray-600">
                    <span class="text-gray-400">
                        Tersedia untuk dipesan
                    </span>
                </label>
            </div>

            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-gray-400">
                            Jumlah Bahan Baku: {{ $produk->bahanBaku->count() }}
                        </span>
                    </div>
                    <a href="{{ route('menu.bahan', $produk->id) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                        Kelola Bahan Baku
                    </a>
                </div>

                @if($produk->bahanBaku->count() > 0)
                <div class="mt-3 bg-gray-800 rounded-lg p-4">
                    <h4 class="text-gray-300 font-medium mb-2">Bahan Baku Saat Ini:</h4>
                    <ul class="space-y-1">
                        @foreach($produk->bahanBaku as $bahan)
                        <li class="text-gray-400 text-sm">
                            • {{ $bahan->stok->nama_barang ?? 'N/A' }}:
                            {{ $bahan->jumlah }} {{ $bahan->satuan_kebutuhan }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @else
                <div class="mt-3 bg-yellow-900/30 rounded-lg p-4 border border-yellow-700/50">
                    <p class="text-yellow-400 text-sm">
                        ⚠️ Menu ini belum memiliki bahan baku.
                        <a href="{{ route('menu.bahan', $produk->id) }}" class="underline">Klik di sini</a>
                        untuk menambahkan bahan baku.
                    </p>
                </div>
                @endif
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('menu.index') }}"
                   class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Update Menu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
