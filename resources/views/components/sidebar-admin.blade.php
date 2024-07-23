<div class="d-flex flex-column flex-shrink-0 p-2 bg-body-tertiary" id="sidebar">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span class="ms-2 d-none d-md-inline">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.index') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-users"></i>
                <span class="ms-2 d-none d-md-inline">Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dosen.index') }}" class="nav-link {{ request()->routeIs('dosen.index') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-user"></i>
                <span class="ms-2 d-none d-md-inline">Dosen</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('prodi.index') }}" class="nav-link {{ request()->routeIs('prodi.index') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-university"></i>
                <span class="ms-2 d-none d-md-inline">Prodi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dosen-prodi.index') }}" class="nav-link {{ request()->routeIs('dosen-prodi.index') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span class="ms-2 d-none d-md-inline">Dosen Prodi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('direktur.index') }}" class="nav-link {{ request()->routeIs('direktur.index') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-user-tie"></i>
                <span class="ms-2 d-none d-md-inline">Direktur</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('kategori-matkul.index') }}" class="nav-link {{ request()->routeIs('kategori-matkul.index') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-tags"></i>
                <span class="ms-2 d-none d-md-inline">Kategori Matkul</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mahasiswa.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.index') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-user-graduate"></i>
                <span class="ms-2 d-none d-md-inline">Mahasiswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('karya-tulis.index') }}" class="nav-link {{ request()->routeIs('karya-tulis.index') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-file-alt"></i>
                <span class="ms-2 d-none d-md-inline">Karya Tulis</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mata-kuliah.index') }}" class="nav-link {{ request()->routeIs('mata-kuliah.index') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-book"></i>
                <span class="ms-2 d-none d-md-inline">Mata Kuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('hasil-studi.index') }}" class="nav-link {{ request()->routeIs('hasil-studi.index') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-chart-line"></i>
                <span class="ms-2 d-none d-md-inline">Hasil Studi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active bg-dark text-white' : 'text-dark' }}">
                <i class="fas fa-user-circle"></i>
                <span class="ms-2 d-none d-md-inline">Profile</span>
            </a>
        </li>
    </ul>
</div>

<style>
    .sidebar {
        transition: width 0.3s, padding 0.3s;
    }

    @media (max-width: 767px) {
        .sidebar {
            width: 50px;
            padding: 0 2px;
        }

        .sidebar .nav-link {
            padding: 0.25rem 0.25rem;
            margin: 0;
        }

        .sidebar .nav-link span {
            display: none;
        }
    }

    @media (min-width: 768px) {
        .sidebar {
            width: 250px;
            padding: 1rem;
        }
    }

    .nav-link i {
        transition: color 0.3s;
    }

    .nav-link.active i {
        color: white;
    }

    .nav-link {
        border: 1px solid transparent;
        border-radius: 0.25rem;
        transition: border-color 0.3s;
    }

    .nav-link:hover {
        border-color: #343a40;
    }

    .nav-link .ms-2 {
        transition: display 0.3s;
    }
</style>
