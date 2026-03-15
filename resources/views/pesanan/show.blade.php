@extends('layouts.app')

@section('title', 'Detail Pesanan')
@section('subtitle', 'Pesanan ' . $pesanan->id)

@section('content')
<div class="w full">
    <div class="metal-border rounded-xl p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h3 class="text-2xl font-bold text-white">Detail Pesanan</h3>
                <p class="text-gray-400">
                    Pesanan {{ $pesanan->id }} •
                    {{ $pesanan->created_at->format('d M Y, H:i') }}
                </p>
            </div>

            <div class="flex items-center space-x-3">
                <span class="px-4 py-2 rounded-full text-sm font-medium
                    {{ $pesanan->status == 'selesai' ? 'bg-green-900 text-green-300' :
                       ($pesanan->status == 'diproses' ? 'bg-yellow-900 text-yellow-300' : 'bg-red-900 text-red-300') }}">
                    {{ ucfirst($pesanan->status) }}
                </span>

                <span class="px-4 py-2 rounded-full text-sm font-medium
                    {{ $pesanan->jenis == 'dine_in' ? 'bg-blue-900 text-blue-300' : 'bg-purple-900 text-purple-300' }}">
                    {{ $pesanan->jenis == 'dine_in' ? 'Dine In' : 'Takeaway' }}
                </span>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div>
                <h4 class="text-lg font-medium text-white mb-4">
                    Informasi Pelanggan
                </h4>

                <div class="space-y-3">
                    <div>
                        <p class="text-gray-400 text-sm">Nama Pelanggan</p>
                        <p class="text-white font-medium">
                            {{ $pesanan->nama_pelanggan }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-400 text-sm">Tanggal Pesanan</p>
                        <p class="text-white">
                            {{ $pesanan->created_at->format('d F Y, H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-medium text-white mb-4">
                    Ringkasan Pesanan
                </h4>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Jenis Pesanan</span>
                        <span class="text-white">
                            {{ $pesanan->jenis == 'dine_in' ? 'Dine In' : 'Takeaway' }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Status</span>
                        <span class="text-white">
                            {{ ucfirst($pesanan->status) }}
                        </span>
                    </div>

                    <div class="flex justify-between pt-4 border-t border-gray-800">
                        <span class="text-lg font-medium text-white">
                            Total Pembayaran
                        </span>
                        <span class="text-2xl font-bold coffee-brown">
                            Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-8">
            <h4 class="text-lg font-medium text-white mb-4">
                Daftar Menu Dipesan
            </h4>

            <div class="metal-border rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-900">
                            <th class="text-left p-4 text-gray-300">Menu</th>
                            <th class="text-left p-4 text-gray-300">Harga</th>
                            <th class="text-left p-4 text-gray-300">Jumlah</th>
                            <th class="text-left p-4 text-gray-300">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->detailPesanan as $item)
                        <tr class="border-b border-gray-800">
                            <td class="p-4 font-medium text-white">
                                {{ $item->produk->nama }}
                            </td>
                            <td class="p-4 text-gray-300">
                                Rp {{ number_format($item->produk->harga, 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-gray-300">
                                {{ $item->jumlah }}
                            </td>
                            <td class="p-4 font-medium coffee-brown">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('pesanan.index') }}"
               class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                Kembali
            </a>

            <form action="{{ route('pesanan.update-status', $pesanan->id) }}"
                  method="POST">
                @csrf
                @method('PATCH')
                <select name="status"
                        onchange="this.form.submit()"
                        class="px-6 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white">
                    <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>
                        Tandai Pending
                    </option>
                    <option value="diproses" {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>
                        Tandai Diproses
                    </option>
                    <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>
                        Tandai Selesai
                    </option>
                </select>
            </form>
        </div>

    </div>
</div>
@endsection
