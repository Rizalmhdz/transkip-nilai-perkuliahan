<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graduation Summary</title>
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
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .footer-signature {
            margin-top: 50px;
        }
        .footer-signature div {
            width: 50%;
            display: inline-block;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Graduation Summary</h2>
            <p>{{$mahasiswa->tahun_lulus != ''? 'TA.' +  $mahasiswa->tahun_lulus : 'Belum Lulus'}}</p>
        </div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>IPK</th>
                        <th>Jumlah Karya Tulis</th>
                        <th>Tahun Lulus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $nim }}</td>
                        <td>{{ $mahasiswa->nama_lengkap }}</td>
                        <td>{{ $prodi->nama_prodi}}</td>
                        <td> {{$ipk }}</td>
                        <td> {{ $jumlah_karya_tulis}}</td>
                        <td> {{$mahasiswa->tahun_lulus != ''? $mahasiswa->tahun_lulus : 'Belum Lulus'}}</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
        <div class="footer-signature">
            <table class="no-border">
                <tbody>
                    <tr>
                        <td><p>Mengetahui</p>
                           <p>Direktur</p></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><p>Muara Teweh, {{ formatTanggalLahir(date('Y-m-d')) }}</p>
                            <p>Ketua Program Studi</p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                       
                        <td><p><b><u>{{ $direktur->nama }}<u></b></p>
                            <p>NIDN: {{ $direktur->nidn }}</p>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><p><b><u>{{ $kaprodi->nama }}</u></b></p>
                            <p>NIDN: {{ $kaprodi->nidn }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
