@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-semibold">📄 Riwayat Pemesanan Gas</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada pesanan yang dibuat.
        </div>
    @else
        <div class="table-responsive">
            <table class="table align-middle table-bordered shadow-sm">
                <thead class="table-light text-center">
                    <tr class="fw-semibold">
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>3 Kg</th>
                        <th>12 Kg</th>
                        <th>Metode</th>
                        <th>Alamat Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $index => $order)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</td>
                        <td class="text-center">
                            {{ $order->qty_3kg }} tabung
                        </td>
                        <td class="text-center">
                            {{ $order->qty_12kg }} tabung
                        </td>
                        <td class="text-center">
                            <span class="badge bg-secondary text-uppercase">{{ $order->payment_method }}</span>
                        </td>
                        <td>{{ $order->address }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
