<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan Akademik - Ilmu Komputer</title>
    <style>
        body body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h3,
        h2, h4 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        .info {
            margin-top: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        .footer {
            margin-top: 30px;
        }

        .ttd {
            text-align: center;
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .ttd div {
            width: 45%;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>UNIVERSITAS NEGERI JAKARTA</h2>
    <h3>FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM</h3>
    <h3>PROGRAM STUDI ILMU KOMPUTER</h3>
    <h4>Jl. R.Mangun Muka Raya No.11, RT.11/RW.14, Rawamangun, Kec. Pulo Gadung, Kota Jakarta Timur, Daerah
        Khusus Ibukota Jakarta 13220</h4>

    <div class="info">
        <p><strong>Program Studi:</strong> Ilmu Komputer</p>
        <p><strong>Angkatan:</strong> 2021</p>
        <p><strong>Jumlah Mahasiswa:</strong> {{ count($akademik) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>SKS Lulus</th>
                <th>IPK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($akademik as $i => $mhs)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $mhs->user_name }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->totalsks }}</td>
                    <td>{{ $mhs->ipk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>Catatan: Bila terdapat perbedaan data yang tercetak dengan Database, maka Database dijadikan dasar</p>

        <div class="ttd" style="display: flex; justify-content: space-between; text-align: center;">
          <div style="width: 45%;">
            {{-- Jakarta, 27 May 2025<br> --}}
            Wakil Dekan I/Wakil Direktur I<br><br><br><br>
            <strong>Dr. Meiliasari, S.Pd, M.Sc</strong><br>
            NIP. 197905042009122002
          </div>
          <div style="width: 45%;">
            Koordinator Program Studi<br>
            ILMU KOMPUTER<br><br><br><br>
            <strong>Dr. Ria Arafiyah, M.Si</strong><br>
            NIP. 197511212005012004
          </div>
        </div>

</body>

</html>
