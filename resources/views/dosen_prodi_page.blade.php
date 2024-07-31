<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dosen') }}
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
            .table td, .table th {
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
            .modal-body, .modal-footer {
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
        </style>
    </head>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <!-- Success Modal -->
            <button id="successBtn" type="button" class="d-none" data-toggle="modal" data-target="#successModal">Sukses</button>
            <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                onclick="$('#successModal').hide(); $('.modal-backdrop.fade.show').hide();">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ session('success') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                onclick="$('#successModal').hide(); $('.modal-backdrop.fade.show').hide();">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Modal -->
            <button id="errorBtn" type="button" class="d-none" data-toggle="modal" data-target="#errorModal">Gagal</button>
            <div class="modal fade" id="errorModal" tabindex="-1" role="dialog"
                aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Gagal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                onclick="$('#errorModal').hide(); $('.modal-backdrop.fade.show').hide();">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ session('error') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                onclick="$('#errorModal').hide(); $('.modal-backdrop.fade.show').hide();">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row mb-3 d-flex justify-content-between">
                    <div class="col-12 col-md-9 mb-2 mb-md-0">
                        <button class="btn btn-primary me-2" data-toggle="modal" data-target="#createModal">
                            <i class="fa fa-plus"></i> Tambah Data
                        </button>
                        <button class="btn btn-secondary me-2" data-toggle="modal" data-target="#filterModal">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                    </div>
                    <div class="col-12 col-md-3 d-md-flex justify-content-end">
                        <button type="button" class="btn btn-outline-dark"> Total Data : {{ $total }}</button>
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
                                            <a href="?sort=nidn&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                NIDN
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nidn' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>Nama</th>
                                        <th>
                                            <a href="?sort=prodi&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Prodi
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'prodi' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dosen_prodis as $index => $dosen_prodi)
                                    <tr>
                                        <td>{{ $index + 1 + ($dosen_prodis->currentPage() - 1) * $dosen_prodis->perPage() }}</td>
                                        <td>{{ $dosen_prodi->nidn }}</td>
                                        <td>
                                            @foreach($dosens as $dosen)
                                                {{ $dosen->nidn == $dosen_prodi->nidn ? $dosen->nama : '' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($prodis as $prodi)
                                                {{ $dosen_prodi->prodi == $prodi->id ? $prodi->nama_prodi : '' }}
                                            @endforeach
                                        </td>
                                        <td class="action-buttons">
                                            <button class="btn btn-warning ms-2" data-toggle="modal"
                                                data-target="#editModal{{ $dosen_prodi->id }}"
                                                onclick="editDosenProdi({{ $dosen_prodi->id }}, '{{ $dosen_prodi->nidn }}', '{{ $dosen_prodi->prodi }}')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $dosen_prodi->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $dosen_prodi->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $dosen_prodi->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title font-weight-bold"
                                                                id="editModalLabel{{ $dosen_prodi->id }}">Edit Dosen Prodi</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm{{ $dosen_prodi->id }}"
                                                                action="{{ route('dosen-prodi.update', $dosen_prodi->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nidn{{ $dosen_prodi->id }}"
                                                                        class="font-weight-bold">NIDN - Nama Dosen</label>
                                                                    <select class="form-control rounded"
                                                                        id="edit_nidn{{ $dosen_prodi->id }}"
                                                                        name="nidn" required>
                                                                        @foreach($dosens as $dosen)
                                                                            <option value="{{ $dosen->nidn }}">{{ $dosen->nidn }} - {{ $dosen->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <a href="{{ route('dosen.index') }}" class="related-link">Tambahkan Dosen baru</a>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_prodi{{ $dosen_prodi->id }}"
                                                                        class="font-weight-bold">Prodi</label>
                                                                    <select class="form-control rounded"
                                                                        id="edit_prodi{{ $dosen_prodi->id }}"
                                                                        name="prodi" required>
                                                                        @foreach($prodis as $prodi)
                                                                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <a href="{{ route('prodi.index') }}" class="related-link">Tambahkan Prodi baru</a>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                id="edit_submit{{ $dosen_prodi->id }}">Ubah</button>
                                                        </div>
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $dosen_prodi->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel{{ $dosen_prodi->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $dosen_prodi->id }}">Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda Yakin Ingin Menghapus Data "<strong>{{ $dosen_prodi->nidn }}</strong>"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <form action="{{ route('dosen-prodi.destroy', $dosen_prodi->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="page" value="{{ $dosen_prodis->currentPage() }}">
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
                                {{ $dosen_prodis->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Modal -->
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah Dosen Prodi</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="{{ route('dosen-prodi.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nidn" class="font-weight-bold">NIDN - Nama Dosen</label>
                                        <select class="form-control rounded" id="nidn" name="nidn" required>
                                            @foreach($dosens as $dosen)
                                                <option value="{{ $dosen->nidn }}">{{ $dosen->nidn }} - {{ $dosen->nama }}</option>
                                            @endforeach
                                        </select>
                                        <a href="{{ route('dosen.index') }}" class="related-link">Tambahkan Dosen baru</a>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="prodi" class="font-weight-bold">Prodi</label>
                                        <select class="form-control rounded" id="prodi" name="prodi" required>
                                            @foreach($prodis as $prodi)
                                                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                            @endforeach
                                        </select>
                                        <a href="{{ route('prodi.index') }}" class="related-link">Tambahkan Prodi baru</a>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                <button type="submit" class="btn btn-primary" id="create_submit">Tambahkan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Filter Modal -->
                <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title font-weight-bold" id="filterModalLabel">Filter Dosen Prodi</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('dosen-prodi.index') }}" method="GET" id="filterForm">
                                    <div class="form-group mb-3">
                                        <label for="filter_prodi" class="font-weight-bold">Prodi</label>
                                        <select name="prodi" id="filter_prodi" class="form-control rounded">
                                            <option value="">Semua Prodi</option>
                                            @foreach($prodis as $prodi)
                                                <option value="{{ $prodi->id }}" {{ $prodi->id == $prodi_id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="filter_dosen" class="font-weight-bold">Dosen</label>
                                        <select name="dosen" id="filter_dosen" class="form-control rounded">
                                            <option value="">Semua Dosen</option>
                                            @foreach($dosens as $dosen)
                                                <option value="{{ $dosen->nidn }}" {{ $dosen->nidn == $dosen_id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                                            @endforeach
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

                <!-- Include jQuery and Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                <script>
                $(document).ready(function () {
                    // Clear form fields on modal close
                    $('#createModal').on('hidden.bs.modal', function () {
                        $('#createForm')[0].reset();
                    });

                    $('[id^=editModal]').on('hidden.bs.modal', function () {
                        $(this).find('form')[0].reset();
                    });

                    window.editDosenProdi = function (id, nidn, prodi) {
                        $('#edit_nidn' + id).val(nidn);
                        $('#edit_prodi' + id).val(prodi);
                    }

                    $('#searchButton').on('click', function () {
                        const keyword = $('#searchKeyword').val().toLowerCase();
                        $('table tbody tr').filter(function () {
                            $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1)
                        });
                    });

                    @if(session('success'))
                        $('#successBtn').trigger('click');
                    @endif

                    @if(session('error'))
                        $('#errorBtn').trigger('click');
                    @endif
                });
                </script>

            </div>
        </div>
    </div>
</x-app-layout>
