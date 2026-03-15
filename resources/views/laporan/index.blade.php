@extends('layouts.app')

@section('title', 'Laporan Penjualan')
@section('subtitle', 'Analisis Pendapatan & Penjualan')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-white">Laporan Penjualan</h2>
        <p class="text-gray-400">Analisis pendapatan dan performa penjualan</p>
    </div>
    <a href="{{ route('laporan.create') }}" class="btn-industrial">
        <i class="fas fa-chart-line mr-2"></i>Buat Laporan
    </a>
</div>

<div class="grid grid-cols-3 gap-6 mb-8">
    <div class="metal-border rounded-xl p-6">
        <div class="text-center">
            <div class="text-3xl font-bold text-coffee-brown mb-2">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </div>
            <div class="text-gray-400">Total Pendapatan</div>
        </div>
    </div>

    <div class="metal-border rounded-xl p-6">
        <div class="text-center">
            <div class="text-3xl font-bold text-green-400 mb-2">
                {{ $totalPesanan }}
            </div>
            <div class="text-gray-400">Total Pesanan</div>
        </div>
    </div>

    <div class="metal-border rounded-xl p-6">
        <div class="text-center">
            <div class="text-3xl font-bold text-blue-400 mb-2">
                @if($totalPesanan > 0)
                    Rp {{ number_format($totalPendapatan / $totalPesanan, 0, ',', '.') }}
                @else
                    Rp 0
                @endif
            </div>
            <div class="text-gray-400">Rata-rata Nilai Pesanan</div>
        </div>
    </div>
</div>

<div class="metal-border rounded-xl p-6 mb-8">
    <h3 class="text-xl font-bold text-white mb-6">Buat Laporan Baru</h3>

    <form action="{{ route('laporan.store') }}" method="POST" class="flex items-end gap-4">
        @csrf

        <div class="flex-1">
            <label class="block text-gray-400 mb-2">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-input" required>
        </div>

        <div class="flex-1">
            <label class="block text-gray-400 mb-2">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-input" required>
        </div>

        <div>
            <button type="submit"
                class="px-6 py-2 bg-coffee-brown text-white rounded-lg hover:bg-brown-600 h-[42px]">
                Proses
            </button>
        </div>
    </form>
</div>

<div class="metal-border rounded-xl overflow-hidden">

        <table class="w-full">
            <thead>
                <tr class="bg-gray-900">
                    <th class="text-left p-4 font-medium text-gray-300">Tanggal Laporan</th>
                    <th class="text-left p-4 font-medium text-gray-300">Periode</th>
                    <th class="text-left p-4 font-medium text-gray-300">Jumlah Pesanan</th>
                    <th class="text-left p-4 font-medium text-gray-300">Total Pendapatan</th>
                    <th class="text-left p-4 font-medium text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $report)
                <tr class="table-row">
                    <td class="p-4">
                        <div class="text-white font-medium">
                            {{ $report->created_at->format('d M Y') }}
                        </div>
                        <div class="text-gray-400 text-sm">
                            {{ $report->created_at->format('H:i') }}
                        </div>
                    </td>

                    <td class="p-4 text-gray-300">
                        {{ $report->tanggal }}
                    </td>

                    <td class="p-4">
                        <span class="font-bold text-white">
                            {{ $report->total_pesanan }}
                        </span>
                    </td>

                    <td class="p-4">
                        <span class="font-bold text-coffee-brown">
                            Rp {{ number_format($report->total_pendapatan, 0, ',', '.') }}
                        </span>
                    </td>

                    <td class="p-4">
                        <button class="px-3 py-1 bg-gray-800 text-gray-300 rounded hover:bg-gray-700">
                            <i class="fas fa-download"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
   
</div>
@endsection
