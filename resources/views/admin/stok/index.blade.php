{{-- resources/views/admin/stok/index.blade.php --}}
@extends('admin.layouts.admin')

@section('title', 'Manajemen Stok dan Harga - Gasify Admin')
@section('page_title', 'Manajemen Stok dan Harga')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Stok dan Harga Gas</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Stok Gas</h6>
        </div>
        <div class="card-body">
            @if ($stocks && $stocks->count() > 0)
            <form action="{{ route('admin.stok.update') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 25%;">Tipe Gas</th>
                                <th scope="col" style="width: 35%;">Jumlah Stok Saat Ini</th>
                                <th scope="col" style="width: 35%;">Harga Jual (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stok)
                            <tr>
                                <td class="align-middle">
                                    <label class="form-label text-uppercase fw-bold mb-0">Gas {{ $stok->type }}</label>
                                </td>
                                <td>
                                    <input type="number" name="stok[{{ $stok->type }}][quantity]"
                                           id="stok_{{ $stok->type }}_quantity" class="form-control @error('stok.'.$stok->type.'.quantity') is-invalid @enderror"
                                           value="{{ old('stok.'.$stok->type.'.quantity', $stok->quantity) }}" min="0" required>
                                    @error('stok.'.$stok->type.'.quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" name="stok[{{ $stok->type }}][price]"
                                           id="stok_{{ $stok->type }}_price" class="form-control @error('stok.'.$stok->type.'.price') is-invalid @enderror"
                                           value="{{ old('stok.'.$stok->type.'.price', $stok->price) }}" min="0" required>
                                    @error('stok.'.$stok->type.'.price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save me-2"></i>Simpan Semua Perubahan
                    </button>
                </div>
            </form>
            @else
            <p class="text-muted">Belum ada data stok yang bisa dikelola. Sistem akan mencoba menginisialisasi tipe gas dasar.</p>
            {{-- Anda bisa menambahkan tombol untuk trigger inisialisasi manual jika diperlukan --}}
            @endif
        </div>
    </div>
</div>
@endsection

@push('admin_styles')
<style>
    /* Styling tambahan jika diperlukan */
    .table th, .table td {
        vertical-align: middle;
    }
</style>
@endpush