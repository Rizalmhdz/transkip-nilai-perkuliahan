<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori Matkul') }}
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
                    <h3>Kategori Matkul</h3>
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
                                            <a href="?sort=nama_kategori&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Nama Kategori
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nama_kategori' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=kode_kategori&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Kode Kategori
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'kode_kategori' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategori_matkuls as $index => $kategori_matkul)
                                    <tr>
                                        <td>{{ $index + 1 + ($kategori_matkuls->currentPage() - 1) * $kategori_matkuls->perPage() }}</td>
                                        <td>{{ $kategori_matkul->nama_kategori }}</td>
                                        <td>{{ $kategori_matkul->kode_kategori }}</td>
                                        <td class="action-buttons">
                                            <button class="btn btn-warning ms-2" data-toggle="modal"
                                                data-target="#editModal{{ $kategori_matkul->id }}"
                                                onclick="editKategoriMatkul({{ $kategori_matkul->id }}, '{{ $kategori_matkul->nama_kategori }}', '{{ $kategori_matkul->kode_kategori }}')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $kategori_matkul->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $kategori_matkul->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $kategori_matkul->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title font-weight-bold"
                                                                id="editModalLabel{{ $kategori_matkul->id }}">Edit Kategori Matkul</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm{{ $kategori_matkul->id }}"
                                                                action="{{ route('kategori-matkul.update', $kategori_matkul->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nama_kategori{{ $kategori_matkul->id }}"
                                                                        class="font-weight-bold">Nama Kategori</label>
                                                                    <input type="text"
                                                                        class="form-control rounded"
                                                                        id="edit_nama_kategori{{ $kategori_matkul->id }}"
                                                                        name="nama_kategori" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_kode_kategori{{ $kategori_matkul->id }}"
                                                                        class="font-weight-bold">Kode Kategori</label>
                                                                    <input type="text"
                                                                        class="form-control rounded"
                                                                        id="edit_kode_kategori{{ $kategori_matkul->id }}"
                                                                        name="kode_kategori" required>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                id="edit_submit{{ $kategori_matkul->id }}">Ubah</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $kategori_matkul->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel{{ $kategori_matkul->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $kategori_matkul->id }}">Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda Yakin Ingin Menghapus Data
                                                            "{{ $kategori_matkul->nama_kategori }}"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <form action="{{ route('kategori-matkul.destroy', $kategori_matkul->id) }}"
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
                        <div class="d-flex justify-content-between">
                            <div>
                                {{ $kategori_matkuls->links() }}
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
                                <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah Kategori Matkul</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="{{ route('kategori-matkul.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nama_kategori" class="font-weight-bold">Nama Kategori</label>
                                        <input type="text" class="form-control rounded" id="nama_kategori" name="nama_kategori" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="kode_kategori" class="font-weight-bold">Kode Kategori</label>
                                        <input type="text" class="form-control rounded" id="kode_kategori" name="kode_kategori" required>
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

                    window.editKategoriMatkul = function (id, nama_kategori, kode_kategori) {
                        $('#edit_nama_kategori' + id).val(nama_kategori);
                        $('#edit_kode_kategori' + id).val(kode_kategori);
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
