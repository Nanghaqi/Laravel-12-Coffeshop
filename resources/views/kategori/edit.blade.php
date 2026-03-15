@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('subtitle', 'Perbarui Kategori')

@section('content')
<div class="w-full">
    <div class="metal-border rounded-xl p-8">
        <h3 class="text-2xl font-bold text-white mb-6">
            Edit Kategori
        </h3>

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">
                    Nama Kategori
                </label>
                <input
                    type="text"
                    name="nama"
                    class="form-input w-full"
                    value="{{ $kategori->nama }}"
                    required
                >
            </div>

            <div class="mb-6">
                <div class="p-4 bg-gray-900 rounded-lg">
                    <div class="text-white flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-400"></i>
                        <span>
                            Kategori ini sudah ditambahkan
                            <strong>{{ $kategori->produk->count() }}</strong>
                            ke produk
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('kategori.index') }}"
                   class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
