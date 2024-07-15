<!-- resources/views/components/sidebar-admin.blade.php -->
<div x-data="{ activeTab: '{{ Route::currentRouteName() }}' }" class="d-flex flex-column flex-shrink-0 p-3 bg-light position-fixed vh-100" style="width: 280px;">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" @click="activeTab = 'dashboard'" :class="{ 'active': activeTab === 'dashboard', 'link-dark': activeTab !== 'dashboard' }" class="nav-link" aria-current="page">
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('mata-kuliah') }}" @click="activeTab = 'mata-kuliah'" :class="{ 'active': activeTab === 'mata-kuliah', 'link-dark': activeTab !== 'mata-kuliah' }" class="nav-link">
                Mata Kuliah
            </a>
        </li>
        <li>
            <a href="{{ route('dosen') }}" @click="activeTab = 'dosen'" :class="{ 'active': activeTab === 'dosen', 'link-dark': activeTab !== 'dosen' }" class="nav-link">
                Dosen
            </a>
        </li>
        <li>
            <a href="{{ route('mahasiswa') }}" @click="activeTab = 'mahasiswa'" :class="{ 'active': activeTab === 'mahasiswa', 'link-dark': activeTab !== 'mahasiswa' }" class="nav-link">
                Mahasiswa
            </a>
        </li>
        <li>
            <a href="{{ route('report') }}" @click="activeTab = 'report'" :class="{ 'active': activeTab === 'report', 'link-dark': activeTab !== 'report' }" class="nav-link">
                Report
            </a>
        </li>
        <li>
            <a href="{{ route('profile.edit') }}" @click="activeTab = 'profile'" :class="{ 'active': activeTab === 'profile', 'link-dark': activeTab !== 'profile' }" class="nav-link">
                Profile
            </a>
        </li>
    </ul>
</div>
