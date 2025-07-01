<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan Akademik Mahasiswa Bimbingan - Dosen PA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px 50px 40px 50px;
        }

        h2, h3, h4 {
            text-align: center;
            margin: 4px 0;
        }

        .info {
            margin-top: 30px;
            font-size: 14px;
        }

        .info p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
            font-size: 14px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th {
            background-color: #eee;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        .w-no { width: 40px; }
        .w-nama { width: 220px; text-align: left; padding-left: 10px; }
        .w-nim { width: 130px; }
        .w-sks, .w-ipk { width: 90px; }
        .w-status { width: 140px; }

        .footer {
            margin-top: 15px;
            font-size: 13px;
        }

        .ttd {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
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
    <h4>Jl. R.Mangun Muka Raya No.11, Rawamangun, Jakarta Timur, DKI Jakarta 13220</h4>

    <div class="info">
        <p><strong>Laporan Akademik Mahasiswa Bimbingan</strong></p>
        <p><strong>Dosen PA:</strong> {{ $dosen->nama ?? 'Nama Dosen' }}</p>
        <p><strong>Jumlah Mahasiswa:</strong> {{ count($mahasiswa) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="w-no">No</th>
                <th class="w-nama">Nama Mahasiswa</th>
                <th class="w-nim">NIM</th>
                <th class="w-sks">SKS</th>
                <th class="w-ipk">IPK</th>
                <th class="w-status">Status Akademik</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswa as $index => $mhs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="w-nama">{{ $mhs['nama'] }}</td>
                    <td>{{ $mhs['nim'] }}</td>
                    <td>{{ $mhs['total_sks'] }}</td>
                    <td>{{ number_format($mhs['ipk'], 2) }}</td>
                    <td>
                        @if ($mhs['ipk'] > 3.5)
                            Berprestasi
                        @elseif ($mhs['ipk'] >= 3.01)
                            Cukup Berprestasi
                        @else
                            Kurang Berprestasi
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 12px;">
                        Tidak ada data mahasiswa bimbingan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p><em>Catatan:</em> Bila terdapat perbedaan data yang tercetak dengan database, maka data sistem dijadikan acuan resmi.</p>
    </div>

    <div class="ttd">
        <table style="width: 100%; margin-top: 50px; font-size: 14px; border-collapse: collapse; border: 1px solid white;">
            <tr style="border: 1px solid white;">
                <td style="width: 50%; text-align: center; vertical-align: top; border: 1px solid white;">
                    Dosen Pembimbing Akademik<br>
                    Ilmu Komputer<br><br><br><br><br><br>
                    <strong>{{ $dosen->nama ?? 'Nama Dosen' }}</strong><br>
                    NIP. {{ $dosen->nim ?? '...' }}
                </td>
                <td style="width: 50%; text-align: center; vertical-align: top; border: 1px solid white;">
                    Koordinator Program Studi<br>
                    Ilmu Komputer<br><br><br><br><br><br>
                    <strong>Dr. Ria Arafiyah, M.Si</strong><br>
                    NIP. 197511212005012004
                </td>
            </tr>
        </table>
    </div>
</body>

</html>