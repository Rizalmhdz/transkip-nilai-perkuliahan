<div :class="isSidebarOpen ? 'sidebar-expand' : 'sidebar-collapse'" class="sidebar bg-body-tertiary flex-shrink-0">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-dark' : '' }}">
                <i class="fas fa-tachometer-alt {{ request()->routeIs('dashboard') ? '':'text-dark'  }}"></i>
                <span class="ms-2  {{ request()->routeIs('dashboard') ? '':'text-dark'  }} d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mata-kuliah.index') }}" class="nav-link {{ request()->routeIs('mata-kuliah.index') ? 'active bg-dark' : '' }}">
                <i class="fas fa-book {{ request()->routeIs('mata-kuliah.index') ? '':'text-dark'  }}"></i>
                <span class="ms-2  {{ request()->routeIs('mata-kuliah.index') ? '':'text-dark'  }} d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Mata Kuliah</span>
            </a> 
        </li>
        <li class="nav-item">
            <a href="{{ route('dosen') }}" class="nav-link {{ request()->routeIs('dosen') ? 'active bg-dark' : '' }}">
                <i class="fas fa-user {{ request()->routeIs('dosen') ? '':'text-dark'  }}"></i>
                <span class="ms-2  {{ request()->routeIs('dosen') ? '':'text-dark'  }} d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Dosen</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mahasiswa') }}" class="nav-link {{ request()->routeIs('mahasiswa') ? 'active bg-dark' : '' }}">
                <i class="fas fa-user-graduate {{ request()->routeIs('mahasiswa') ? '':'text-dark'  }}"></i>
                <span class="ms-2  {{ request()->routeIs('mahasiswa') ? '':'text-dark'  }} d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Mahasiswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('report') }}" class="nav-link {{ request()->routeIs('report') ? 'active bg-dark' : '' }}">
                <i class="fas fa-chart-line {{ request()->routeIs('report') ? '':'text-dark'  }}"></i>
                <span class="ms-2  {{ request()->routeIs('report') ? '':'text-dark'  }} d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active bg-dark' : '' }}">
                <i class="fas fa-user-circle {{ request()->routeIs('profile.edit') ? '':'text-dark'  }}"></i>
                <span class="ms-2  {{ request()->routeIs('profile.edit') ? '':'text-dark'  }} d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Profile</span>
            </a>
        </li>
    </ul>
</div>
