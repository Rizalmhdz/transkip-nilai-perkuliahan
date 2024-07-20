<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dosen') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <!-- Dashboard Info Section -->
            @if ($authority_level == 2)
                <div class="flex flex-wrap justify-around bg-white p-6 rounded-lg shadow-md mb-6">
                    <div class="flex items-center justify-center p-4 m-2 bg-blue-100 rounded-lg">
                        <div class="text-center">
                            <div class="text-4xl font-bold">👨‍🎓</div>
                            <div class="text-4xl font-bold">{{ $mahasiswaBimbinganAkademik }}</div>
                            <div class="text-sm text-gray-600">Mahasiswa Bimbingan Akademik</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center p-4 m-2 bg-green-100 rounded-lg">
                        <div class="text-center">
                            <div class="text-4xl font-bold">📚</div>
                            <div class="text-4xl font-bold">{{ $mataKuliahDiampu }}</div>
                            <div class="text-sm text-gray-600">Mata Kuliah Diampu</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center p-4 m-2 bg-yellow-100 rounded-lg">
                        <div class="text-center">
                            <div class="text-4xl font-bold">📜</div>
                            <div class="text-4xl font-bold">{{ $mahasiswaBimbinganKaryaTulis }}</div>
                            <div class="text-sm text-gray-600">Mahasiswa Bimbingan Karya Tulis</div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Dosen Prodi Section -->
            <div class="container">
                <div class="row mb-3 d-flex justify-content-between">
                    <div class="col-12 col-md-9 mb-2 mb-md-0">
                        @if ($authority_level == 1)
                            <button class="btn btn-primary me-2" data-toggle="modal" data-target="#createModal">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                            <button class="btn btn-secondary me-2" data-toggle="modal" data-target="#filterModal">
                                <i class="fa fa-filter"></i> Filter
                            </button>
                        @else
                            <h2 class="font-semibold text-sm text-gray-600 leading-tight align-text-bottom">
                                # Berikut Program Studi Tempat Anda Terdaftar
                            </h2>
                        @endif
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
                                        <th>
                                            <a>
                                                Nama
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=prodi&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Prodi
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'prodi' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        @if ($authority_level == 1)
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dosen_prodis as $index => $dosen_prodi)
                                    <tr>
                                        <td>{{ $index + 1 + ($dosen_prodis->currentPage() - 1) * $dosen_prodis->perPage() }}</td>
                                        <td>{{ $dosen_prodi->nidn }}</td>
                                        <td>
                                            @foreach($dosens as $dosen)
                                                {{ $dosen->nidn == $dosen_prodi->nidn ?  $dosen->nama : ''}}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($prodis as $prodi)
                                                {{ $dosen_prodi->prodi == $prodi->id ?  $prodi->nama_prodi : ''}}
                                            @endforeach
                                        </td>
                                        @if ($authority_level == 1)
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
                                                                            class="font-weight-bold">NIDN</label>
                                                                        <select class="form-control rounded"
                                                                            id="edit_nidn{{ $dosen_prodi->id }}"
                                                                            name="nidn" required>
                                                                            @foreach($dosens as $dosen)
                                                                                <option value="{{ $dosen->nidn }}">{{ $dosen->nama }}</option>
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
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 mb-2">
                            {{ $dosen_prodis->links() }}
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
                                        <label for="nidn" class="font-weight-bold">NIDN</label>
                                        <select class="form-control rounded" id="nidn" name="nidn" required>
                                            @foreach($dosens as $dosen)
                                                <option value="{{ $dosen->nidn }}">{{ $dosen->nama }}</option>
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

                <!-- Notification Modal -->
                @if(session('success'))
                <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title text-center font-weight-bold" id="notificationModalLabel">Notifikasi</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ session('success') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#notificationModal').modal('show');
                    });
                </script>
                @endif

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
                });
                </script>

            </div>
        </div>
</x-app-layout>
