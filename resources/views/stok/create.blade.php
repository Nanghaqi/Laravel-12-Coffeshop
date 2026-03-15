@extends('layouts.app')

@section('title', 'Tambah Stok')
@section('subtitle', 'Tambah Item Inventori Baru')

@section('content')
<div class="w full">
    <div class="metal-border rounded-xl p-8">
        <h3 class="text-2xl font-bold text-white mb-6">Tambah Item Stok Baru</h3>

        <form action="{{ route('inventori.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-400 mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-input" required>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-400 mb-2">Stok Saat Ini</label>
                    <input type="number" name="stok_sekarang" class="form-input" required>
                </div>
                <div>
                    <label class="block text-gray-400 mb-2">Stok Minimal</label>
                    <input type="number" name="stok_minimal" class="form-input" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">Satuan</label>
                <select name="satuan" class="form-input" required>
                    <option value="">Pilih Satuan</option>
                    <option value="kg">Kilogram (kg)</option>
                    <option value="gram">Gram (g)</option>
                    <option value="liter">Liter (L)</option>
                    <option value="ml">Mililiter (ml)</option>
                    <option value="pcs">Buah / Pcs</option>
                    <option value="pack">Paket</option>
                    <option value="box">Kotak</option>
                </select>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('inventori.index') }}"
                   class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
