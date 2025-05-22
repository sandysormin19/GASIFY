@extends('layouts.app')

@section('content')
<style>
    .profile-wrapper {
        background: linear-gradient(to right, #e0f7fa, #ffffff);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #20c997;
        margin-bottom: 15px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(32, 201, 151, 0.3);
        border-color: #20c997;
    }

    .btn-save {
        background-color: #20c997;
        border: none;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        color: white;
        transition: background 0.3s ease;
    }

    .btn-save:hover {
        background-color: #199c7a;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="profile-wrapper text-center">
                {{-- Avatar & Header --}}
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=20c997&color=fff" alt="Avatar" class="profile-avatar">
                <h3 class="fw-bold mb-4">Profil Pengguna</h3>

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('user.profile.update') }}" method="POST" class="text-start">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control rounded-3" value="{{ old('name', $user->name) }}" required>
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Pengiriman</label>
                        <textarea name="address" class="form-control rounded-3" rows="3">{{ old('address', $user->address) }}</textarea>
                    </div>

                    {{-- Password --}}
                    <hr>
                    <h5 class="fw-bold mt-4">Ganti Password</h5>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control rounded-3">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control rounded-3">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
