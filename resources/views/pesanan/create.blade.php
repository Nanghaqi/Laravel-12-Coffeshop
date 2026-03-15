@extends('layouts.app')

@section('title', 'Buat Pesanan Baru')
@section('subtitle', 'Input Pesanan Pelanggan')

@section('content')
<div class="w full">
    <div class="metal-border rounded-xl p-8">
        <h3 class="text-2xl font-bold text-white mb-6">
            Buat Pesanan Baru
        </h3>

        <form action="{{ route('pesanan.store') }}" method="POST" id="orderForm">
            @csrf

            {{-- Data Pelanggan --}}
            <div class="grid grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-gray-400 mb-2">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-input" required>
                </div>
                <div>
                    <label class="block text-gray-400 mb-2">Jenis Pesanan</label>
                    <select name="jenis" class="form-input">
                        <option value="dine_in">Dine In</option>
                        <option value="takeaway">Takeaway</option>
                    </select>
                </div>
            </div>

            {{-- Item Pesanan --}}
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-medium text-white">
                        Daftar Menu
                    </h4>
                    <button type="button"
                            onclick="addOrderItem()"
                            class="text-sm coffee-brown hover:underline">
                        <i class="fas fa-plus mr-1"></i>Tambah Item
                    </button>
                </div>

                <div id="orderItems" class="space-y-3">
                    <div class="flex gap-3 items-center">
                        <div class="flex-1">
                            <select name="produk_id[]" class="form-input product-select" onchange="calculateSubtotal(this.closest('.flex'))">
                                <option value="">Pilih Menu</option>
                                @foreach($produk as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->harga }}">
                                    {{ $product->nama }} — Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-28">
                            <input type="number"
                                   name="jumlah[]"
                                   min="1"
                                   value="1"
                                   class="form-input quantity"
                                   onchange="calculateSubtotal(this.closest('.flex'))">
                        </div>

                        <div class="w-40">
                            <input type="text"
                                   class="form-input subtotal"
                                   placeholder="Subtotal"
                                   readonly>
                        </div>

                        <button type="button"
                                onclick="removeOrderItem(this)"
                                class="px-3 py-2 bg-red-900 text-red-300 rounded hover:bg-red-800"
                                disabled>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Total --}}
            <div class="border-t border-gray-800 pt-6 mb-6">
                <div class="flex justify-between items-center">
                    <div class="text-lg font-medium text-gray-300">
                        Total Pembayaran
                    </div>
                    <div class="text-2xl font-bold coffee-brown" id="totalAmount">
                        Rp 0
                    </div>
                </div>
            </div>

            {{-- Aksi --}}
            <div class="flex justify-end space-x-4">
                <a href="{{ route('pesanan.index') }}"
                   class="px-6 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Simpan Pesanan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let itemCounter = 1;

function addOrderItem() {
    const itemsDiv = document.getElementById('orderItems');
    const newItem = document.createElement('div');
    newItem.className = 'flex gap-3 items-center';
    newItem.innerHTML = `
        <div class="flex-1">
            <select name="produk_id[]" class="form-input product-select"
                    onchange="calculateSubtotal(this.closest('.flex'))">
                <option value="">Pilih Menu</option>
                @foreach($produk as $product)
                <option value="{{ $product->id }}" data-price="{{ $product->harga }}">
                    {{ $product->nama }} — Rp {{ number_format($product->harga, 0, ',', '.') }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="w-28">
            <input type="number"
                   name="jumlah[]"
                   min="1"
                   value="1"
                   class="form-input quantity"
                   onchange="calculateSubtotal(this.closest('.flex'))">
        </div>

        <div class="w-40">
            <input type="text" class="form-input subtotal" placeholder="Subtotal" readonly>
        </div>

        <button type="button"
                onclick="removeOrderItem(this)"
                class="px-3 py-2 bg-red-900 text-red-300 rounded hover:bg-red-800">
            <i class="fas fa-times"></i>
        </button>
    `;
    itemsDiv.appendChild(newItem);
    itemCounter++;

    if (itemCounter > 1) {
        document.querySelector('#orderItems div:first-child button').disabled = false;
    }
}

function removeOrderItem(button) {
    if (itemCounter > 1) {
        button.closest('.flex').remove();
        itemCounter--;
        calculateTotal();

        if (itemCounter === 1) {
            document.querySelector('#orderItems div:first-child button').disabled = true;
        }
    }
}

function calculateSubtotal(row) {
    const select = row.querySelector('.product-select');
    const quantity = row.querySelector('.quantity');
    const subtotalInput = row.querySelector('.subtotal');

    if (select.value && quantity.value) {
        const price = select.options[select.selectedIndex].dataset.price;
        const subtotal = price * quantity.value;
        subtotalInput.value = 'Rp ' + subtotal.toLocaleString('id-ID');
    } else {
        subtotalInput.value = '';
    }

    calculateTotal();
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('#orderItems .subtotal').forEach(input => {
        if (input.value) {
            total += parseInt(input.value.replace(/[^\d]/g, '')) || 0;
        }
    });
    document.getElementById('totalAmount').textContent =
        'Rp ' + total.toLocaleString('id-ID');
}
</script>
@endsection
