@extends('admin.layouts.admin') {{-- UBAH INI --}}

@section('title', 'Admin Dashboard - Gasify') {{-- Judul spesifik halaman --}}
@section('page_title', 'Dashboard') {{-- Untuk contoh Admin Navbar di layout admin --}}

@section('content')
<div class="container-fluid"> {{-- Kontainer Bootstrap untuk padding dan alignment --}}
    <h1 class="h3 mb-4 text-gray-800">Admin Dashboard</h1> {{-- Atau gunakan @yield('page_title') --}}

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Statistik Ringkasan --}}
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Stok 3kg</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stocks->firstWhere('type', '3kg')->quantity ?? 0 }} Tabung</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-archive fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Stok 12kg</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stocks->firstWhere('type', '12kg')->quantity ?? 0 }} Tabung</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-archive fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Pesanan Terbaru --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pesanan Terbaru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Pengguna</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orderList as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge
                                    @if($order->status == 'pending') bg-warning text-dark
                                    @elseif($order->status == 'confirmed') bg-info text-dark
                                    @elseif($order->status == 'on_delivery') bg-primary
                                    @elseif($order->status == 'delivered') bg-success
                                    @elseif($order->status == 'cancelled') bg-danger
                                    @else bg-secondary @endif">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada pesanan terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Jika ada form update stok di dashboard, letakkan di sini --}}
    {{-- Contoh:
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Stok dan Harga</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.stok.update') }}" method="POST">
                @csrf
                @foreach ($stocks as $stok)
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label text-uppercase">Gas {{ $stok->type }}</label>
                    <div class="col-sm-4">
                        <label for="stok_{{ $stok->type }}_quantity" class="form-label">Jumlah Stok</label>
                        <input type="number" name="stok[{{ $stok->type }}][quantity]" id="stok_{{ $stok->type }}_quantity" class="form-control" value="{{ $stok->quantity }}" min="0">
                    </div>
                    <div class="col-sm-4">
                         <label for="stok_{{ $stok->type }}_price" class="form-label">Harga (Rp)</label>
                        <input type="number" name="stok[{{ $stok->type }}][price]" id="stok_{{ $stok->type }}_price" class="form-control" value="{{ $stok->price }}" min="0">
                    </div>
                </div>
                @endforeach
                <button type="submit" class="btn btn-success">Update Stok & Harga</button>
            </form>
        </div>
    </div>
    --}}

</div>
@endsection

@push('admin_styles')
{{-- CSS khusus untuk halaman dashboard admin jika ada --}}
<style>
    .card.border-left-primary { border-left: .25rem solid #4e73df !important; }
    .card.border-left-success { border-left: .25rem solid #1cc88a !important; }
    .card.border-left-info { border-left: .25rem solid #36b9cc !important; }
    .card.border-left-warning { border-left: .25rem solid #f6c23e !important; }
    .text-gray-300 { color: #dddfeb !important; }
    .text-gray-800 { color: #5a5c69 !important; }
</style>
@endpush

@push('admin_scripts')
{{-- Script khusus untuk halaman dashboard admin jika ada --}}
{{-- Misalnya untuk DataTables atau Chart --}}
@endpush