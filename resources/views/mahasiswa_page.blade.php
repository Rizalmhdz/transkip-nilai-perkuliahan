<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mahasiswa') }}
        </h2>
    </x-slot>

    <head>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                                            <a href="?sort=nim&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                NIM
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nim' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=nama_lengkap&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Nama Lengkap
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nama_lengkap' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=tempat_lahir&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                TTL
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'tempat_lahir' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=angkatan&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Angkatan
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'angkatan' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=prodi&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Prodi
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'prodi' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=tahun_lulus&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Tahun Lulus
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'tahun_lulus' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=tanggal_yudisium&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Tanggal Yudisium
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'tanggal_yudisium' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=dosen_akademik&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Dosen Akademik
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'dosen_akademik' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mahasiswas as $index => $mahasiswa)
                                    <tr>
                                        <td>{{ $index + 1 + ($mahasiswas->currentPage() - 1) * $mahasiswas->perPage() }}</td>
                                        <td>{{ $mahasiswa->nim }}</td>
                                        <td>{{ $mahasiswa->nama_lengkap }}</td>
                                        <td>{{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir }}</td>
                                        <td>{{ $mahasiswa->angkatan }}</td>
                                        <td>
                                            @foreach ($prodis as $prodi )
                                                {{ $mahasiswa->prodi == $prodi->id ? $prodi->nama_prodi : ''}}
                                            @endforeach
                                        </td>
                                        <td>{{ $mahasiswa->tahun_lulus ?? 'Belum lulus' }}</td>
                                        <td>{{ $mahasiswa->tanggal_yudisium ?? 'Belum lulus' }}</td>
                                        <td>
                                            @foreach($dosens as $dosen)
                                                {{ $dosen->nidn == $mahasiswa->dosen_akademik ?  $dosen->nama : ''}}
                                            @endforeach
                                        </td>
                                        <td class="action-buttons">
                                                <button class="btn btn-warning ms-2" data-toggle="modal"
                                                    data-target="#editModal{{ $mahasiswa->id }}"
                                                    onclick="editMahasiswa({{ $mahasiswa->id }}, '{{ $mahasiswa->nim }}', '{{ $mahasiswa->nama_lengkap }}', '{{ $mahasiswa->tempat_lahir }}', '{{ $mahasiswa->tanggal_lahir }}', '{{ $mahasiswa->angkatan }}', '{{ $mahasiswa->dosen_akademik }}', '{{ $mahasiswa->prodi }}', '{{ $mahasiswa->tahun_lulus }}')">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal{{ $mahasiswa->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a href="{{ route('hasil-studi.index', ['nim' => $mahasiswa->nim, 'isPrint' => true]) }}" class="btn btn-info ms-2">
                                                    <i class="fa fa-eye"></i> Lihat Hasil Studi
                                                </a>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $mahasiswa->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $mahasiswa->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title font-weight-bold"
                                                                id="editModalLabel{{ $mahasiswa->id }}">Edit Mahasiswa</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm{{ $mahasiswa->id }}"
                                                                action="{{ route('mahasiswa.update', $mahasiswa->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nim{{ $mahasiswa->id }}"
                                                                        class="font-weight-bold">NIM</label>
                                                                    <input type="text"
                                                                        class="form-control rounded"
                                                                        id="edit_nim{{ $mahasiswa->id }}"
                                                                        name="nim" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nama_lengkap{{ $mahasiswa->id }}"
                                                                        class="font-weight-bold">Nama Lengkap</label>
                                                                    <input type="text"
                                                                        class="form-control rounded"
                                                                        id="edit_nama_lengkap{{ $mahasiswa->id }}"
                                                                        name="nama_lengkap" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_tempat_lahir{{ $mahasiswa->id }}"
                                                                        class="font-weight-bold">Tempat Lahir</label>
                                                                    <input type="text"
                                                                        class="form-control rounded"
                                                                        id="edit_tempat_lahir{{ $mahasiswa->id }}"
                                                                        name="tempat_lahir" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_tanggal_lahir{{ $mahasiswa->id }}"
                                                                        class="font-weight-bold">Tanggal Lahir</label>
                                                                    <input type="date"
                                                                        class="form-control rounded"
                                                                        id="edit_tanggal_lahir{{ $mahasiswa->id }}"
                                                                        name="tanggal_lahir" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_angkatan{{ $mahasiswa->id }}"
                                                                        class="font-weight-bold">Angkatan</label>
                                                                    <input type="number"
                                                                        class="form-control rounded"
                                                                        id="edit_angkatan{{ $mahasiswa->id }}"
                                                                        name="angkatan" required>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_dosen_akademik{{ $mahasiswa->id }}"
                                                                        class="font-weight-bold">Dosen Akademik</label>
                                                                    <select class="form-control rounded"
                                                                        id="edit_dosen_akademik{{ $mahasiswa->id }}"
                                                                        name="dosen_akademik" required>
                                                                        @foreach($dosens as $dosen)
                                                                            <option value="{{ $dosen->nidn }}">{{ $dosen->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <a href="{{ route('dosen.index') }}" class="related-link">Tambahkan Dosen baru</a>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_prodi{{ $mahasiswa->id }}"
                                                                        class="font-weight-bold">Prodi</label>
                                                                    <select class="form-control rounded"
                                                                        id="edit_prodi{{ $mahasiswa->id }}"
                                                                        name="prodi" required>
                                                                        @foreach($prodis as $prodi)
                                                                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_tahun_lulus{{ $mahasiswa->id }}"
                                                                        class="font-weight-bold">Tahun Lulus</label>
                                                                    <input type="number"
                                                                        class="form-control rounded"
                                                                        id="edit_tahun_lulus{{ $mahasiswa->id }}"
                                                                        name="tahun_lulus">
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                id="edit_submit{{ $mahasiswa->id }}">Ubah</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $mahasiswa->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel{{ $mahasiswa->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $mahasiswa->id }}">Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda Yakin Ingin Menghapus Data "<strong>{{ $mahasiswa->nama_lengkap }}</strong>"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}"
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
                                {{ $mahasiswas->links() }}
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
                                <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah Mahasiswa</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="{{ route('mahasiswa.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nim" class="font-weight-bold">NIM</label>
                                        <input type="text" class="form-control rounded" id="nim" name="nim" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama_lengkap" class="font-weight-bold">Nama Lengkap</label>
                                        <input type="text" class="form-control rounded" id="nama_lengkap" name="nama_lengkap" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tempat_lahir" class="font-weight-bold">Tempat Lahir</label>
                                        <input type="text" class="form-control rounded" id="tempat_lahir" name="tempat_lahir" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tanggal_lahir" class="font-weight-bold">Tanggal Lahir</label>
                                        <input type="date" class="form-control rounded" id="tanggal_lahir" name="tanggal_lahir" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="angkatan" class="font-weight-bold">Angkatan</label>
                                        <input type="number" class="form-control rounded" id="angkatan" name="angkatan" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="dosen_akademik" class="font-weight-bold">Dosen Akademik</label>
                                        <select class="form-control rounded" id="dosen_akademik" name="dosen_akademik" required>
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
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tahun_lulus" class="font-weight-bold">Tahun Lulus</label>
                                        <input type="number" class="form-control rounded" id="tahun_lulus" name="tahun_lulus">
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

                    window.editMahasiswa = function (id, nim, nama_lengkap, tempat_lahir, tanggal_lahir, angkatan, dosen_akademik, prodi, tahun_lulus) {
                        $('#edit_nim' + id).val(nim);
                        $('#edit_nama_lengkap' + id).val(nama_lengkap);
                        $('#edit_tempat_lahir' + id).val(tempat_lahir);
                        $('#edit_tanggal_lahir' + id).val(tanggal_lahir);
                        $('#edit_angkatan' + id).val(angkatan);
                        $('#edit_dosen_akademik' + id).val(dosen_akademik);
                        $('#edit_prodi' + id).val(prodi);
                        $('#edit_tahun_lulus' + id).val(tahun_lulus);
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
