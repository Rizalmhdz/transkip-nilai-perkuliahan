<div :class="isSidebarOpen ? 'sidebar-expand' : 'sidebar-collapse'" class="sidebar bg-body-tertiary flex-shrink-0">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link" :class="{ 'active': '{{ request()->routeIs('dashboard') }}' }">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="ms-2 d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('mata-kuliah') }}" class="nav-link" :class="{ 'active': '{{ request()->routeIs('mata-kuliah') }}' }">
                    <i class="fas fa-book"></i>
                    <span class="ms-2 d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Mata Kuliah</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dosen') }}" class="nav-link" :class="{ 'active': '{{ request()->routeIs('dosen') }}' }">
                    <i class="fas fa-user"></i>
                    <span class="ms-2 d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Dosen</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('mahasiswa') }}" class="nav-link" :class="{ 'active': '{{ request()->routeIs('mahasiswa') }}' }">
                    <i class="fas fa-user-graduate"></i>
                    <span class="ms-2 d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('report') }}" class="nav-link" :class="{ 'active': '{{ request()->routeIs('report') }}' }">
                    <i class="fas fa-chart-line"></i>
                    <span class="ms-2 d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Report</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile.edit') }}" class="nav-link" :class="{ 'active': '{{ request()->routeIs('profile.edit') }}' }">
                    <i class="fas fa-user-circle"></i>
                    <span class="ms-2 d-md-inline" :class="isSidebarOpen ? 'd-inline' : 'd-none'">Profile</span>
                </a>
            </li>
        </ul>
    </div>

