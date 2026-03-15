@extends('layouts.app')

@section('title', 'Manajemen Pesanan')
@section('subtitle', 'Kelola & Pantau Pesanan Pelanggan')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-white">Pesanan Pelanggan</h2>
        <p class="text-gray-400">Kelola pesanan dine-in dan takeaway</p>
    </div>
    <a href="{{ route('pesanan.create') }}" class="btn-industrial">
        <i class="fas fa-plus mr-2"></i>Pesanan Baru
    </a>
</div>

{{-- Ringkasan Status --}}
<div class="grid grid-cols-4 gap-4 mb-6">
    <div class="metal-border rounded-xl p-4 text-center">
        <div class="text-3xl font-bold text-red-400 mb-1">
            {{ $pesanan->where('status', 'pending')->count() }}
        </div>
        <div class="text-gray-400 text-sm">Pending</div>
    </div>

    <div class="metal-border rounded-xl p-4 text-center">
        <div class="text-3xl font-bold text-yellow-400 mb-1">
            {{ $pesanan->where('status', 'diproses')->count() }}
        </div>
        <div class="text-gray-400 text-sm">Diproses</div>
    </div>

    <div class="metal-border rounded-xl p-4 text-center">
        <div class="text-3xl font-bold text-green-400 mb-1">
            {{ $pesanan->where('status', 'selesai')->count() }}
        </div>
        <div class="text-gray-400 text-sm">Selesai</div>
    </div>

    <div class="metal-border rounded-xl p-4 text-center">
        <div class="text-3xl font-bold text-white mb-1">
            {{ $pesanan->count() }}
        </div>
        <div class="text-gray-400 text-sm">Total Pesanan</div>
    </div>
</div>
<div class="metal-border rounded-xl overflow-hidden">

        <table class="w-full">
            <thead>
                <tr class="bg-gray-900">
                    <th class="text-left p-4 text-gray-300">No</th>
                    <th class="text-left p-4 text-gray-300">Pelanggan</th>
                    <th class="text-left p-4 text-gray-300">Jenis</th>
                    <th class="text-left p-4 text-gray-300">Status</th>
                    <th class="text-left p-4 text-gray-300">Total</th>
                    <th class="text-left p-4 text-gray-300">Tanggal</th>
                    <th class="text-left p-4 text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan as $order)
                <tr class="table-row">
                    <td class="p-4 font-mono text-gray-400">
                        {{ $loop->iteration }}
                    </td>
                    <td class="p-4 font-medium text-white">
                        {{ $order->nama_pelanggan }}
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs
                            {{ $order->jenis == 'dine_in'
                                ? 'bg-blue-900 text-blue-300'
                                : 'bg-purple-900 text-purple-300' }}">
                            {{ $order->jenis == 'dine_in' ? 'Dine In' : 'Takeaway' }}
                        </span>
                    </td>

                    <td class="p-4">
                        <form action="{{ route('pesanan.update-status', $order->id) }}"
                              method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="bg-gray-800 border border-gray-700 rounded px-3 py-1 text-sm
                                    {{ $order->status == 'selesai' ? 'text-green-400' :
                                       ($order->status == 'diproses' ? 'text-yellow-400' : 'text-red-400') }}">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                        </form>
                    </td>

                    <td class="p-4 font-bold text-coffee-brown">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </td>

                    <td class="p-4 text-gray-400 text-sm">
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td class="p-4">
                        <a href="{{ route('pesanan.show', $order->id) }}"
                           class="px-3 py-1 bg-gray-800 text-gray-300 rounded hover:bg-gray-700 mr-2">
                            <i class="fas fa-eye"></i>
                        </a>

                        <form action="{{ route('pesanan.destroy', $order->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-900 text-red-300 rounded hover:bg-red-800"
                                    onclick="return confirm('Hapus pesanan ini?')">
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
