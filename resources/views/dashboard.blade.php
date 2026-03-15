@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan Operasional & Analitik')

@section('content')
<div class="grid grid-cols-4 gap-6 mb-8">
    <div class="metal-border rounded-xl p-6 hover-glow">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-gray-900">
                <i class="fas fa-money-bill-wave text-2xl copper-accent"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-400 text-sm uppercase tracking-wider">Pendapatan Hari Ini</p>
                <p class="text-3xl font-bold text-white mt-1">
                    Rp {{ number_format($totalPendapatanHariIni, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="metal-border rounded-xl p-6 hover-glow">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-gray-900">
                <i class="fas fa-shopping-cart text-2xl copper-accent"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-400 text-sm uppercase tracking-wider">Total Pesanan</p>
                <p class="text-3xl font-bold text-white mt-1">{{ $totalPesananHariIni }}</p>
            </div>
        </div>
    </div>

    <div class="metal-border rounded-xl p-6 hover-glow">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-gray-900">
                <i class="fas fa-exclamation-triangle text-2xl copper-accent"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-400 text-sm uppercase tracking-wider">Peringatan Stok</p>
                <p class="text-3xl font-bold text-white mt-1">{{ $stokHampirHabis }}</p>
            </div>
        </div>
    </div>

    <div class="metal-border rounded-xl p-6 hover-glow">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-gray-900">
                <i class="fas fa-clock text-2xl copper-accent"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-400 text-sm uppercase tracking-wider">Pesanan Pending</p>
                <p class="text-3xl font-bold text-white mt-1">{{ $pesananPending }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-2 gap-8">
    <div class="metal-border rounded-xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-white">Pesanan Terbaru</h3>
            <span class="text-sm coffee-brown">Pembaruan Langsung</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-gray-400 border-b border-gray-800">
                        <th class="pb-3 font-medium">ID</th>
                        <th class="pb-3 font-medium">Pelanggan</th>
                        <th class="pb-3 font-medium">Status</th>
                        <th class="pb-3 font-medium">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesananTerbaru as $pesanan)
                    <tr class="table-row">
                        <td class="py-4 font-mono text-gray-300">{{ $pesanan->id }}</td>
                        <td class="py-4">
                            <div class="font-medium">{{ $pesanan->nama_pelanggan }}</div>
                            <div class="text-sm text-gray-400">{{ $pesanan->jenis }}</div>
                        </td>
                        <td class="py-4">
                            @if($pesanan->status == 'selesai')
                                <span class="status-badge bg-green-900 text-green-300">Selesai</span>
                            @elseif($pesanan->status == 'diproses')
                                <span class="status-badge bg-yellow-900 text-yellow-300">Diproses</span>
                            @else
                                <span class="status-badge bg-red-900 text-red-300">Pending</span>
                            @endif
                        </td>
                        <td class="py-4 font-medium coffee-brown">
                            Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="metal-border rounded-xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-white">Statistik Cepat</h3>
            <i class="fas fa-chart-pie text-coffee-brown"></i>
        </div>

        <div class="space-y-6">
            <div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-400">Tingkat Kunjungan</span>
                    <span class="text-white font-medium">78%</span>
                </div>
                <div class="h-2 bg-gray-800 rounded-full overflow-hidden">
                    <div class="h-full bg-coffee-brown rounded-full" style="width: 78%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-400">Kepuasan Pelanggan</span>
                    <span class="text-white font-medium">92%</span>
                </div>
                <div class="h-2 bg-gray-800 rounded-full overflow-hidden">
                    <div class="h-full bg-green-600 rounded-full" style="width: 92%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-400">Akurasi Pesanan</span>
                    <span class="text-white font-medium">96%</span>
                </div>
                <div class="h-2 bg-gray-800 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-600 rounded-full" style="width: 96%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
