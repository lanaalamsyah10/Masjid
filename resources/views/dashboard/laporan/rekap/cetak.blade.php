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
        margin: 35px 20px 35px 20px;
    }
</style>

<body>
    <h1>REKAP LAPORAN KAS MASJID AL-ISLAKH</h1>
    <p class="text">Jl. Garuda, Karangampel Kidul, Kec. Karangampel, Kabupaten Indramayu, Jawa Barat 45283
    </p>
    <hr class="garis">
    <table style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Uraian Pemasukan</th>
                <th>Jumlah Pemasukan</th>
                <th>Tanggal Pemasukan</th>
                <th>Uraian Pengeluaran</th>
                <th>Jumlah Pengeluaran</th>
                <th>Tanggal Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap_kas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $data->pemasukan ? $data->pemasukan->keterangan_pemasukan : '-' }}
                    </td>
                    <td>
                        @if ($data->pemasukan)
                            {{ 'Rp ' . number_format($data->pemasukan->jumlah_pemasukan, 0, ',', '.') }}
                        @else
                            <p class="text-muted">-</p>
                        @endif
                    </td>
                    <td>
                        @if ($data->pemasukan)
                            {{ \Carbon\Carbon::parse($data->pemasukan['tanggal_pemasukan'])->format('d-m-Y') }}
                        @else
                            <p class="text-muted">-</p>
                        @endif
                    </td>
                    <td>
                        @if ($data->pengeluaran)
                            {{ $data->pengeluaran->keterangan_pengeluaran }}
                        @else
                            <p class="text-muted">-</p>
                        @endif
                    </td>
                    <td>
                        @if ($data->pengeluaran)
                            {{ 'Rp ' . number_format($data->pengeluaran->jumlah_pengeluaran, 0, ',', '.') }}
                        @else
                            <p class="text-muted">-</p>
                        @endif
                    </td>
                    <td>
                        @if ($data->pengeluaran)
                            {{ \Carbon\Carbon::parse($data->pengeluaran['tanggal_pengeluaran'])->format('d-m-Y') }}
                        @else
                            <p class="text-muted">-</p>
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <th colspan="7">Total Pemasukan : {{ 'Rp ' . number_format($total_pemasukan, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="7">Total Pengeluaran : {{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="7">Saldo : {{ 'Rp ' . number_format($total_keseluruhan, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>

</body>

</html>
