@extends('layouts.app')

@section('title', 'Buat Laporan')
@section('subtitle', 'Buat Laporan Penjualan')

@section('content')
<div class="w full">
    <div class="metal-border rounded-xl p-8">
        <h3 class="text-2xl font-bold text-white mb-6">Buat Laporan Penjualan</h3>

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-900/40 border border-red-700 rounded-lg">
                <ul class="text-red-300 text-sm list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('laporan.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">Judul Laporan</label>
                <input type="text"
                       name="judul"
                       class="form-input"
                       value="{{ old('judul') }}"
                       placeholder="Contoh: Laporan Penjualan Mingguan"
                       required>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-400 mb-2">Tanggal Mulai</label>
                    <input type="date"
                           name="tanggal_mulai"
                           class="form-input"
                           value="{{ old('tanggal_mulai') }}"
                           required>
                </div>
                <div>
                    <label class="block text-gray-400 mb-2">Tanggal Selesai</label>
                    <input type="date"
                           name="tanggal_selesai"
                           class="form-input"
                           value="{{ old('tanggal_selesai') }}"
                           required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 mb-2">Jenis Laporan</label>
                <select name="jenis_laporan" class="form-input" required>
                    <option value="">-- Pilih Jenis Laporan --</option>
                    <option value="harian" {{ old('jenis_laporan') == 'harian' ? 'selected' : '' }}>Laporan Harian</option>
                    <option value="mingguan" {{ old('jenis_laporan') == 'mingguan' ? 'selected' : '' }}>Laporan Mingguan</option>
                    <option value="bulanan" {{ old('jenis_laporan') == 'bulanan' ? 'selected' : '' }}>Laporan Bulanan</option>
                    <option value="tahunan" {{ old('jenis_laporan') == 'tahunan' ? 'selected' : '' }}>Laporan Tahunan</option>
                    <option value="custom" {{ old('jenis_laporan') == 'custom' ? 'selected' : '' }}>Periode Khusus</option>
                </select>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('laporan.index') }}"
                   class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Buat Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
