@extends('layouts.app')

@section('title', 'Manajemen Kategori')
@section('subtitle', 'Kategori Produk')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-white">Kategori Produk</h2>
        <p class="text-gray-400">Kelola kategori produk</p>
    </div>
    <a href="{{ route('kategori.create') }}" class="btn-industrial">
        <i class="fas fa-plus mr-2"></i>Tambah Kategori
    </a>
</div>

<div class="metal-border rounded-xl overflow-hidden">
   
        <table class="w-full">
            <thead>
                <tr class="bg-gray-900">
                    <th class="text-left p-4 font-medium text-gray-300">ID</th>
                    <th class="text-left p-4 font-medium text-gray-300">Nama Kategori</th>
                    <th class="text-left p-4 font-medium text-gray-300">Jumlah Produk</th>
                    <th class="text-left p-4 font-medium text-gray-300">Tanggal Dibuat</th>
                    <th class="text-left p-4 font-medium text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $item)
                <tr class="table-row">
                    <td class="p-4 font-mono text-gray-400">{{ $item->id }}</td>
                    <td class="p-4">
                        <div class="font-medium text-white">{{ $item->nama }}</div>
                    </td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs bg-gray-800 text-gray-300">
                            {{ $item->produk->count() }} produk
                        </span>
                    </td>
                    <td class="p-4 text-gray-400">
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                    <td class="p-4">
                        <a href="{{ route('kategori.edit', $item->id) }}"
                           class="px-3 py-1 bg-gray-800 text-gray-300 rounded hover:bg-gray-700 mr-2"
                           title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-900 text-red-300 rounded hover:bg-red-800"
                                    onclick="return confirm('Hapus kategori ini?')"
                                    title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
