@extends('layouts.app')

@section('title', 'Setting Bahan Baku Produk')

@section('content')
<div class="w full">
    <div class="metal-border rounded-xl p-8">
        <h3 class="text-2xl font-bold text-white mb-6">Bahan Baku untuk: {{ $produk->nama }}</h3>

        <form action="{{ route('menu.bahan.store', $produk->id) }}" method="POST">
            @csrf

            <div id="bahanContainer">
                @foreach($produk->bahanBaku as $index => $bahan)
                <div class="flex gap-4 mb-4 items-end">
                    <div class="flex-1">
                        <label class="block text-gray-400 mb-2">Bahan Baku</label>
                        <select name="stok_id[]" class="form-input">
                            <option value="">Pilih Bahan</option>
                            @foreach($stokList as $stok)
                            <option value="{{ $stok->id }}" {{ $bahan->stok_id == $stok->id ? 'selected' : '' }}>
                                {{ $stok->nama_barang }} ({{ $stok->satuan }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-32">
                        <label class="block text-gray-400 mb-2">Jumlah</label>
                        <input type="number" name="jumlah[]" step="0.001" class="form-input" value="{{ $bahan->jumlah }}">
                    </div>
                    <div class="w-32">
                        <label class="block text-gray-400 mb-2">Satuan</label>
                        <select name="satuan_kebutuhan[]" class="form-input">
                            <option value="gram" {{ $bahan->satuan_kebutuhan == 'gram' ? 'selected' : '' }}>gram</option>
                            <option value="ml" {{ $bahan->satuan_kebutuhan == 'ml' ? 'selected' : '' }}>ml</option>
                            <option value="pcs" {{ $bahan->satuan_kebutuhan == 'pcs' ? 'selected' : '' }}>pcs</option>
                        </select>
                    </div>
                    <button type="button" onclick="hapusBahan(this)" class="px-3 py-2 bg-red-900 text-red-300 rounded hover:bg-red-800 mb-2">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endforeach
            </div>

            <button type="button" onclick="tambahBahan()" class="mb-6 px-4 py-2 bg-gray-800 text-gray-300 rounded hover:bg-gray-700">
                <i class="fas fa-plus mr-2"></i>Tambah Bahan
            </button>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('menu.index') }}" class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Simpan Bahan Baku
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let bahanCounter = parseInt("{{ $produk->bahanBaku->count() }}");

function tambahBahan() {
    const container = document.getElementById('bahanContainer');
    const newBahan = document.createElement('div');
    newBahan.className = 'flex gap-4 mb-4 items-end';
    newBahan.innerHTML = `
        <div class="flex-1">
            <select name="stok_id[]" class="form-input">
                <option value="">Pilih Bahan</option>
                @foreach($stokList as $stok)
                <option value="{{ $stok->id }}">{{ $stok->nama_barang }} ({{ $stok->satuan }})</option>
                @endforeach
            </select>
        </div>
        <div class="w-32">
            <input type="number" name="jumlah[]" step="0.001" class="form-input" placeholder="Jumlah">
        </div>
        <div class="w-32">
            <select name="satuan_kebutuhan[]" class="form-input">
                <option value="gram">gram</option>
                <option value="ml">ml</option>
                <option value="pcs">pcs</option>
            </select>
        </div>
        <button type="button" onclick="hapusBahan(this)" class="px-3 py-2 bg-red-900 text-red-300 rounded hover:bg-red-800 mb-2">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(newBahan);
    bahanCounter++;
}

function hapusBahan(button) {
    if (bahanCounter > 1) {
        button.parentElement.remove();
        bahanCounter--;
    }
}
</script>
@endsection
