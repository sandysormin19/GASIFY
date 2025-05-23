@extends('layouts.app')

@section('title', 'Manajemen Stok')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-semibold">Manajemen Stok Gas LPG</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.stok.update') }}">
        @csrf

        <div class="row justify-content-center g-4">
            @foreach($stok as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted mb-2">Jenis Gas</h6>
                        <h5 class="mb-3 fw-semibold">LPG {{ strtoupper($item->type) }}</h5>
                        <label for="stok_{{ $item->type }}" class="form-label">Jumlah Stok</label>
                        <input 
                            type="number" 
                            id="stok_{{ $item->type }}"
                            name="stok[{{ $item->type }}]" 
                            value="{{ $item->quantity }}" 
                            min="0" 
                            class="form-control" 
                            placeholder="Masukkan jumlah stok"
                        >
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <button class="btn btn-dark px-5 py-2">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection