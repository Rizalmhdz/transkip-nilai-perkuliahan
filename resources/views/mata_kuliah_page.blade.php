<!-- resources/views/matakuliah/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Mata Kuliah</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Kode Mata Kuliah</th>
                    <th scope="col">Nama Mata Kuliah</th>
                    <th scope="col">SKS</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Dosen Pengampu</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matakuliahs as $matakuliah)
                <tr>
                    <th scope="row">{{ $matakuliah->id }}</th>
                    <td>{{ $matakuliah->kode_mata_kuliah }}</td>
                    <td>{{ $matakuliah->nama_mata_kuliah }}</td>
                    <td>{{ $matakuliah->sks }}</td>
                    <td>{{ ucfirst($matakuliah->semester) }}</td>
                    <td>{{ $matakuliah->dosen_pengampu }}</td>
                    <td>
                        <!-- Tambahkan tombol untuk edit dan delete sesuai kebutuhan -->
                        <a href="{{ route('matakuliah.edit', $matakuliah->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('matakuliah.destroy', $matakuliah->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
