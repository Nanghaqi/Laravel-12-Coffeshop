@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('subtitle', 'Buat Kategori Baru')

@section('content')
<div class="w-full">
    <div class="metal-border rounded-xl p-8">
        <h3 class="text-2xl font-bold text-white mb-6">
            Tambah Kategori Baru
        </h3>

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">
                    Nama Kategori
                </label>
                <input
                    type="text"
                    name="nama"
                    class="form-input w-full"
                    placeholder="Masukkan nama kategori"
                    required
                >
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('kategori.index') }}"
                   class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                    Batal
                </a>

                <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
