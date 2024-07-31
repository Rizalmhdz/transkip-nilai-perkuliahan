<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dosen') }}
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

            .btn {
                font-size: 0.875rem;
                padding: 0.375rem 0.75rem;
            }

            .invalid-feedback {
                display: none;
                color: red;
            }

            .is-invalid {
                border-color: red;
            }
        </style>
    </head>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="container">
                <!-- Success Modal -->
                <button id="successBtn" type="button" class="d-none" data-toggle="modal" data-target="#successModal">Sukses</button>
                <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                    aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    onclick="$('#successModal').hide();
                                   $('.modal-backdrop.fade.show').hide();">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ session('success') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#successModal').hide();
                                   $('.modal-backdrop.fade.show').hide();">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Failed Modal -->
                <button id="failedBtn" type="button" class="d-none" data-toggle="modal" data-target="#failedModal">Gagal</button>
                <div class="modal fade" id="failedModal" tabindex="-1" role="dialog"
                    aria-labelledby="failedModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="failedModalLabel">Gagal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    onclick="$('#failedModal').hide();
                                   $('.modal-backdrop.fade.show').hide();">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ session('error') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#failedModal').hide();
                                   $('.modal-backdrop.fade.show').hide();">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

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
                                            <a href="?sort=nama&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Nama
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nama' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=nidn&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                NIDN
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nidn' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=email_dosen&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Email
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'email_dosen' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dosens as $index => $dosen)
                                    <tr>
                                        <td>{{ $index + 1 + ($dosens->currentPage() - 1) * $dosens->perPage() }}</td>
                                        <td>{{ $dosen->nama }}</td>
                                        <td>{{ $dosen->nidn }}</td>
                                        <td>{{ $dosen->email_dosen }}</td>
                                        <td class="action-buttons">
                                            <button class="btn btn-warning ms-2" data-toggle="modal"
                                                data-target="#editModal{{ $dosen->id }}"
                                                onclick="editDosen({{ $dosen->id }}, '{{ $dosen->nama }}', '{{ $dosen->nidn }}', '{{ $dosen->email_dosen }}')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $dosen->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $dosen->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $dosen->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title font-weight-bold"
                                                                id="editModalLabel{{ $dosen->id }}">Edit Dosen</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm{{ $dosen->id }}"
                                                                action="{{ route('dosen.update', $dosen->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nama{{ $dosen->id }}"
                                                                        class="font-weight-bold">Nama</label>
                                                                    <input type="text"
                                                                        class="form-control rounded"
                                                                        id="edit_nama{{ $dosen->id }}"
                                                                        name="nama" value="{{ $dosen->nama }}" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nidn{{ $dosen->id }}"
                                                                        class="font-weight-bold">NIDN - Dosen</label>
                                                                    <input type="text"
                                                                        class="form-control rounded"
                                                                        id="edit_nidn{{ $dosen->id }}"
                                                                        name="nidn" value="{{ $dosen->nidn }}" required>
                                                                    <div class="invalid-feedback"
                                                                        id="edit_nidn_feedback{{ $dosen->id }}">
                                                                        NIDN harus berupa angka dan harus 10 karakter.
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_email_dosen{{ $dosen->id }}"
                                                                        class="font-weight-bold">Email</label>
                                                                    <input type="email"
                                                                        class="form-control rounded"
                                                                        id="edit_email_dosen{{ $dosen->id }}"
                                                                        name="email_dosen" value="{{ $dosen->email_dosen }}" required>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                id="edit_submit{{ $dosen->id }}">Ubah</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $dosen->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel{{ $dosen->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $dosen->id }}">Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda Yakin Ingin Menghapus Data
                                                            "{{ $dosen->nama }}"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <form action="{{ route('dosen.destroy', $dosen->id) }}"
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
                                {{ $dosens->links() }}
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
                                <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah Dosen</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="{{ route('dosen.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nama" class="font-weight-bold">Nama</label>
                                        <input type="text" class="form-control rounded" id="nama" name="nama" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nidn" class="font-weight-bold">NIDN - Dosen</label>
                                        <input type="text" class="form-control rounded" id="nidn" name="nidn" required>
                                        <div class="invalid-feedback" id="nidn_feedback">NIDN harus berupa angka dan
                                            harus 10 karakter.</div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email_dosen" class="font-weight-bold">Email</label>
                                        <input type="email" class="form-control rounded" id="email_dosen" name="email_dosen" required>
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
                        $('#nidn').removeClass('is-invalid');
                        $('#nidn_feedback').hide();
                        $('#create_submit').prop('disabled', false);
                    });

                    $('#editModal').on('hidden.bs.modal', function () {
                        $(this).find('form')[0].reset();
                        $('[id^=edit_nidn]').removeClass('is-invalid');
                        $('[id^=edit_nidn_feedback]').hide();
                        $('button[type="submit"]').prop('disabled', false);
                    });

                    window.editDosen = function (id, nama, nidn, email_dosen) {
                        $('#edit_nama' + id).val(nama);
                        $('#edit_nidn' + id).val(nidn);
                        $('#edit_email_dosen' + id).val(email_dosen);
                    }

                    $('#searchButton').on('click', function () {
                        const keyword = $('#searchKeyword').val().toLowerCase();
                        $('table tbody tr').filter(function () {
                            $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1)
                        });
                    });

                    // Validasi NIDN
                    $('#nidn').on('input', function () {
                        const nidn = $(this).val();
                        const isValid = /^\d{10}$/.test(nidn);
                        if (isValid) {
                            $(this).removeClass('is-invalid');
                            $('#nidn_feedback').hide();
                            $('#create_submit').prop('disabled', false);
                        } else {
                            $(this).addClass('is-invalid');
                            $('#nidn_feedback').show();
                            $('#create_submit').prop('disabled', true);
                        }
                    });

                    $('[id^=edit_nidn]').on('input', function () {
                        const id = $(this).attr('id').replace('edit_nidn', '');
                        const nidn = $(this).val();
                        const isValid = /^\d{10}$/.test(nidn);
                        if (isValid) {
                            $(this).removeClass('is-invalid');
                            $('#edit_nidn_feedback' + id).hide();
                            $('#edit_submit' + id).prop('disabled', false);
                        } else {
                            $(this).addClass('is-invalid');
                            $('#edit_nidn_feedback' + id).show();
                            $('#edit_submit' + id).prop('disabled', true);
                        }
                    });

                    @if(session('success'))
                        $('#successBtn').trigger('click');
                    @endif

                    @if(session('error'))
                        $('#failedBtn').trigger('click');
                    @endif
                });
                </script>

            </div>
        </div>
    </div>
</x-app-layout>
