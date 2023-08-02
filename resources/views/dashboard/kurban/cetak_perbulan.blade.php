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
    <h1>LAPORAN KURBAN MASJID AL-ISLAKH</h1>
    <p class="text">Jl. Garuda, Karangampel Kidul, Kec. Karangampel, Kabupaten Indramayu, Jawa Barat 45283
    </p>
    <hr class="garis">
    <h4> Tanggal:
        {{-- {{ \Carbon\Carbon::parse($tglwal)->format('d-m-Y') }}&nbsp;- --}}
        {{ \Carbon\Carbon::parse($tglakhir)->format('d-m-Y') }}
    </h4>
    <table style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Hewan Kurban</th>
                <th>Jumlah Kurban</th>
                <th>Permintaan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $jumlahakhir = 0;
            @endphp
            @foreach ($kurban as $item)
                @php
                    $jumlahakhir += $item->jumlah;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->hewan_kurban }}</td>
                    <td>{{ $item->jumlah }} Ekor</td>
                    <td>{{ $item->permintaan }}</td>
                    <td>{{ \Carbon\Carbon::parse($item['tanggal_masuk'])->format('d-m-Y') }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="5">Jumlah Kurban :</td>
                <th>{{ $jumlahakhir }}</th>
            </tr>
        </tbody>
    </table>

</body>

</html>
