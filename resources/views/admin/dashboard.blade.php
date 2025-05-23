@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-5">
    <h2>Dashboard Admin</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Statistik --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card p-3">
                <strong>Total Pesanan:</strong>
                <h4>{{ $totalOrders }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <strong>Total Penjualan:</strong>
                <h4>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    {{-- Form Update Stok dan Harga --}}
    <form method="POST" action="{{ route('admin.stok.update') }}">
        @csrf
        <h4>Stok & Harga Gas</h4>
        <div class="row">
            @foreach($stocks as $item)
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <h5>Gas {{ $item->type }}</h5>
                    <div class="mb-2">
                        <label>Jumlah Stok</label>
                        <input type="number" name="stok[{{ $item->type }}][quantity]" class="form-control" value="{{ $item->quantity }}">
                    </div>
                    <div class="mb-2">
                        <label>Harga per Tabung (Rp)</label>
                        <input type="number" name="stok[{{ $item->type }}][price]" class="form-control" value="{{ $item->price }}">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button class="btn btn-primary" type="submit">Simpan</button>
    </form>

    {{-- Daftar Pesanan --}}
    <hr>
    <h4>Pesanan Terbaru</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Qty 3kg</th>
                <th>Qty 12kg</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderList as $i => $order)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $order->user_name ?? '-' }}</td>
                <td>{{ $order->qty_3kg }}</td>
                <td>{{ $order->qty_12kg }}</td>
                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
