{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <ul>
        @foreach ($pengeluaran as $data)
            <li>Pengeluaran : {{ $data['keterangan_pengeluaran'] }}</li>
            <li>Jumlah : {{ $data['jumlah_pengeluaran'] }}</li>
            <li>Tanggal masuk : {{ $data['tanggal_pengeluaran'] }}</li>
        @endforeach
    </ul>
</body>

</html> --}}


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
    <h1>LAPORAN PENGELUARAN KAS MASJID AL-ISLAKH</h1>
    <p class="text">Jl. Garuda, Karangampel Kidul, Kec. Karangampel, Kabupaten Indramayu, Jawa Barat 45283
    </p>
    <hr class="garis">
    <table style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengeluaran as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data['keterangan_pengeluaran'] }}</td>
                    <td>{{ $data['tanggal_pengeluaran'] }}</td>
                    <td>{{ 'Rp ' . number_format($data->jumlah_pengeluaran, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">Total saldo :</td>
                <th>{{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>

</body>

</html>
