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
            font-size: 9px;
        }
    
        .container {
            width: 100%;
            box-sizing: border-box;
        }
    
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
    
        .header h2, .header p {
            margin: 0;
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
    
        table {
            margin: 0;
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
            margin-top: 10px;
            line-height: 0.5;
        }
    
        .footer-signature .row-tengah td {
            height: 50px;
        }
    
        .no-row-border td {
            border-top: none; /* Hilangkan border atas untuk baris */
            border-bottom: none; /* Hilangkan border bawah untuk baris */
        }
    
        .second-row-table td {
            font-size: 10px;
            height: 70px;
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
        .narrow-column-nxk {
            width: 30px; /* Lebar untuk kolom 3 karakter */
        }
    
    
        .tfooter td {
            font-size: 10px;
            padding: 2px 4px;
            height: 20px;
        }
    
        .footer-signature table tr {
            padding: 0;
        }
    
        .footer-signature table tr td {
            padding: 0;
            border: none;
        }
    
        .footer-signature .row-atas tr {
            margin-top: 0px;
            vertical-align: bottom;
        }
    
        .footer-signature .row-atas p {
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
            <h2>{{ $prodi->nama_prodi}}</h2>
            <p>{{$mahasiswa->tahun_lulus? 'TA.' .  $mahasiswa->tahun_lulus : 'Belum Lulus'}}</p>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>IPK</th>
                        <th>Judul Karya Tulis</th>
                        <th>Tahun Lulus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ substr($mahasiswa->nim, 0, 5) }}.{{ substr($mahasiswa->nim, 5, 2) }}.{{ substr($mahasiswa->nim, 7, 3) }}</td>
                        <td>{{ $mahasiswa->nama_lengkap }}</td>
                        <td>{{ $prodi->nama_prodi}}</td>
                        <td> {{$ipk }}</td>
                        <td>
                            <?= $karya_tulis->judul ?? 'Belum ada Karya Tulis' ?>
                        </td>
                        <td> {{$mahasiswa->tahun_lulus? $mahasiswa->tahun_lulus : 'Belum Lulus'}}</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
        <div class="footer-signature">
            <table class="no-border">
                <tbody>
                    <tr>
                        <td class="col-depan"><p>Mengetahui</p>
                           <p>Direktur</p></td>
                        <td class="col-tengah"></td>
                        <td class="col-belakang"><p>Muara Teweh, {{ formatTanggalLahir(date('Y-m-d')) }}</p>
                            <p>Ketua Program Studi</p>
                        </td>
                    </tr>
                    <tr class="row-tengah">
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                       
                        <td><p><b><u>{{ $direktur->nama }}<u></b></p>
                            <p>NIDN: {{ $direktur->nidn }}</p>
                        </td>
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
