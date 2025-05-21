@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Riwayat Pesanan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">Belum ada pesanan yang dibuat.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Gas LPG 3 Kg</th>
                    <th>Gas LPG 12 Kg</th>
                    <th>Metode Pembayaran</th>
                    <th>Alamat Pengiriman</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
                    <td>{{ $order->qty_3kg }}</td>
                    <td>{{ $order->qty_12kg }}</td>
                    <td>{{ ucfirst($order->payment_method) }}</td>
                    <td>{{ $order->address }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
