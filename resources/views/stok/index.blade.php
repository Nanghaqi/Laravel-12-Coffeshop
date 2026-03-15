@extends('layouts.app')

@section('title', 'Manajemen Inventori')
@section('subtitle', 'Kontrol & Pemantauan Stok')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-white">Stok Inventori</h2>
        <p class="text-gray-400">Pantau dan kelola bahan baku</p>
    </div>
    <a href="{{ route('inventori.create') }}" class="btn-industrial">
        <i class="fas fa-plus mr-2"></i>Tambah Stok
    </a>
</div>

<div class="grid grid-cols-4 gap-4 mb-8">
    <div class="metal-border rounded-xl p-4">
        <div class="text-center">
            <div class="text-3xl font-bold text-green-400 mb-1">{{ $stok->where('status', 'aman')->count() }}</div>
            <div class="text-gray-400 text-sm">Stok Aman</div>
        </div>
    </div>
    <div class="metal-border rounded-xl p-4">
        <div class="text-center">
            <div class="text-3xl font-bold text-yellow-400 mb-1">{{ $stok->where('status', 'hampir habis')->count() }}</div>
            <div class="text-gray-400 text-sm">Stok Menipis</div>
        </div>
    </div>
    <div class="metal-border rounded-xl p-4">
        <div class="text-center">
            <div class="text-3xl font-bold text-red-400 mb-1">{{ $stok->where('stok_sekarang', 0)->count() }}</div>
            <div class="text-gray-400 text-sm">Stok Habis</div>
        </div>
    </div>
    <div class="metal-border rounded-xl p-4">
        <div class="text-center">
            <div class="text-3xl font-bold text-white mb-1">{{ $stok->count() }}</div>
            <div class="text-gray-400 text-sm">Total Item</div>
        </div>
    </div>
</div>

<div class="metal-border rounded-xl overflow-hidden mb-6">
    <div class="bg-gray-900 p-4 border-b border-gray-800">
        <h3 class="text-lg font-medium text-white">Peringatan Stok</h3>
    </div>
    <div class="p-4">
        @php
        $lowStock = $stok->where('status', 'hampir habis');
        @endphp
        @if($lowStock->count() > 0)
        <div class="space-y-2">
            @foreach($lowStock as $item)
            <div class="flex justify-between items-center p-3 bg-yellow-900 bg-opacity-30 rounded-lg">
                <div>
                    <div class="font-medium text-white">{{ $item->nama_barang }}</div>
                    <div class="text-sm text-gray-400">
                        Stok Saat Ini: {{ $item->stok_sekarang }} {{ $item->satuan }}
                        • Minimal: {{ $item->stok_minimal }} {{ $item->satuan }}
                    </div>
                </div>
                <a href="{{ route('inventori.edit', $item->id) }}"
                   class="px-3 py-1 bg-yellow-800 text-yellow-300 rounded text-sm hover:bg-yellow-700">
                    Tambah Stok
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-6 text-gray-400">
            <i class="fas fa-check-circle text-2xl mb-2 text-green-400"></i>
            <p>Semua stok dalam kondisi aman</p>
        </div>
        @endif
    </div>
</div>

<div class="metal-border rounded-xl overflow-hidden">

        <table class="w-full">
            <thead>
                <tr class="bg-gray-900">
                    <th class="text-left p-4 font-medium text-gray-300">Nama Barang</th>
                    <th class="text-left p-4 font-medium text-gray-300">Stok Saat Ini</th>
                    <th class="text-left p-4 font-medium text-gray-300">Stok Minimal</th>
                    <th class="text-left p-4 font-medium text-gray-300">Satuan</th>
                    <th class="text-left p-4 font-medium text-gray-300">Status</th>
                    <th class="text-left p-4 font-medium text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stok as $item)
                <tr class="table-row">
                    <td class="p-4">
                        <div class="font-medium text-white">{{ $item->nama_barang }}</div>
                    </td>
                    <td class="p-4">
                        <span class="font-bold text-xl
                            {{ $item->stok_sekarang <= $item->stok_minimal ? 'text-yellow-400' : 'text-green-400' }}">
                            {{ $item->stok_sekarang }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-300">{{ $item->stok_minimal }}</td>
                    <td class="p-4 text-gray-300">{{ $item->satuan }}</td>
                    <td class="p-4">
                        @if($item->status == 'aman')
                        <span class="flex items-center">
                            <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                            <span class="text-green-400">Aman</span>
                        </span>
                        @else
                        <span class="flex items-center">
                            <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span>
                            <span class="text-yellow-400">Menipis</span>
                        </span>
                        @endif
                    </td>
                    <td class="p-4">
                        <a href="{{ route('inventori.edit', $item->id) }}"
                           class="px-3 py-1 bg-gray-800 text-gray-300 rounded hover:bg-gray-700 mr-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('inventori.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-900 text-red-300 rounded hover:bg-red-800"
                                    onclick="return confirm('Hapus data stok ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
   
</div>
@endsection
