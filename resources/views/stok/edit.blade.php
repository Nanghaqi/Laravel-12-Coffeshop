@extends('layouts.app')

@section('title', 'Edit Stok')
@section('subtitle', 'Perbarui Data Inventori')

@section('content')
<div class="w-full">
    <div class="metal-border rounded-xl p-8">
        <h3 class="text-2xl font-bold text-white mb-6">Edit Data Stok</h3>

        <form action="{{ route('inventori.update', $stok->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-input"
                       value="{{ $stok->nama_barang }}" required>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-400 mb-2">Stok Saat Ini</label>
                    <input type="number" name="stok_sekarang" class="form-input"
                           value="{{ $stok->stok_sekarang }}" required>
                </div>
                <div>
                    <label class="block text-gray-400 mb-2">Stok Minimal</label>
                    <input type="number" name="stok_minimal" class="form-input"
                           value="{{ $stok->stok_minimal }}" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">Satuan</label>
                <select name="satuan" class="form-input" required>
                    <option value="kg" {{ $stok->satuan == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                    <option value="gram" {{ $stok->satuan == 'gram' ? 'selected' : '' }}>Gram (g)</option>
                    <option value="liter" {{ $stok->satuan == 'liter' ? 'selected' : '' }}>Liter (L)</option>
                    <option value="ml" {{ $stok->satuan == 'ml' ? 'selected' : '' }}>Mililiter (ml)</option>
                    <option value="pcs" {{ $stok->satuan == 'pcs' ? 'selected' : '' }}>Buah / Pcs</option>
                    <option value="pack" {{ $stok->satuan == 'pack' ? 'selected' : '' }}>Paket</option>
                    <option value="box" {{ $stok->satuan == 'box' ? 'selected' : '' }}>Kotak</option>
                </select>
            </div>
            <div class="mb-8">
                <div class="p-4 bg-gray-900 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full mr-3
                            {{ $stok->stok_sekarang > $stok->stok_minimal ? 'bg-green-500' : 'bg-yellow-500' }}">
                        </div>
                        <div>
                            <p class="text-white font-medium">
                                Status Saat Ini:
                                <span class="{{ $stok->stok_sekarang > $stok->stok_minimal ? 'text-green-400' : 'text-yellow-400' }}">
                                    {{ $stok->status == 'aman' ? 'Stok Aman' : 'Stok Menipis' }}
                                </span>
                            </p>
                            <p class="text-gray-400 text-sm">
                                Status akan diperbarui otomatis berdasarkan jumlah stok
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mb-10">
                <a href="{{ route('inventori.index') }}"
                   class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Perbarui Data
                </button>
            </div>
        </form>
        <div class="border-t border-gray-800 pt-8">
            <h4 class="text-lg font-medium text-white mb-4">Restock Stok</h4>

            <form action="{{ route('inventori.restock', $stok->id) }}"
                  method="POST"
                  class="flex gap-3 items-center">
                @csrf
                @method('PATCH')

                <input type="number"
                       name="tambahan_stok"
                       class="form-input flex-1"
                       placeholder="Jumlah tambahan stok"
                       min="0"
                       step="0.01"
                       required>

                <button type="submit"
                        class="px-4 py-2 bg-green-900 text-green-300 rounded-lg hover:bg-green-800">
                    Tambah Stok
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
