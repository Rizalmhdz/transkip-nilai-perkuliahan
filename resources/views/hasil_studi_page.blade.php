<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Studi') }}
        </h2>
    </x-slot>

    <head>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="container">
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
                        
                        <button type="button" class="btn btn-outline-dark me-2"> Total Data : {{ $total }}</button>
                        @if($isPrint)
                        {{-- <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('cetak-rekap-nilai', ['nim' => $mahasiswas[0]->nim]) }}'"> --}}
                        <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('cetak-rekap-nilai', ['nim' => $nim]) }}'">
                            <i class="fa fa-print me-2"></i> CETAK REKAP NILAI</button>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <div class="table-responsive mb-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NIM</th>
                                        <th>
                                            <a href="?sort=nilai&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Nilai
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nilai' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>Angka</th>
                                        <th>SKS</th>
                                        <th>Mata Kuliah</th>
                                        <th>Dosen Pengampu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hasil_studis as $index => $hasil_studi)
                                    <tr>
                                        <td>{{ $index + 1 + ($hasil_studis->currentPage() - 1) * $hasil_studis->perPage() }}</td>
                                        <td>{{ $hasil_studi->mahasiswa->nama_lengkap }}</td>
                                        <td>{{ $hasil_studi->nim }}</td>
                                        <td>{{ $hasil_studi->nilai }}</td>
                                        <td>
                                            @switch($hasil_studi->nilai)
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
                                                @default
                                                    E
                                            @endswitch
                                        </td>
                                        
                                        <td>{{ $hasil_studi->mataKuliah->sks }}</td>
                                        <td>{{ $hasil_studi->mataKuliah->nama_mata_kuliah }}</td>
                                        <td>{{ $hasil_studi->mataKuliah->dosen->nama }}</td>
                                        <td class="action-buttons">
                                            <button class="btn btn-warning ms-2" data-toggle="modal"
                                                data-target="#editModal{{ $hasil_studi->id }}"
                                                onclick="editHasilStudi({{ $hasil_studi->id }}, '{{ $hasil_studi->nilai }}')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal{{ $hasil_studi->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $hasil_studi->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $hasil_studi->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title font-weight-bold"
                                                                id="editModalLabel{{ $hasil_studi->id }}">Edit Hasil Studi</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm{{ $hasil_studi->id }}"
                                                                action="{{ route('hasil-studi.update', $hasil_studi->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                    <div class="form-group mb-3">
                                                                        <label for="edit_id_mata_kuliah{{ $hasil_studi->id }}"
                                                                            class="font-weight-bold">Mata Kuliah</label>
                                                                        <select class="form-control rounded"
                                                                            id="edit_id_mata_kuliah{{ $hasil_studi->id }}"
                                                                            name="id_mata_kuliah" required>
                                                                            @foreach($mata_kuliahs as $mataKuliah)
                                                                                <option value="{{ $mataKuliah->id }}" {{ $hasil_studi->id_mata_kuliah == $mataKuliah->id ? 'selected' : '' }}>{{ $mataKuliah->nama_mata_kuliah }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <a href="{{ route('mata-kuliah.create') }}" class="related-link">Tambahkan Mata Kuliah baru</a>
                                                                    </div>
                                                                    <div class="form-group mb-3">
                                                                        <label for="edit_nim{{ $hasil_studi->id }}"
                                                                            class="font-weight-bold">Mahasiswa</label>
                                                                        <select class="form-control rounded"
                                                                            id="edit_nim{{ $hasil_studi->id }}"
                                                                            name="nim" required>
                                                                            @foreach($mahasiswas as $mahasiswa)
                                                                                <option value="{{ $mahasiswa->nim }}" {{ $hasil_studi->nim == $mahasiswa->nim ? 'selected' : '' }}>{{ $mahasiswa->nama_lengkap }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <a href="{{ route('mahasiswa.create') }}" class="related-link">Tambahkan Mahasiswa baru</a>
                                                                    </div>
                                                    
                                                                <div class="form-group mb-3">
                                                                    <label for="edit_nilai{{ $hasil_studi->id }}"
                                                                        class="font-weight-bold">Nilai</label>
                                                                    <select class="form-control rounded"
                                                                        id="edit_nilai{{ $hasil_studi->id }}"
                                                                        name="nilai" required>
                                                                        <option value="4" {{ $hasil_studi->nilai == '4' ? 'selected' : '' }}>A - 4</option>
                                                                        <option value="3" {{ $hasil_studi->nilai == '3' ? 'selected' : '' }}>B - 3</option>
                                                                        <option value="2" {{ $hasil_studi->nilai == '2' ? 'selected' : '' }}>C - 2</option>
                                                                        <option value="1" {{ $hasil_studi->nilai == '1' ? 'selected' : '' }}>D - 1</option>
                                                                        <option value="0" {{ $hasil_studi->nilai == '0' ? 'selected' : '' }}>E - 0</option>
                                                                    </select>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batalkan</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                id="edit_submit{{ $hasil_studi->id }}">Ubah</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal{{ $hasil_studi->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="deleteModalLabel{{ $hasil_studi->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $hasil_studi->id }}">Konfirmasi
                                                                    Penghapusan</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda Yakin Ingin Menghapus Data
                                                                "<strong>{{ $hasil_studi->mataKuliah->nama_mata_kuliah }}</strong>"?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batalkan</button>
                                                                <form action="{{ route('hasil-studi.destroy', $hasil_studi->id) }}"
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
                                {{ $hasil_studis->links() }}
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
                                    <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah Hasil Studi</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="createForm" action="{{ route('hasil-studi.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="id_mata_kuliah" class="font-weight-bold">Mata Kuliah</label>
                                            <select class="form-control rounded" id="id_mata_kuliah" name="id_mata_kuliah" required>
                                                @foreach($mata_kuliahs as $mataKuliah)
                                                    <option value="{{ $mataKuliah->id }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                                                @endforeach
                                            </select>
                                            <a href="{{ route('mata-kuliah.create') }}" class="related-link">Tambahkan Mata Kuliah baru</a>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nim" class="font-weight-bold">Mahasiswa</label>
                                            <select class="form-control rounded" id="nim" name="nim" required>
                                                @foreach($mahasiswas as $mahasiswa)
                                                    <option value="{{ $mahasiswa->nim }}">{{ $mahasiswa->nama_lengkap }}</option>
                                                @endforeach
                                            </select>
                                            <a href="{{ route('mahasiswa.create') }}" class="related-link">Tambahkan Mahasiswa baru</a>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nilai" class="font-weight-bold">Nilai</label>
                                            <select class="form-control rounded" id="nilai" name="nilai" required>
                                                <option value="4">A - 4</option>
                                                <option value="3">B - 3</option>
                                                <option value="2">C - 2</option>
                                                <option value="1">D - 1</option>
                                                <option value="0">E - 0</option>
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

                    window.editHasilStudi = function (id, nilai) {
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

</x-app-layout>
