<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dosen') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <!-- Dashboard Info Section -->
                <div class="flex flex-wrap justify-around bg-white p-6 rounded-lg shadow-md mb-6">
                    <div class="flex items-center justify-center p-4 m-2 bg-blue-100 rounded-lg w-1/3">
                        <div class="text-center">
                            <div class="text-4xl font-bold">👨‍🎓</div>
                            <div class="text-4xl font-bold">{{ $mahasiswaBimbinganAkademik }}</div>
                            <div class="text-sm text-gray-600">Mahasiswa Bimbingan Akademik</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center p-4 m-2 bg-green-100 rounded-lg w-1/3">
                        <div class="text-center">
                            <div class="text-4xl font-bold">📚</div>
                            <div class="text-4xl font-bold">{{ $mataKuliahDiampu }}</div>
                            <div class="text-sm text-gray-600">Mata Kuliah Diampu</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center p-4 m-2 bg-yellow-100 rounded-lg w-1/3">
                        <div class="text-center">
                            <div class="text-4xl font-bold">📜</div>
                            <div class="text-4xl font-bold">{{ $mahasiswaBimbinganKaryaTulis }}</div>
                            <div class="text-sm text-gray-600">Mahasiswa Bimbingan Karya Tulis</div>
                        </div>
                    </div>
                </div>

                <!-- Laporan Semua Tabel -->
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
                                                    {{ $dosen->nidn == $dosen_prodi->nidn ?  $dosen->nama : ''}}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($prodis as $prodi)
                                                    {{ $dosen_prodi->prodi == $prodi->id ?  $prodi->nama_prodi : ''}}
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
                </div>
    

        </div>
    </div>

</x-app-layout>
