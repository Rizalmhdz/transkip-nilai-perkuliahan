<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mata Kuliah') }}
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
                            <button class="btn btn-secondary me-2" data-toggle="modal" data-target="#filterModal">
                                <i class="fa fa-filter"></i> Filter
                            </button>
                    </div>
                    <div class="col-12 col-md-3 d-md-flex justify-content-end justify-content-md-end">
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
                                            <a href="?sort=nama_mata_kuliah&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Nama Mata Kuliah
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'nama_mata_kuliah' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=sks&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                SKS
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'sks' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="?sort=kategori_matkul&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                Kategori
                                                <i class="ms-3 fa fa-sort{{ request('sort') == 'kategori_matkul' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
                                            </a>
                                        </th>
                                            <th>
                                                <a href="?sort=dosen_pengampu&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                                                    Dosen Pengampu
                                                    <i class="ms-3 fa fa-sort{{ request('sort') == 'dosen_pengampu' ? (request('direction') == 'asc' ? '-up' : '-down') : '' }}"></i>
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
                                    @foreach($mata_kuliahs as $index => $mata_kuliah)
                                        <tr>
                                            <td>{{ $index + 1 + ($mata_kuliahs->currentPage() - 1) * $mata_kuliahs->perPage() }}</td>
                                            <td>{{ $mata_kuliah->nama_mata_kuliah }}</td>
                                            <td>{{ $mata_kuliah->sks }}</td>
                                            <td>{{ $mata_kuliah->kategori_matkul }}</td>
                                                <td>{{ $mata_kuliah->dosen->nama }}</td>
                                            <td>
                                            @foreach($prodis as $prodi)
                                                {{ $mata_kuliah->prodi == $prodi->id ?  $prodi->nama_prodi : ''}}
                                            @endforeach
                                            </td>
                                                <td class="action-buttons">
                                                    <button class="btn btn-warning ms-2" data-toggle="modal" data-target="#editModal{{ $mata_kuliah->id }}" onclick="editMataKuliah({{ $mata_kuliah->id }}, '{{ $mata_kuliah->nama_mata_kuliah }}', {{ $mata_kuliah->sks }}, '{{ $mata_kuliah->kategori_matkul }}', '{{ $mata_kuliah->dosen_pengampu }}', {{ $mata_kuliah->prodi }})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $mata_kuliah->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                    
                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="editModal{{ $mata_kuliah->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $mata_kuliah->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title font-weight-bold" id="editModalLabel{{ $mata_kuliah->id }}">Edit Mata Kuliah</h3>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="editForm{{ $mata_kuliah->id }}" action="{{ route('mata-kuliah.update', $mata_kuliah->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group mb-3">
                                                                            <label for="edit_nama_mata_kuliah{{ $mata_kuliah->id }}" class="font-weight-bold">Nama Mata Kuliah</label>
                                                                            <input type="text" class="form-control rounded" id="edit_nama_mata_kuliah{{ $mata_kuliah->id }}" name="nama_mata_kuliah" required>
                                                                        </div>
                                                                        <div class="form-group mb-3">
                                                                            <label for="edit_sks{{ $mata_kuliah->id }}" class="font-weight-bold">SKS</label>
                                                                            <input type="number" class="form-control rounded" id="edit_sks{{ $mata_kuliah->id }}" name="sks" required>
                                                                        </div>
                                                                        <div class="form-group mb-3">
                                                                            <label for="edit_kategori_matkul{{ $mata_kuliah->id }}" class="font-weight-bold">Kategori</label>
                                                                            <select class="form-control rounded" id="edit_kategori_matkul{{ $mata_kuliah->id }}" name="kategori_matkul" required>
                                                                                @foreach($kategori_matkuls as $kategori)
                                                                                    <option value="{{ $kategori->kode_kategori }}">{{ $kategori->nama_kategori }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <a href="{{ route('kategori-matkul.index') }}" class="related-link">Tambahkan Kategori baru</a>
                                                                        </div>
                                                                        <div class="form-group mb-3">
                                                                            <label for="edit_dosen_pengampu{{ $mata_kuliah->id }}" class="font-weight-bold">Dosen Pengampu</label>
                                                                            <select class="form-control rounded" id="edit_dosen_pengampu{{ $mata_kuliah->id }}" name="dosen_pengampu" required>
                                                                                @foreach($dosens as $dosen)
                                                                                    <option value="{{ $dosen->nidn }}">{{ $dosen->nama }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <a href="{{ route('dosen.index') }}" class="related-link">Tambahkan Dosen baru</a>
                                                                        </div>
                                                                        <div class="form-group mb-3">
                                                                            <label for="edit_prodi{{ $mata_kuliah->id }}" class="font-weight-bold">Prodi</label>
                                                                            <select class="form-control rounded" id="edit_prodi{{ $mata_kuliah->id }}" name="prodi" required>
                                                                                @foreach($prodis as $prodi)
                                                                                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <a href="{{ route('prodi.index') }}" class="related-link">Tambahkan Prodi baru</a>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                                </div>
                                                                    </form>
                                                            </div>
                                                        </div>
                                                    </div>
                    
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $mata_kuliah->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $mata_kuliah->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel{{ $mata_kuliah->id }}">Konfirmasi Penghapusan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda Yakin Ingin Menghapus Data "<strong>{{ $mata_kuliah->nama_mata_kuliah }}</strong>"?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                                                    <form action="{{ route('mata-kuliah.destroy', $mata_kuliah->id) }}" method="POST">
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
                            {{ $mata_kuliahs->links() }}
                        </div>
                    </div>
                </div>
                
                <!-- Create Modal -->
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title font-weight-bold" id="createModalLabel">Tambah Mata Kuliah</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createForm" action="{{ route('mata-kuliah.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nama_mata_kuliah" class="font-weight-bold">Nama Mata Kuliah</label>
                                        <input type="text" class="form-control rounded" id="nama_mata_kuliah" name="nama_mata_kuliah" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="sks" class="font-weight-bold">SKS</label>
                                        <input type="number" class="form-control rounded" id="sks" name="sks" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="kategori_matkul" class="font-weight-bold">Kategori</label>
                                        <select class="form-control rounded" id="kategori_matkul" name="kategori_matkul" required>
                                            @foreach($kategori_matkuls as $kategori)
                                                <option value="{{ $kategori->kode_kategori }}">{{ $kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        <a href="{{ route('kategori-matkul.index') }}" class="related-link">Tambahkan Kategori baru</a>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="dosen_pengampu" class="font-weight-bold">Dosen Pengampu</label>
                                        <select class="form-control rounded" id="dosen_pengampu" name="dosen_pengampu" required>
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
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
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
                                <h3 class="modal-title font-weight-bold" id="filterModalLabel">Filter Mata Kuliah</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('mata-kuliah.index') }}" method="GET" id="filterForm">
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
                                        <label for="filter_kategori" class="font-weight-bold">Kategori</label>
                                        <select name="kategori" id="filter_kategori" class="form-control rounded">
                                            <option value="">Semua Kategori</option>
                                            @foreach($kategori_matkuls as $kategori)
                                                <option value="{{ $kategori->kode_kategori }}" {{ $kategori->kode_kategori == $kode_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="filter_dosen" class="font-weight-bold">Dosen Pengampu</label>
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
                $(document).ready(function() {
                    // Clear form fields on modal close
                    $('#createModal').on('hidden.bs.modal', function () {
                        $('#createForm')[0].reset();
                    });
        
                    $('.edit-modal').on('hidden.bs.modal', function () {
                        $(this).find('form')[0].reset();
                    });
        
                    window.editMataKuliah = function(id, nama, sks, kategori, dosen, prodi) {
                        $('#edit_nama_mata_kuliah' + id).val(nama);
                        $('#edit_sks' + id).val(sks);
                        $('#edit_kategori_matkul' + id).val(kategori);
                        $('#edit_dosen_pengampu' + id).val(dosen);
                        $('#edit_prodi' + id).val(prodi);
                    }

                    $('#searchButton').on('click', function() {
                        const keyword = $('#searchKeyword').val().toLowerCase();
                        $('table tbody tr').filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1)
                        });
                    });
                });
                </script>
        
        </div>
    </div>
    
</x-app-layout>
