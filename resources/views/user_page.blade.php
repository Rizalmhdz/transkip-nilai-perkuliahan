<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
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
                                            <a href="?sort=name&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Nama
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'name' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=email&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Email
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'email' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        {{-- <th>
                                            <a href="?sort=level&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Level
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'level' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        {{-- <td>{{ $user->level }}</td> --}}
                                        <td class="action-buttons">
                                            <button class="btn btn-warning ms-2" data-toggle="modal"
                                                data-target="#editModal{{ $user->id }}"
                                                onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $user->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $user->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title font-weight-bold"
                                                                id="editModalLabel{{ $user->id }}">Edit User</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm{{ $user->id }}"
                                                                action="{{ route('user.update', $user->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_name{{ $user->id }}"
                                                                        class="font-weight-bold">Nama</label>
                                                                    <input type="text"
                                                                        class="form-control rounded"
                                                                        id="edit_name{{ $user->id }}"
                                                                        name="name" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_email{{ $user->id }}"
                                                                        class="font-weight-bold">Email</label>
                                                                    <input type="email"
                                                                        class="form-control rounded"
                                                                        id="edit_email{{ $user->id }}"
                                                                        name="email" required>
                                                                </div>
                                                                {{-- <div class="form-group mb-3">
                                                                    <label for="edit_level{{ $user->id }}"
                                                                        class="font-weight-bold">Level</label>
                                                                    <select class="form-control rounded"
                                                                        id="edit_level{{ $user->id }}"
                                                                        name="level" required>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div> --}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                id="edit_submit{{ $user->id }}">Ubah</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel{{ $user->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $user->id }}">Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda Yakin Ingin Menghapus Data
                                                            "{{ $user->name }}"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <form action="{{ route('user.destroy', $user->id) }}"
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
                                {{ $users->links() }}
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
                                <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah User</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="{{ route('user.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name" class="font-weight-bold">Nama</label>
                                        <input type="text" class="form-control rounded" id="name" name="name" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email" class="font-weight-bold">Email</label>
                                        <input type="email" class="form-control rounded" id="email" name="email" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="font-weight-bold">Password</label>
                                        <input type="password" class="form-control rounded" id="password" name="password" required>
                                    </div>
                                    {{-- <div class="form-group mb-3">
                                        <label for="level" class="font-weight-bold">Level</label>
                                        <select class="form-control rounded" id="level" name="level" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div> --}}
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

                    window.editUser = function (id, name, email) {
                        $('#edit_name' + id).val(name);
                        $('#edit_email' + id).val(email);
                        // $('#edit_level' + id).val(level);
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
