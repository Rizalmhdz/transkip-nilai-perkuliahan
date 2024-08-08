<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Studi') }}
        </h2>
    </x-slot>

    <head>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <style>
            .modal-title {
                text-align: center;
                text-transform: capitalize;
                width: 100%;
                font-size: 1rem;
            }

            .modal-header {
                display: flex;
                font-weight: bold;
                justify-content: center;
                align-items: center;
                padding: 1rem;
            }

            .modal-header .close {
                position: absolute;
                right: 10px;
            }

            .form-control {
                border: 1px solid #ced4da;
                font-size: 0.875rem;
            }

            .table-responsive {
                overflow-x: auto;
                margin-left: -1rem;
                margin-right: -1rem;
            }

            .table thead th {
                border-bottom: 2px solid #dee2e6;
                text-align: center;
                font-size: 0.875rem;
                padding: 0.5rem;
            }

            .table td,
            .table th {
                border: none;
                text-align: center;
                font-size: 0.875rem;
                padding: 0.5rem;
            }

            .action-buttons .btn {
                margin-bottom: 0.25rem;
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }

            .action-buttons .btn + .btn {
                margin-left: 0.25rem;
            }

            .modal-body,
            .modal-footer {
                text-align: left;
                padding: 1rem;
            }

            .pagination .page-link:hover {
                background-color: #343a40;
                color: #fff;
            }

            .input-group .form-control {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
                font-size: 0.875rem;
            }

            .input-group .input-group-append .btn {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
                font-size: 0.875rem;
            }

            .invalid-feedback {
                display: none;
                color: red;
            }

            .is-invalid {
                border-color: red;
            }

            .related-link {
                display: block;
                margin-top: 0.25rem;
                font-size: 0.75rem;
                text-decoration: underline;
                color: #007bff;
            }
        </style>
    </head>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="container">
                <!-- Filter Modal -->
                <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title font-weight-bold" id="filterModalLabel">Filter Hasil Studi</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('hasil-studi.index') }}" method="GET" id="filterForm">
                                    <div class="form-group mb-3">
                                        <label for="filter_prodi" class="font-weight-bold">Prodi</label>
                                        <select name="prodi" id="filter_prodi" class="form-control rounded">
                                            <option value="">Semua Prodi</option>
                                            @foreach($prodis as $prodi)
                                                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="filter_mata_kuliah" class="font-weight-bold">Mata Kuliah</label>
                                        <select name="mata_kuliah" id="filter_mata_kuliah" class="form-control rounded">
                                            <option value="">Semua Mata Kuliah</option>
                                            @foreach($mata_kuliahs as $mataKuliah)
                                                <option value="{{ $mataKuliah->id }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="filter_nim" class="font-weight-bold">Mahasiswa</label>
                                        <select name="nim" id="filter_nim" class="form-control rounded">
                                            <option value="">Semua Mahasiswa</option>
                                            @foreach($mahasiswas as $mahasiswa)
                                                <option value="{{ $mahasiswa->nim }}">{{ $mahasiswa->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="filter_nilai" class="font-weight-bold">Nilai</label>
                                        <select name="nilai" id="filter_nilai" class="form-control rounded">
                                            <option value="">Semua Nilai</option>
                                            <option value="4">A - 4</option>
                                            <option value="3">B - 3</option>
                                            <option value="2">C - 2</option>
                                            <option value="1">D - 1</option>
                                            <option value="0">E - 0</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" onclick="document.getElementById('filterForm').submit();">Terapkan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Success Modal -->
                <button id="successBtn" type="button" class="d-none" data-toggle="modal" data-target="#successModal">Sukses</button>
                <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#successModal').hide(); $('.modal-backdrop.fade.show').hide();">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ session('success') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#successModal').hide(); $('.modal-backdrop.fade.show').hide();">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Error Modal -->
                <button id="errorBtn" type="button" class="d-none" data-toggle="modal" data-target="#errorModal">Gagal</button>
                <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="errorModalLabel">Gagal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#errorModal').hide(); $('.modal-backdrop.fade.show').hide();">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ session('error') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#errorModal').hide(); $('.modal-backdrop.fade.show').hide();">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3 d-flex justify-content-between">
                        <div class="col-12 col-md-6 mb-2 mb-md-0">
                            <button class="btn btn-primary me-2" data-toggle="modal" data-target="#createModal">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                            <button class="btn btn-secondary me-2" data-toggle="modal" data-target="#filterModal">
                                <i class="fa fa-filter"></i> Filter
                            </button>
                        
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('hasil-studi.index') }}'">Hapus Filter</button>
                    </div>
                    <div class="col-12 col-md-6 d-md-flex justify-content-end justify-content-md-end">
                        @if($isPrint)
                        <div class="text-gray-600 me-3">
                            <div>IPK: {{ $ipk }}</div>
                            <div>Total SKS: {{ $totalSks }}</div>
                        </div>
                        @endif
                        
                        <button type="button" class="btn btn-outline-dark me-2">Total Data : {{ $total }}</button>
                        @if($isPrint)
                        <button type="button" class="btn btn-success me-2" onclick="window.location.href='{{ route('cetak-rekap-nilai', ['nim' => $nim, 'page' => 1]) }}'">
                            <i class="fa fa-print me-2"></i> REKAP NILAI
                        </button>
                        <button type="button" class="btn btn-info" onclick="window.location.href='{{ route('cetak-rekap-nilai', ['nim' => $nim, 'page' => 2]) }}'">
                            <i class="fa fa-print me-2"></i> DETAIL
                        </button>
                        @endif
                    </div>
                    
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <div class="table-responsive mb-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>
                                            <a href="?sort=nim&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                NIM
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nim' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=nama_mata_kuliah&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Mata Kuliah
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nama_mata_kuliah' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=sks&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                SKS
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'sks' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=nilai&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Nilai
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nilai' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=nilai&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Huruf
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nilai' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hasil_studis as $index => $hasilStudi)
                                    <tr>
                                        <td>{{ $index + 1 + ($hasil_studis->currentPage() - 1) * $hasil_studis->perPage() }}</td>
                                        <td>{{ $hasilStudi->nim }}</td>
                                        <td>{{ $hasilStudi->mataKuliah->nama_mata_kuliah }}</td>
                                        <td>{{ $hasilStudi->mataKuliah->sks }}</td>
                                        <td>{{ $hasilStudi->nilai }}</td>
                                        <td>
                                            @switch($hasilStudi->nilai)
                                            @case(4)
                                                A
                                                @break

                                            @case(3)
                                                B
                                                @break

                                            @case(2)
                                                C
                                                @break

                                            @case(1)
                                                D
                                                @break

                                            @case(0)
                                                E
                                                @break

                                            @default
                                                ''
                                        @endswitch
                                        </td>
                                        <td class="action-buttons">
                                            <button class="btn btn-warning ms-2" data-toggle="modal" data-target="#editModal{{ $hasilStudi->id }}" onclick="editHasilStudi({{ $hasilStudi->id }}, '{{ $hasilStudi->nim }}', '{{ $hasilStudi->id_mata_kuliah }}', {{ $hasilStudi->nilai }})">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $hasilStudi->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $hasilStudi->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $hasilStudi->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title font-weight-bold" id="editModalLabel{{ $hasilStudi->id }}">Edit Hasil Studi</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm{{ $hasilStudi->id }}" action="{{ route('hasil-studi.update', $hasilStudi->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="page" value="{{ $hasil_studis->currentPage() }}">
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nim{{ $hasilStudi->id }}" class="font-weight-bold">NIM</label>
                                                                    <select class="form-control rounded" id="edit_nim{{ $hasilStudi->id }}" name="nim" required>
                                                                        @foreach($mahasiswas as $mahasiswa)
                                                                            <option value="{{ $mahasiswa->nim }}">{{ $mahasiswa->nim }} - {{ $mahasiswa->nama_lengkap }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <a href="{{ route('mahasiswa.index') }}" class="related-link">Tambahkan NIM baru</a>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_id_mata_kuliah{{ $hasilStudi->id }}" class="font-weight-bold">Mata Kuliah</label>
                                                                    <select class="form-control rounded" id="edit_id_mata_kuliah{{ $hasilStudi->id }}" name="id_mata_kuliah" required>
                                                                        @foreach($mata_kuliahs as $mataKuliah)
                                                                            <option value="{{ $mataKuliah->id }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <a href="{{ route('mata-kuliah.index') }}" class="related-link">Tambahkan Mata Kuliah baru</a>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nilai{{ $hasilStudi->id }}" class="font-weight-bold">Nilai</label>
                                                                    <select class="form-control rounded" id="edit_nilai{{ $hasilStudi->id }}" name="nilai" required>
                                                                        <option value="4">4 - A</option>
                                                                        <option value="3">3 - B</option>
                                                                        <option value="2">2 - C</option>
                                                                        <option value="1">1 - D</option>
                                                                        <option value="0">0 - E</option>
                                                                    </select>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                                        </div>
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $hasilStudi->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $hasilStudi->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel{{ $hasilStudi->id }}">Konfirmasi Penghapusan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda Yakin Ingin Menghapus Data "<strong>{{ $hasilStudi->nim }}</strong>"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                                            <form action="{{ route('hasil-studi.destroy', $hasilStudi->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="page" value="{{ $hasil_studis->currentPage() }}">
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 mb-2">
                            <div>
                                {{ $hasil_studis->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Modal -->
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah Hasil Studi</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="{{ route('hasil-studi.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nim" class="font-weight-bold">NIM</label>
                                        <select class="form-control rounded" id="nim" name="nim" required>
                                            @foreach($mahasiswas as $mahasiswa)
                                                <option value="{{ $mahasiswa->nim }}">{{ $mahasiswa->nim }} - {{ $mahasiswa->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                        <a href="{{ route('mahasiswa.index') }}" class="related-link">Tambahkan NIM baru</a>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="id_mata_kuliah" class="font-weight-bold">Mata Kuliah</label>
                                        <select class="form-control rounded" id="id_mata_kuliah" name="id_mata_kuliah" required>
                                            @foreach($mata_kuliahs as $mataKuliah)
                                                <option value="{{ $mataKuliah->id }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                                            @endforeach
                                        </select>
                                        <a href="{{ route('mata-kuliah.index') }}" class="related-link">Tambahkan Mata Kuliah baru</a>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nilai" class="font-weight-bold">Nilai</label>
                                        <select class="form-control rounded" id="nilai" name="nilai" required>
                                            <option value="4">4 - A</option>
                                            <option value="3">3 - B</option>
                                            <option value="2">2 - C</option>
                                            <option value="1">1 - D</option>
                                            <option value="0">0 - E</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                            </div>
                                </form>
                        </div>
                    </div>
                </div>

                <!-- Include jQuery and Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                <script>
                $(document).ready(function () {
                    // Show success modal if there is a success message
                    @if(session('success'))
                        $('#successBtn').click();
                    @endif

                    // Show error modal if there is an error message
                    @if(session('error'))
                        $('#errorBtn').click();
                    @endif

                    // Clear form fields on modal close
                    $('#createModal').on('hidden.bs.modal', function () {
                        $('#createForm')[0].reset();
                        $('#createForm .form-control').removeClass('is-invalid');
                        $('#createForm .invalid-feedback').hide();
                    });

                    $('.edit-modal').on('hidden.bs.modal', function () {
                        $(this).find('form')[0].reset();
                        $(this).find('.form-control').removeClass('is-invalid');
                        $(this).find('.invalid-feedback').hide();
                    });

                    window.editHasilStudi = function (id, nim, id_mata_kuliah, nilai) {
                        $('#edit_nim' + id).val(nim);
                        $('#edit_id_mata_kuliah' + id).val(id_mata_kuliah);
                        $('#edit_nilai' + id).val(nilai);
                    }

                    $('#searchButton').on('click', function () {
                        const keyword = $('#searchKeyword').val().toLowerCase();
                        $('table tbody tr').filter(function () {
                            $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1)
                        });
                    });
                });
                </script>

            </div>
        </div>
    </div>
</x-app-layout>
