<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Nilai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }
        .header, .footer {
            text-align: center;
        }
        .header h2 {
            margin: 0;
        }
        .content {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            border-width: 0.5px;
        }
        th, td {
            padding: 4px;
            text-align: center;
        }
        .no-border {
            border: none;
        }
        .footer-signature {
            margin-top: 50px;
        }
        .footer-signature div {
            width: 45%;
            display: inline-block;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>TRANSKRIP NILAI</h2>
            <p>Nomor: 121/93/{{ substr($student->nim, 0, 5) }}/POLIMAT/{{ date('y') }}</p>
        </div>
        <div class="content">
            <p>Nama: <b>{{ $student->nama_lengkap }}</b></p>
            <p>Tempat dan Tanggal Lahir: <b>{{ $student->tempat_lahir }}, {{ $student->tanggal_lahir }}</b></p>
            <p>Nomor Induk Mahasiswa: <b>{{ substr($student->nim, 0, 5) }}.{{ substr($student->nim, 5, 2) }}.{{ substr($student->nim, 7, 3) }}</b></p>
            <p>Program Studi: <b>{{ $student->prodi->nama_prodi }} (TP)</b></p>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Mata Kuliah</th>
                        <th>N</th>
                        <th>K</th>
                        <th>N x K</th>
                        <th>No.</th>
                        <th>Mata Kuliah</th>
                        <th>N</th>
                        <th>K</th>
                        <th>N x K</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                        $totalNk = 0;
                    @endphp
                    @foreach ($categories as $category)
                        @foreach ($category->mataKuliahs as $mataKuliah)
                            @php
                                $nK = $mataKuliah->pivot->nilai * $mataKuliah->sks;
                                $totalNk += $nK;
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $mataKuliah->nama_mata_kuliah }}</td>
                                <td>{{ $mataKuliah->pivot->nilai }}</td>
                                <td>{{ $mataKuliah->sks }}</td>
                                <td>{{ $nK }}</td>
                                @if ($i % 2 == 0)
                                    </tr><tr>
                                @else
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $mataKuliah->nama_mata_kuliah }}</td>
                                    <td>{{ $mataKuliah->pivot->nilai }}</td>
                                    <td>{{ $mataKuliah->sks }}</td>
                                    <td>{{ $nK }}</td>
                                @endif
                                @php $i++; @endphp
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="no-border"></td>
                        <td>{{ $totalNk }}</td>
                        <td colspan="4" class="no-border"></td>
                        <td>{{ $totalNk }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="footer-signature">
            <div>
                <p>Ketua Program Studi</p>
                <p><b>{{ $kaprodi->nama }}</b></p>
                <p>NIDN: {{ $kaprodi->nidn }}</p>
            </div>
            <div>
                <p>Muara Teweh, {{ date('d-m-Y') }}</p>
                <p>Direktur</p>
                <p><b>{{ $direktur->nama }}</b></p>
                <p>NIDN: {{ $direktur->nidn }}</p>
            </div>
        </div>
    </div>
</body>
</html>
