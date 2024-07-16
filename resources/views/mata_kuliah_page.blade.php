<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h1 class="mb-4">Daftar Mata Kuliah</h1>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Dosen Pengampu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mataKuliahs as $mataKuliah)
                    <tr>
                        <td>{{ $mataKuliah->id }}</td>
                        <td>{{ $mataKuliah->kode_mata_kuliah }}</td>
                        <td>{{ $mataKuliah->nama_mata_kuliah }}</td>
                        <td>{{ $mataKuliah->sks }}</td>
                        <td>{{ $mataKuliah->semester }}</td>
                        <td>{{ $mataKuliah->dosen->nama }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editMataKuliah({{ $mataKuliah->id }})">Edit</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteMataKuliah({{ $mataKuliah->id }})">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="editForm" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Edit Mata Kuliah</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="kode_mata_kuliah" class="form-label">Kode Mata Kuliah</label>
                <input type="text" class="form-control" id="kode_mata_kuliah" name="kode_mata_kuliah" required>
              </div>
              <div class="mb-3">
                <label for="nama_mata_kuliah" class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" id="nama_mata_kuliah" name="nama_mata_kuliah" required>
              </div>
              <div class="mb-3">
                <label for="sks" class="form-label">SKS</label>
                <input type="number" class="form-control" id="sks" name="sks" required>
              </div>
              <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <select class="form-control" id="semester" name="semester" required>
                  <option value="ganjil">Ganjil</option>
                  <option value="genap">Genap</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="dosen_pengampu" class="form-label">Dosen Pengampu</label>
                <input type="text" class="form-control" id="dosen_pengampu" name="dosen_pengampu" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Hapus Mata Kuliah</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Apakah Anda yakin ingin menghapus mata kuliah ini?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script>
        function editMataKuliah(id) {
            fetch(`/mata-kuliah/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('kode_mata_kuliah').value = data.kode_mata_kuliah;
                    document.getElementById('nama_mata_kuliah').value = data.nama_mata_kuliah;
                    document.getElementById('sks').value = data.sks;
                    document.getElementById('semester').value = data.semester;
                    document.getElementById('dosen_pengampu').value = data.dosen_pengampu;
        
                    document.getElementById('editForm').action = `/mata-kuliah/${id}`;
                });
        }
        
        function deleteMataKuliah(id) {
            document.getElementById('deleteForm').action = `/mata-kuliah/${id}`;
        }
        </script>
        
</x-app-layout>