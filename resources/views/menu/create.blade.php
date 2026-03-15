@extends('layouts.app')

@section('title', 'Tambah Menu')
@section('subtitle', 'Tambah Produk Baru')

@section('content')
<div class="w full">
    <div class="metal-border rounded-xl p-8">
        <h3 class="text-2xl font-bold text-white mb-6">
            Tambah Menu Baru
        </h3>

        <form action="{{ route('menu.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">
                    Nama Produk
                </label>
                <input type="text"
                       name="nama"
                       class="form-input"
                       placeholder="Contoh: Cappuccino"
                       required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">
                    Kategori
                </label>
                <select name="kategori_id"
                        class="form-input"
                        required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}">
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">
                    Harga
                </label>
                <input type="number"
                       name="harga"
                       class="form-input"
                       placeholder="Contoh: 25000"
                       required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">
                    Deskripsi
                </label>
                <textarea name="deskripsi"
                          rows="3"
                          class="form-input"
                          placeholder="Deskripsi singkat menu (opsional)"></textarea>
            </div>

            <div class="mb-6">
                <label class="flex items-center space-x-2">
                    <input type="checkbox"
                           name="tersedia"
                           value="1"
                           checked
                           class="rounded border-gray-600">
                    <span class="text-gray-400">
                        Tersedia untuk dipesan
                    </span>
                </label>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('menu.index') }}"
                   class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Simpan Menu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
