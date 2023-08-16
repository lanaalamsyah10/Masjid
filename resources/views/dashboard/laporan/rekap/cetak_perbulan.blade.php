<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
    }

    .garis {
        border: 1px solid #000000;
        margin-bottom: 25px;
    }

    h1 {
        font-size: 23pt;
        color: #212121;
        text-align: center;
    }

    .text {
        font-size: 12pt;
        color: #212121;
        text-align: center;
    }

    html,
    body {
        margin: 35px 40px 35px 50px;
    }
</style>

<body>
    <h1>LAPORAN REKAP KAS MASJID AL-ISLAKH</h1>
    <p class="text">Jl. Garuda, Karangampel Kidul, Kec. Karangampel, Kabupaten Indramayu, Jawa Barat 45283
    </p>
    <hr class="garis">
    <h4>Data Rekap Kas Bulan {{ $bulan }}</h4>
    <h4>Tahun : {{ $tahun }} </h4>
    <table style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Uraian</th>
                <th>Jumlah Pemasukan</th>
                <th>Jumlah Pengeluaran</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap_kas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>
                        @if ($data->tipe == 'pemasukan')
                            {{ 'Rp. ' . number_format($data->jumlah, 0, ',', '.') }}
                        @else
                            Rp. 0
                        @endif
                    </td>
                    <td>
                        @if ($data->tipe == 'pengeluaran')
                            {{ 'Rp. ' . number_format($data->jumlah, 0, ',', '.') }}
                        @else
                            Rp. 0
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="5">Total Pemasukan :
                    {{ 'Rp ' . number_format($total_pemasukan, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="5">Total Pengeluaran :
                    {{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="5">Saldo :
                    {{ 'Rp ' . number_format($total_keseluruhan, 0, ',', '.') }}
                </th>
            </tr>
        </tbody>
    </table>

</body>

</html>
