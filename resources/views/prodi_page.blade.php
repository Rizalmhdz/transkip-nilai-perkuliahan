<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prodi') }}
        </h2>
    </x-slot>
    
    <head>
        <style>
            .modal-title {
                text-align: center;
                text-transform: capitalize;
                width: 100%;
            }
            .modal-header {
                display: flex;
                font-weight: bold;
                justify-content: center;
                align-items: center;
            }
            .modal-header .close {
                position: absolute;
                right: 15px;
            }
            .form-control {
                border: 1px solid #ced4da;
            }
            .table-responsive {
                overflow-x: auto;
            }
            .table thead th {
                border-bottom: 2px solid #dee2e6;
                text-align: center;
            }
            .table td, .table th {
                border: none;
                text-align: center;
            }
            .action-buttons .btn {
                margin-bottom: 0.5rem;
            }
            .action-buttons .btn + .btn {
                margin-left: 0.5rem;
            }
            .modal-body, .modal-footer {
                text-align: left;
            }
            .pagination .page-link:hover {
                background-color: #343a40;
                color: #fff;
            }
            .input-group .form-control {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
            }
            .input-group .input-group-append .btn {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
            }
        </style>
    </head>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <h3>Prodi</h3>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="container">
                <div class="row mb-3 d-flex justify-content-between">
                    <div class="col-12 col-md-9 mb-2 mb-md-0">
                        <button class="btn btn-primary me-2" data-toggle="modal" data-target="#createModal">
                            <i class="fa fa-plus"></i> Tambah Data
                        </button>
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
                                            <a href="?sort=nama_prodi&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Nama Prodi
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nama_prodi' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=ketua_prodi&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Ketua Prodi
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'ketua_prodi' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prodis as $index => $prodi)
                                    <tr>
                                        <td>{{ $index + 1 + ($prodis->currentPage() - 1) * $prodis->perPage() }}</td>
                                        <td>{{ $prodi->nama_prodi }}</td>
                                        <td>{{ $prodi->ketua_prodi }}</td>
                                        <td class="action-buttons">
                                            <button class="btn btn-warning ms-2" data-toggle="modal"
                                                data-target="#editModal{{ $prodi->id }}"
                                                onclick="editProdi({{ $prodi->id }}, '{{ $prodi->nama_prodi }}', '{{ $prodi->ketua_prodi }}')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $prodi->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $prodi->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $prodi->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title font-weight-bold"
                                                                id="editModalLabel{{ $prodi->id }}">Edit Prodi</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm{{ $prodi->id }}"
                                                                action="{{ route('prodi.update', $prodi->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nama_prodi{{ $prodi->id }}"
                                                                        class="font-weight-bold">Nama Prodi</label>
                                                                    <input type="text"
                                                                        class="form-control rounded"
                                                                        id="edit_nama_prodi{{ $prodi->id }}"
                                                                        name="nama_prodi" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_ketua_prodi{{ $prodi->id }}"
                                                                        class="font-weight-bold">Ketua Prodi</label>
                                                                    <select class="form-control rounded"
                                                                        id="edit_ketua_prodi{{ $prodi->id }}"
                                                                        name="ketua_prodi" required>
                                                                        @foreach($dosens as $dosen)
                                                                            <option value="{{ $dosen->nidn }}">{{ $dosen->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                id="edit_submit{{ $prodi->id }}">Ubah</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $prodi->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel{{ $prodi->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $prodi->id }}">Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda Yakin Ingin Menghapus Data
                                                            "{{ $prodi->nama_prodi }}"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <form action="{{ route('prodi.destroy', $prodi->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
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
                                {{ $prodis->links() }}
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
                                <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah Prodi</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="{{ route('prodi.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nama_prodi" class="font-weight-bold">Nama Prodi</label>
                                        <input type="text" class="form-control rounded" id="nama_prodi" name="nama_prodi" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="ketua_prodi" class="font-weight-bold">Ketua Prodi</label>
                                        <select class="form-control rounded" id="ketua_prodi" name="ketua_prodi" required>
                                            @foreach($dosens as $dosen)
                                                <option value="{{ $dosen->nidn }}">{{ $dosen->nama }}</option>
                                            @endforeach
                                        </select>
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

                    $('.edit-modal').on('hidden.bs.modal', function () {
                        $(this).find('form')[0].reset();
                    });

                    window.editProdi = function (id, nama_prodi, ketua_prodi) {
                        $('#edit_nama_prodi' + id).val(nama_prodi);
                        $('#edit_ketua_prodi' + id).val(ketua_prodi);
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

</x-app-layout>
