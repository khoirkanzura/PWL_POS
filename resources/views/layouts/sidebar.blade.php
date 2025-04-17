<div class="sidebar">
    <!-- Profile Section - New Addition -->
    <div class="profile-section text-center py-3">
        <div class="profile-picture-container mx-auto mb-2">
            @if(auth()->user()->foto)
                <img src="{{ asset('storage/uploads/user/' . auth()->user()->foto) }}" 
                     class="profile-picture rounded-circle shadow"
                     alt="Profile Picture">
            @else
                <div class="profile-initials rounded-circle shadow">
                    {{ substr(auth()->user()->nama, 0, 1) }}
                </div>
            @endif
        </div>
        <h6 class="profile-name mb-0">{{ auth()->user()->nama }}</h6>
        <small class="text-muted">{{ auth()->user()->level->level_nama }}</small>
    </div>

    <!-- Existing SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Existing Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- Menu Dashboard -->
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Data Pengguna -->
            <li class="nav-header">Data Pengguna</li>
            <li class="nav-item">
                <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level')? 'active' : '' }}">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>Level User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user')? 'active' : '' }}">
                    <i class="nav-icon far fa-user"></i>
                    <p>Data User</p>
                </a>
            </li>

            <!-- profile -->
            <li class="nav-item mb-1">
                <a href="{{ route('profile.edit') }}" class="nav-link {{ ($activeMenu == 'profile') ? 'bg-primary text-white' : 'text-white' }}" style="border-radius: 10px;">
                   <i class="nav-icon fas fa-id-badge"></i> Profil Saya
                </a>
            </li> 

            <!-- Data Barang -->
            <li class="nav-header">Data Barang</li>
            <li class="nav-item">
                <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori')? 'active' : '' }}">
                    <i class="nav-icon far fa-bookmark"></i>
                    <p>Kategori Barang</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang')? 'active' : '' }}">
                    <i class="nav-icon far fa-list-alt"></i>
                    <p>Data Barang</p>
                </a>
            </li>

            <!-- Supplier -->
            <li class="nav-item">
                <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'supplier')? 'active' : '' }}">
                    <i class="nav-icon fas fa-truck"></i>
                    <p>Data Supplier</p>
                </a>
            </li>

            <!-- Transaksi -->
            <li class="nav-header">Data Transaksi</li>
            <li class="nav-item">
                <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok')? 'active' : '' }}">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>Stok Barang</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/penjualan') }}" class="nav-link {{ ($activeMenu == 'penjualan')? 'active' : '' }}">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>Transaksi Penjualan</p>
                </a>
            </li>

            <li class="nav-header">Akun</li>

            <!-- Logout -->
            <li class="nav-item">
                <a href="{{ url('/logout') }}" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
</div>

<style>
    /* Profile Section Styles */
    .profile-section {
        background: rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin: -0.5rem -0.5rem 0.5rem -0.5rem;
    }

    .profile-picture-container {
        width: 80px;
        height: 80px;
        position: relative;
    }

    .profile-picture {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .profile-picture:hover {
        transform: scale(1.05);
        border-color: #4ecca3;
    }

    .profile-initials {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #4ecca3 0%, #3498db 100%);
        color: white;
        font-size: 32px;
        font-weight: bold;
        border: 3px solid rgba(255, 255, 255, 0.2);
    }

    .profile-name {
        color: white;
        font-weight: 600;
        margin-top: 8px;
    }

    /* Existing Sidebar Styles Remain Unchanged */
    .sidebar {
        width: 250px;
        min-height: 100vh;
        background: #343a40;
        color: white;
        transition: all 0.3s;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.8);
    }

    .nav-link:hover {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .nav-link.active {
        color: white;
        background-color: #007bff;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            z-index: 1000;
            margin-left: -250px;
        }
        
        .sidebar.active {
            margin-left: 0;
        }
        
        .profile-section {
            padding-top: 60px;
        }
    }
</style>

<script>
    // Toggle sidebar on mobile (you'll need to add a toggle button in your navbar)
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.querySelector('.sidebar-toggle'); // Add this button in your navbar
        
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }
    });
</script>