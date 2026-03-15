@extends('layouts.app')

@section('title', 'Manajemen Menu')
@section('subtitle', 'Katalog Kopi & Minuman')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-white">Menu Produk</h2>
        <p class="text-gray-400">Kelola menu kopi, minuman, dan makanan</p>
    </div>
    <a href="{{ route('menu.create') }}" class="btn-industrial">
        <i class="fas fa-plus mr-2"></i>Tambah Menu
    </a>
</div>

<div class="metal-border rounded-xl overflow-hidden">

        <table class="w-full">
            <thead>
                <tr class="bg-gray-900">
                    <th class="text-left p-4 font-medium text-gray-300">No</th>
                    <th class="text-left p-4 font-medium text-gray-300">Produk</th>
                    <th class="text-left p-4 font-medium text-gray-300">Kategori</th>
                    <th class="text-left p-4 font-medium text-gray-300">Harga</th>
                    <th class="text-left p-4 font-medium text-gray-300">Status</th>
                    <th class="text-left p-4 font-medium text-gray-300">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($produk as $item)
                <tr class="table-row">
                    <td class="p-4 font-mono text-gray-400">
                        {{ $loop->iteration }}
                    </td>


                    <td class="p-4">
                        <div class="font-medium text-white">
                            {{ $item->nama }}
                        </div>
                        <div class="text-sm text-gray-400 mt-1">
                            {{ Str::limit($item->deskripsi, 40) }}
                        </div>
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs bg-gray-800 text-gray-300">
                            {{ $item->kategori->nama }}
                        </span>
                    </td>

                    <td class="p-4">
                        <span class="font-bold text-coffee-brown">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    </td>

                    <td class="p-4">
                        @if($item->tersedia)
                            <span class="flex items-center text-green-400">
                                <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                Tersedia
                            </span>
                        @else
                            <span class="flex items-center text-red-400">
                                <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span>
                                Habis
                            </span>
                        @endif
                    </td>

                    <td class="p-4">
                        <a href="{{ route('menu.edit', $item->id) }}"
                           class="px-3 py-1 bg-gray-800 text-gray-300 rounded hover:bg-gray-700 mr-2"
                           title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                         <a href="{{ route('menu.bahan', $item->id) }}"
                            class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
                            title="Atur Bahan Baku">
                                <i class="fas fa-boxes"></i>
                            </a>

                        <form action="{{ route('menu.destroy', $item->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-900 text-red-300 rounded hover:bg-red-800"
                                    onclick="return confirm('Hapus menu ini?')"
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
@endsection
