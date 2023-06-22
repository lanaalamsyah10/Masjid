<!DOCTYPE html>
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

</html>
