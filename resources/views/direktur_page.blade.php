<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Direktur') }}
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
            .btn {
                font-size: 0.875rem;
                padding: 0.375rem 0.75rem;
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
                                            <a href="?sort=nidn&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                NIDN
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nidn' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($direkturs as $index => $direktur)
                                    <tr>
                                        <td>{{ $index + 1 + ($direkturs->currentPage() - 1) * $direkturs->perPage() }}</td>
                                        <td>{{ $direktur->nidn }}</td>
                                        <td>{{ $direktur->dosen->nama }}</td>
                                        <td class="action-buttons">
                                            <button class="btn btn-warning ms-2" data-toggle="modal"
                                                data-target="#editModal{{ $direktur->id }}"
                                                onclick="editDirektur({{ $direktur->id }}, '{{ $direktur->nidn }}')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $direktur->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $direktur->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $direktur->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title font-weight-bold"
                                                                id="editModalLabel{{ $direktur->id }}">Edit Direktur</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm{{ $direktur->id }}"
                                                                action="{{ route('direktur.update', $direktur->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nidn{{ $direktur->id }}"
                                                                        class="font-weight-bold">NIDN - Dosen</label>
                                                                    <select class="form-control rounded"
                                                                        id="edit_nidn{{ $direktur->id }}"
                                                                        name="nidn" required>
                                                                        @foreach($dosens as $dosen)
                                                                            <option value="{{ $dosen->nidn }}">{{ $dosen->nidn }} - {{ $dosen->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                id="edit_submit{{ $direktur->id }}">Ubah</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $direktur->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel{{ $direktur->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $direktur->id }}">Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda Yakin Ingin Menghapus Data
                                                            "{{ $direktur->nidn }}"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <form action="{{ route('direktur.destroy', $direktur->id) }}"
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
                            {{ $direkturs->links() }}
                        </div>
                    </div>
                </div>

                <!-- Create Modal -->
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah Direktur</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="{{ route('direktur.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nidn" class="font-weight-bold">NIDN - Dosen</label>
                                        <select class="form-control rounded" id="nidn" name="nidn" required>
                                            @foreach($dosens as $dosen)
                                                <option value="{{ $dosen->nidn }}">{{ $dosen->nidn }} - {{ $dosen->nama }}</option>
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

                    window.editDirektur = function (id, nidn) {
                        $('#edit_nidn' + id).val(nidn);
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
