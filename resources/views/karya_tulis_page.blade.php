<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Karya Tulis') }}
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
                    <div class="col-12 col-md-9 mb-2 mb-md-0">
                        <button class="btn btn-primary me-2" data-toggle="modal" data-target="#createModal">
                            <i class="fa fa-plus"></i> Tambah Data
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
                                            <a href="?sort=judul&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Judul
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'judul' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=nim&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Penulis
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'Penulis' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=nim&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                NIM
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nim' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=pembimbing&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Pembimbing
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'pembimbing' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        
                                            <th>Aksi</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($karya_tuliss as $index => $karya_tulis)
                                    <tr>
                                        <td>{{ $index + 1 + ($karya_tuliss->currentPage() - 1) * $karya_tuliss->perPage() }}</td>
                                        <td>{{ $karya_tulis->judul }}</td>
                                        <td>
                                            @foreach($mahasiswas as $index => $mahasiswa)
                                                {{  $mahasiswa->nim === $karya_tulis->nim ? $mahasiswa->nama_lengkap : ''}}
                                            @endforeach
                                        </td>
                                        <td>{{ $karya_tulis->nim }}</td>
                                         <td>
                                            @foreach($dosens as $index => $dosen)
                                                    {{  $dosen->nidn === $karya_tulis->pembimbing ? $dosen->nama : ''}}
                                                @endforeach
                                            </td>
                                        
                                       
                                            <td class="action-buttons">
                                                <button class="btn btn-warning ms-2" data-toggle="modal"
                                                    data-target="#editModal{{ $karya_tulis->id }}"
                                                    onclick="editKaryaTulis({{ $karya_tulis->id }}, '{{ $karya_tulis->judul }}', '{{ $karya_tulis->nim }}', '{{ $karya_tulis->pembimbing }}')">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal{{ $karya_tulis->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal{{ $karya_tulis->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="editModalLabel{{ $karya_tulis->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title font-weight-bold"
                                                                    id="editModalLabel{{ $karya_tulis->id }}">Edit Karya Tulis</h3>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="editForm{{ $karya_tulis->id }}"
                                                                    action="{{ route('karya-tulis.update', $karya_tulis->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group mb-3">
                                                                        <label for="edit_judul{{ $karya_tulis->id }}"
                                                                            class="font-weight-bold">Judul</label>
                                                                        <input type="text"
                                                                            class="form-control rounded"
                                                                            id="edit_judul{{ $karya_tulis->id }}"
                                                                            name="judul" required>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="edit_nim{{ $karya_tulis->id }}"
                                                                            class="font-weight-bold">NIM</label>
                                                                        <select class="form-control rounded" id="edit_nim{{ $karya_tulis->id }}" name="nim" required>
                                                                            @foreach($mahasiswas as $mahasiswa)
                                                                                <option value="{{ $mahasiswa->nim }}">{{ $mahasiswa->nim }} - {{ $mahasiswa->nama_lengkap }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <a href="{{ route('mahasiswa.index') }}" class="related-link">Tambahkan Mahasiswa baru</a>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="edit_pembimbing{{ $karya_tulis->id }}"
                                                                            class="font-weight-bold">Pembimbing</label>
                                                                        <select class="form-control rounded" id="edit_pembimbing{{ $karya_tulis->id }}" name="pembimbing" required>
                                                                            @foreach($dosens as $dosen)
                                                                                <option value="{{ $dosen->nidn }}">{{ $dosen->nama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <a href="{{ route('dosen.index') }}" class="related-link">Tambahkan Dosen baru</a>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batalkan</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    id="edit_submit{{ $karya_tulis->id }}">Ubah</button>
                                                            </div>
                                                                </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal{{ $karya_tulis->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="deleteModalLabel{{ $karya_tulis->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $karya_tulis->id }}">Konfirmasi
                                                                    Penghapusan</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda Yakin Ingin Menghapus Data "<strong>{{ $karya_tulis->judul }}</strong>"?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batalkan</button>
                                                                <form action="{{ route('karya-tulis.destroy', $karya_tulis->id) }}"
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
                                {{ $karya_tuliss->links() }}
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
                                <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah Karya Tulis</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="{{ route('karya-tulis.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="judul" class="font-weight-bold">Judul</label>
                                        <input type="text" class="form-control rounded" id="judul" name="judul" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nim" class="font-weight-bold">NIM</label>
                                        <select class="form-control rounded" id="nim" name="nim" required>
                                            @foreach($mahasiswas as $mahasiswa)
                                                <option value="{{ $mahasiswa->nim }}">{{ $mahasiswa->nim }} - {{ $mahasiswa->nama_lengkap }}</option>
                                            @endforeach
                                        </select>
                                        <a href="{{ route('mahasiswa.index') }}" class="related-link">Tambahkan Mahasiswa baru</a>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pembimbing" class="font-weight-bold">Pembimbing</label>
                                        <select class="form-control rounded" id="pembimbing" name="pembimbing" required>
                                            @foreach($dosens as $dosen)
                                                <option value="{{ $dosen->nidn }}">{{ $dosen->nama }}</option>
                                            @endforeach
                                        </select>
                                        <a href="{{ route('dosen.index') }}" class="related-link">Tambahkan Dosen baru</a>
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

                    window.editKaryaTulis = function (id, judul, nim, pembimbing) {
                        $('#edit_judul' + id).val(judul);
                        $('#edit_nim' + id).val(nim);
                        $('#edit_pembimbing' + id).val(pembimbing);
                    }

                    $('#searchButton').on('click', function () {
                        const keyword = $('#searchKeyword').val().toLowerCase();
                        $('table tbody tr').filter(function () {
                            $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1)
                        });
                    });

                    @if(session('success'))
                        $('#successBtn').click();
                    @endif

                    @if(session('error'))
                        $('#errorBtn').click();
                    @endif
                });
                </script>

            </div>
        </div>

</x-app-layout>
