<?php
function getLabelNilai($nilai){
    $label = '';
    switch ($nilai) {
        case 4:
            $label = 'A';
            break;
        case 3:
            $label = 'B';
            break;
        case 2:
            $label = 'C';
            break;
        case 1:
            $label = 'D';
            break;
        case 0:
            $label = 'E';
            break;
        
        default:
            $label = '';
            break;
    }
    return $label;
}

function formatTanggalLahir($tanggal) {
    setlocale(LC_TIME, 'id_ID.UTF-8');
    return strftime('%d %B %Y', strtotime($tanggal));
}

function getInisialProdi($nama_prodi) {
    $words = explode(' ', $nama_prodi);
    $inisial = '';
    foreach ($words as $word) {
        $inisial .= strtoupper($word[0]);
    }
    return $inisial;
}
?>

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
            font-size: 9px;
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
        }
        th, td {
            padding: 4px;
            text-align: center;
        }
        td.mata-kuliah {
            text-align: left;
        }
        tbody tr td {
            border: none;
        }
        .no-border {
            border: none;
        }
        .footer-signature {
            margin-top: 10px;
        }
        .footer-signature div {
            width: 45%;
            display: inline-block;
            text-align: center;
        }
        .content p {
            margin: 0;
        }
        .content p span {
            display: inline-block;
            width: 200px; /* Adjust width as needed */
        }
        .second-row-table td {
            line-height: 1; /* Jarak antar baris lebih rapat */
            padding-left: 10px; /* Margin kiri sedikit */
            text-align: left;
        }
        .second-row-table td span {
            display: inline-block;
            width: 100px; /* Adjust width as needed for alignment */
        }
    </style>
</head>
<body>
    {{-- {{ var_dump($row1)}} --}}
    {{ var_dump($nim)}}
    <div class="container">
        <div class="header">
            <h2>TRANSKRIP NILAI</h2>
            <p><b>Nomor: 121/93/{{ substr($mahasiswa->nim, 0, 5) }}/POLIMAT/{{ date('y') }}</b></p>
        </div>
        <div class="content">
            <p><span>Nama</span> : {{ $mahasiswa->nama_lengkap }}</p>
            <p><span>Tempat dan Tanggal Lahir</span> : {{ $mahasiswa->tempat_lahir }}, {{ formatTanggalLahir($mahasiswa->tanggal_lahir) }}</p>
            <p><span>Nomor Induk Mahasiswa</span> : {{ substr($mahasiswa->nim, 0, 5) }}.{{ substr($mahasiswa->nim, 5, 2) }}.{{ substr($mahasiswa->nim, 7, 3) }}</p>
            <p><span>Program Studi</span> : <b>{{ $prodi->nama_prodi }} ({{ getInisialProdi($prodi->nama_prodi) }})</b></p>
        </div>
        <table class="no-border">
            <tr valign="top">
                <td class="no-border">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Mata Kuliah</th>
                                <th>N</th>
                                <th>H</th>
                                <th>K</th>
                                <th>N x K</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $currentKategori = '';
                                $index = 1;
                            @endphp
                            @foreach ($row1 as $studi)
                                @if ($currentKategori != $studi['kategori'])
                                    @php $currentKategori = $studi['kategori'];  $index = 1; @endphp
                                                                       <tr>
                                        <td></td>
                                        <td colspan="5" class="mata-kuliah"><b>{{ $currentKategori }}</b></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td class="mata-kuliah">{{ $studi['mata_kuliah'] }}</td>
                                    <td>{{ $studi['n'] }}</td>
                                    <td>{{ $studi['h'] }}</td>
                                    <td>{{ $studi['k'] }}</td>
                                    <td>{{ $studi['n'] * $studi['k'] }}</td>
                                </tr>
                                @php $index++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td class="no-border">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Mata Kuliah</th>
                                <th>N</th>
                                <th>H</th>
                                <th>K</th>
                                <th>N x K</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $currentKategori = '';
                                $index = 1 + count($row1);
                            @endphp
                            @foreach ($row2 as $studi)
                                @if ($currentKategori != $studi['kategori'])
                                    @php $currentKategori = $studi['kategori']; @endphp
                                    <tr>
                                        <td></td>
                                        <td colspan="5" class="mata-kuliah"><b>{{ $currentKategori }}</b></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td class="mata-kuliah">{{ $studi['mata_kuliah'] }}</td>
                                    <td>{{ $studi['n'] }}</td>
                                    <td>{{ $studi['h'] }}</td>
                                    <td>{{ $studi['k'] }}</td>
                                    <td>{{ $studi['n'] * $studi['k'] }}</td>
                                </tr>
                                @php $index++; @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="no-border"></td>
                                <td>{{ $totalSks }}</td>
                                <td>{{ $totalNilai }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
            <tr valign="top">
                <td class="no-border">
                    <table class="second-row-table">
                        <tbody>
                            <div class="content">
                                <p><span>Jumlah Kredit Kumulatif</span> : {{ $totalSks }}</p>
                                <p><span>Indeks Prestasi Kumulatif (IPK)</span> : {{ $ipk }}</p>
                                <p><span>Predikat Kelulusan</span> : <b>{{ substr($mahasiswa->nim, 0, 5) }}.{{ substr($mahasiswa->nim, 5, 2) }}.{{ substr($mahasiswa->nim, 7, 3) }}</b></p>
                                <p><span>Tanggal Yudisium</span> :  {{ formatTanggalLahir($mahasiswa->tanggal_lahir) }}</p>
                            </div>
                            <p><span>Keterangan: N-Nilai (A=4, B=3, C=2, D=1, E=0)</p>
                        </tbody>
                    </table>
                </td>
                <td class="no-border">
                    <table class="second-row-table">
                        <tbody>
                            <p><span><b>Karya Tulis</b></span> :</p>
                            <p><span><b> {{ $karya_tulis->judul }}</b></p>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <div class="footer-signature">
            <table class="no-border">
                <tbody>
                    <tr>
                        <td><p>Ketua Program Studi</p></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><p>Muara Teweh, {{ formatTanggalLahir(date('Y-m-d')) }}</p>
                            <p>Direktur</p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center">foto 3x4</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td><p><b><u>{{ $kaprodi->nama }}</u></b></p>
                            <p>NIDN: {{ $kaprodi->nidn }}</p>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><p><b><u>{{ $direktur->nama }}<u></b></p>
                            <p>NIDN: {{ $direktur->nidn }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
