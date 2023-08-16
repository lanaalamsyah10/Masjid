<!-- resources/views/dashboard/laporan/pemasukan/preview.blade.php -->
@extends('dashboard.layouts.main')

@section('content')
    <h2>Preview Hasil Filter</h2>

    <h4>Total Pemasukan: {{ 'Rp ' . number_format($totalPemasukan, 0, ',', '.') }}</h4>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Pemasukan</th>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            @foreach ($pemasukanKas as $pemasukan)
                <tr>
                    <td>{{ $pemasukan->tanggal }}</td>
                    <td>{{ 'Rp ' . number_format($pemasukan->jumlah_pemasukan, 0, ',', '.') }}</td>
                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
