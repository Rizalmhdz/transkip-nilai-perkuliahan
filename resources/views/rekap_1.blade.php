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

function getLabelPredikat($ipk){
    $predikat = '';
    if($ipk > 3.5) {
        $predikat = "Cum laude";
    } else if($ipk > 2.75 && $ipk <= 3.5){
        $predikat = "Sangat memuaskan";
    } else {
        $predikat = "Memuaskan";
    }
    return $predikat;
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

// Function to calculate the height of a row
function calculateRowHeight($row, $footer = false) {
    $headerHeight = 20;
    $categoryHeight = 32;
    $itemHeight = 12;
    $footerHeight = 20;

    $categories = [];
    foreach ($row as $studi) {
        $categories[$studi['kategori']][] = $studi;
    }

    $numCategories = count($categories);
    $numItems = count($row);

    $height = $headerHeight + ($numCategories * $categoryHeight) + ($numItems * $itemHeight);

    if ($footer) {
        $height += $footerHeight;
    }

    return $height;
}

// Calculate heights for row1 and row2
$row1Height = calculateRowHeight($row1);
$row2Height = calculateRowHeight($row2, true); // row2 includes the footer

// Determine the maximum height
$maxHeight = max($row1Height, $row2Height) + 20;

$row1additional = $maxHeight - $row1Height;
$row2additional = $maxHeight - $row2Height;

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
        .header p {
           margin-top: 0px;
        }
        .content {
            margin-left: 35px;
            margin-bottom: 15px;
        }
        .content p {
            margin: 0;
        }
        .content p span {
            display: inline-block;
            width: 200px; /* Adjust width as needed */
        }
        .no-row-border td {
            border-top: none; /* Hilangkan border atas untuk baris */
            border-bottom: none; /* Hilangkan border bawah untuk baris */
        }
        .second-row-table td {
            font-size: 10px;
            height: 70px;
        }
        .mhs_stat td p {
            margin-top: 0;
            line-height: 0.4;
        }
        .mhs_stat table {
            border: none;
        }
        .mhs_stat table tr td {
            padding: 3px 6px;
            border: none;
            text-align: left;
            line-height: 0.4;
            height: 8px;
        }
        .karya_tulis_stat table tr td {
            border: none;
            margin-top: 0px;
            text-align: left;
            line-height: 0.4;
        }
        .karya_tulis_stat .judul {
            text-align: center;
        }
        .no-border {
            padding: 2;
            border: none;
        }
        
        .no-column {
            width: 8px; /* Lebar untuk kolom 3 karakter */
        }
        .narrow-column {
            width: 10px; /* Lebar untuk kolom 3 karakter */
        }
        
        .row1-th th, .row2-th th {
            border-bottom: 2px solid black;
            padding: 2px 4px;
            font-size: 10px;
            height: 20px;
        }

        .narrow-column-nxk {
            width: 30px; /* Lebar untuk kolom 3 karakter */
        }
        /* CSS untuk menyesuaikan tinggi baris */
        .row-rekap td table{
            font-size: 8px;
        }
        .row-rekap td {
            width: 50%;
        }
        .row1 tr, .row2 tr {
            width: 100%;
            font-size: 10px;
            text-align: left;
            padding: 2px 4px;
            height: 20px; /* Set height for headers */
        }
        .row1 td, .row2 td {
           padding: 2px 4px;
           height: 12px;
        }
        .row1 .mata-kuliah, .row2 .mata-kuliah{
            padding-left: 8px;
            text-align: left;
        }
        .category-row td {
            font-size: 10px;
            padding: 20px 4px 2px 4px;
        }

        .row1-additional td{
            height: <?= $row1additional ?>px;
        }

        .row2-additional td{
            height: <?= $row2additional ?>px;
        }

        .tfooter td {
            font-size: 10px;
            padding: 2px 4px;
            height: 20px;
        }
        .footer-signature table tr{
           padding: 0;
        }
        .footer-signature table tr td {
           padding: 0;
            border: none;
        }
        .footer-signature .row-atas tr{
            margin-top: 0px;
            vertical-align: bottom;
        }
        .footer-signature .row-atas p{
            line-height: 0.5;
            margin-top: 10px;
            vertical-align: bottom;
        }

        .col-depan, .col-belakang {
            width: 40%;
        }
         .col-tengah {
            width: 20%;
         }
    </style>
</head>
<body>
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
        <table class="no-border equal-width">
            <tr valign="top" class="row-rekap">
                <td class="no-border">
                    <table>
                        <thead  class="row1-th" >
                            <tr>
                                <th class="narrow-column">No.</th>
                                <th>Mata Kuliah</th>
                                <th class="narrow-column">N</th>
                                <th class="narrow-column">H</th>
                                <th class="narrow-column">K</th>
                                <th class="narrow-column-nxk">N x K</th>
                            </tr>
                        </thead>
                        <tbody  class="row1">
                            @php
                                $currentKategori = '';
                                $index = 1;
                            @endphp
                            @foreach ($row1 as $studi)
                                @if ($currentKategori != $studi['kategori'])
                                    @php $currentKategori = $studi['kategori'];  $index = 1; @endphp
                                    <tr class="category-row no-row-border">
                                        <td></td>
                                        <td class="mata-kuliah"><b>{{ $currentKategori }}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endif
                                <tr class="no-row-border">
                                    <td>{{ $index }}</td>
                                    <td class="mata-kuliah">{{ $studi['mata_kuliah'] }}</td>
                                    <td>{{ $studi['n'] }}</td>
                                    <td>{{ $studi['h'] }}</td>
                                    <td>{{ $studi['k'] }}</td>
                                    <td>{{ $studi['n'] * $studi['k'] }}</td>
                                </tr>
                                @php $index++; @endphp
                            @endforeach
                            <tr class="no-row-border row1-additional">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class="no-border">
                    <table>
                        <thead   class="row1-th" >
                            <tr>
                                <th class="no-column">No.</th>
                                <th>Mata Kuliah</th>
                                <th class="narrow-column">N</th>
                                <th class="narrow-column">H</th>
                                <th class="narrow-column">K</th>
                                <th class="narrow-column-nxk">N x K</th>
                            </tr>
                        </thead>
                        <tbody class="row2">
                            @php
                                $currentKategori = '';
                                $index = 1 + count($row1);
                            @endphp
                            @foreach ($row2 as $studi)
                                @if ($currentKategori != $studi['kategori'])
                                    @php $currentKategori = $studi['kategori']; $index = 1; @endphp
                                    <tr class="category-row no-row-border">
                                        <td></td>
                                        <td class="mata-kuliah"><b>{{ $currentKategori }}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endif
                                <tr class="no-row-border">
                                    <td>{{ $index }}</td>
                                    <td class="mata-kuliah">{{ $studi['mata_kuliah'] }}</td>
                                    <td>{{ $studi['n'] }}</td>
                                    <td>{{ $studi['h'] }}</td>
                                    <td>{{ $studi['k'] }}</td>
                                    <td>{{ $studi['n'] * $studi['k'] }}</td>
                                </tr>
                                @php $index++; @endphp
                            @endforeach
                            <tr class="no-row-border row2-additional">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot class="tfooter">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
                        <tbody class="mhs_stat">
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td>Jumlah Kredit Kumulatif</td>
                                            <td>: {{ $totalSks }}</td>
                                        </tr>
                                        <tr>
                                            <td>Indeks Prestasi Kumulatif (IPK)</td>
                                            <td>: {{ $ipk }}</td>
                                        </tr>
                                        <tr>
                                            <td>Predikat Kelulusan</td>
                                            <td>: <b>{{ getLabelPredikat($ipk)}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Yudisium</td>
                                            <td>:  {{ formatTanggalLahir($mahasiswa->tanggal_lahir) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Keterangan: N-Nilai (A=4, B=3, C=2, D=1, E=0)</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class="no-border">
                    <table class="second-row-table">
                        <tbody class="karya_tulis_stat compact">
                            <tr>
                                <td>
                                    <p><span><b>Karya Tulis :</b></span></p>
                                    <p class="judul"><span><b> {{ $karya_tulis->judul }}</b></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr valign="top" class="footer-signature">
                <td colspan="2" class="no-border">
                    <table class="no-border">
                        <tbody > 
                            <tr class="row-atas">
                                <td class="col-depan"><p>Ketua Program Studi,</p></td>
                                <td class="col-tengah"></td>
                                <td  class="col-belakang"><p>Muara Teweh, {{ formatTanggalLahir(date('Y-m-d')) }}</p>
                                    <p>Direktur,</p>
                                </td>
                            </tr>
                            <tr class="row-tengah">
                                <td></td>
                                <td style="text-align: center">foto 3x4</td>
                                <td></td>
                            </tr>
                            <tr class="row-bawah">
                                <td class="no-border"><p><b><u>{{ $kaprodi->nama }}</u></b></p>
                                    <p>NIDN: {{ $kaprodi->nidn }}</p>
                                </td>
                                <td class="no-border"></td>
                                <td class="no-border"><p><b><u>{{ $direktur->nama }}<u></b></p>
                                    <p>NIDN: {{ $direktur->nidn }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
