{{-- resources/views/admin/partials/sidebar.blade.php --}}
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; min-height: 100vh;">
    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        {{-- Ganti dengan logo admin jika ada, atau biarkan teks --}}
        <img src="{{ asset('admin/images/Home/logogasify.png') }}" alt="Gasify Admin Logo" style="height: 40px; margin-right: 10px; filter: brightness(0) invert(1);">
        <span class="fs-4">Gasify Admin</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-white' }}">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.homepage.edit') }}" class="nav-link {{ request()->routeIs('admin.homepage.edit') ? 'active' : 'text-white' }}">
                <i class="fas fa-edit me-2"></i>
                Edit Homepage
            </a>
        </li>
        <li>
            <a href="{{ route('admin.stok.index') }}" class="nav-link {{ request()->routeIs('admin.stok.index') ? 'active' : 'text-white' }}">
                 <i class="fas fa-cubes me-2"></i>
                Manajemen Stok
            </a>
        </li>
        {{-- Tambahkan link admin lainnya di sini --}}
        {{-- Contoh: Manajemen User, Pesanan, dll. --}}
        {{-- <li>
            <a href="#" class="nav-link text-white">
                <i class="fas fa-users me-2"></i>
                Manajemen User
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white">
                <i class="fas fa-shopping-cart me-2"></i>
                Manajemen Pesanan
            </a>
        </li> --}}
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://via.placeholder.com/32" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>{{ Auth::user()->name ?? 'Admin User' }}</strong> {{-- Pastikan admin terotentikasi --}}
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            {{-- <li><a class="dropdown-item" href="#">Settings</a></li> --}}
            {{-- <li><a class="dropdown-item" href="#">Profile</a></li> --}}
            {{-- <li><hr class="dropdown-divider"></li> --}}
            <li>
                {{-- Asumsi Anda memiliki route logout untuk admin, jika tidak buatlah --}}
                {{-- Jika admin logout sama dengan user logout, pastikan guard-nya sesuai --}}
                <form id="admin-logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                    Sign out
                </a>
            </li>
        </ul>
    </div>
</div>