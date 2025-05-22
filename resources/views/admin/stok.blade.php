@extends('layouts.app')

@section('title', 'Manajemen Stok')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Manajemen Stok Gas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.stok.update') }}">
        @csrf
        @foreach($stok as $item)
        <div class="mb-3">
            <label>{{ strtoupper($item->type) }}:</label>
            <input type="number" name="stok[{{ $item->type }}]" value="{{ $item->quantity }}" min="0" class="form-control">
        </div>
        @endforeach

        <button class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
