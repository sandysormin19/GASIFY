@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Profil Pengguna</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name">Nama:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="address">Alamat Pengiriman:</label>
            <textarea name="address" class="form-control">{{ old('address', $user->address) }}</textarea>
        </div>

        <hr>
        <h5>Ubah Password</h5>
        <div class="mb-3">
            <label for="password">Password Baru:</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password_confirmation">Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
