<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Dashboard') }}
        </h2>
        <h3 class="font-semibold text-lg text-gray-600 leading-tight text-center">
            {{ __('Statistics Overview') }}
        </h3>
    </x-slot>

    <head>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <style>
            .card {
                border: 1px solid #dee2e6;
                border-radius: 0.25rem;
                margin: 0.5rem;
                padding: 1rem;
                flex: 1 1 calc(25% - 1rem);
                display: flex;
                flex-direction: column;
                height: auto;
                justify-content: space-between;
            }

            .card-title {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
                font-weight: bold;
                text-align: center;
            }

            .card-body {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .stat-prodis .card-body {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: left;
                justify-content: left;
            }

            .card-footer {
                text-align: right;
                margin-top: 1rem;
            }

            .card-container {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .stat-prodis .card-body-item {
                display: flex;
                align-items: left;
                justify-content: left;
                margin-bottom: 0.5rem;
                margin-left: 0.5rem;
                flex-direction: column;
            }

            .stat-table .card-body-item {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 0.5rem;
                margin-left: 0.5rem;
                flex-direction: column;
            }

            .stat-table .card-body-item i {
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
            }

            .stat-table .card-container {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .stat-table .card {
                flex: 1 1 calc(25% - 1rem);
            }
        </style>
    </head>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container mt-4 stat-prodis">
            <div class="card-container">
                @foreach($prodiStats as $prodi => $stats)
                <div class="card">
                    <div class="card-header text-center"><h3>{{ $prodi }}</h3></div>
                    <div class="card-body">
                        <div class="card-body-item d-flex align-items-left">
                            <p class="mb-0"> <i class="fa fa-chalkboard-teacher me-2"></i> Total Dosens : {{ $stats['dosens'] }}</p>
                        </div>
                        <div class="card-body-item d-flex align-items-center">
                           
                            <p class="mb-0">  <i class="fa fa-user-graduate me-2"></i>Total Mahasiswas: {{ $stats['mahasiswas'] }}</p>
                        </div>
                        <div class="card-body-item d-flex align-items-center">
                           
                            <p class="mb-0">  <i class="fa fa-book me-2"></i>Total Mata Kuliahs: {{ $stats['mata_kuliahs'] }}</p>
                        </div>
                        <div class="card-body-item d-flex align-items-center">
                           
                            <p class="mb-0"> <i class="fa fa-graduation-cap me-2"></i>Mahasiswa Lulus: {{ $stats['mahasiswa_lulus'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container mt-4 stat-table">
            <div class="card-container mt-4">
                <div class="card">
                    <div class="card-title">Total Users</div>
                    <div class="card-body">
                        <div class="card-body-item d-flex align-items-center">
                            <i class="fa fa-users"></i>
                            <p class="mb-0">{{ $totalUsers }} Users</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('user.index') }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">Total Dosens</div>
                    <div class="card-body">
                        <div class="card-body-item d-flex align-items-center">
                            <i class="fa fa-chalkboard-teacher"></i>
                            <p class="mb-0">{{ $totalDosens }} Dosens</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('dosen.index') }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">Total Prodis</div>
                    <div class="card-body">
                        <div class="card-body-item d-flex align-items-center">
                            <i class="fa fa-building"></i>
                            <p class="mb-0">{{ $totalProdis }} Prodis</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('prodi.index') }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">Total Mahasiswas</div>
                    <div class="card-body">
                        <div class="card-body-item d-flex align-items-center">
                            <i class="fa fa-user-graduate"></i>
                            <p class="mb-0">{{ $totalMahasiswas }} Mahasiswas</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">Total Karya Tuliss</div>
                    <div class="card-body">
                        <div class="card-body-item d-flex align-items-center">
                            <i class="fa fa-book"></i>
                            <p class="mb-0">{{ $totalKaryaTuliss }} Karya Tuliss</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('karya-tulis.index') }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">Total Mata Kuliahs</div>
                    <div class="card-body">
                        <div class="card-body-item d-flex align-items-center">
                            <i class="fa fa-book-open"></i>
                            <p class="mb-0">{{ $totalMataKuliahs }} Mata Kuliahs</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('mata-kuliah.index') }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">Total Hasil Studis</div>
                    <div class="card-body">
                        <div class="card-body-item d-flex align-items-center">
                            <i class="fa fa-clipboard-list"></i>
                            <p class="mb-0">{{ $totalHasilStudis }} Hasil Studis</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('hasil-studi.index') }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
