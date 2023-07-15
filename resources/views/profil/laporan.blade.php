@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center
        }
    </style>
    <section id="event" class="event-area carousel-shadow single-view default-padding">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Laporan Kas Masjid</h2>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="card">
                    <div class="table-responsive px-3 py-3">
                        <table style="width:100%">
                            <thead>
                                <tr style="background-color: aliceblue">
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
                                @foreach ($rekap_kas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->pemasukan ? $item->pemasukan->keterangan_pemasukan : '-' }}
                                        </td>
                                        <td>
                                            @if ($item->pemasukan)
                                                {{ 'Rp ' . number_format($item->pemasukan->jumlah_pemasukan, 0, ',', '.') }}
                                            @else
                                                <p class="text-muted">-</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->pemasukan)
                                                {{ \Carbon\Carbon::parse($item->pemasukan['tanggal_pemasukan'])->format('d-m-Y') }}
                                            @else
                                                <p class="text-muted">-</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->pengeluaran)
                                                {{ $item->pengeluaran->keterangan_pengeluaran }}
                                            @else
                                                <p class="text-muted">-</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->pengeluaran)
                                                {{ 'Rp ' . number_format($item->pengeluaran->jumlah_pengeluaran, 0, ',', '.') }}
                                            @else
                                                <p class="text-muted">-</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->pengeluaran)
                                                {{ \Carbon\Carbon::parse($item->pengeluaran['tanggal_pengeluaran'])->format('d-m-Y') }}
                                            @else
                                                <p class="text-muted">-</p>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="7">Total Pemasukan :
                                        {{ 'Rp ' . number_format($total_pemasukan, 0, ',', '.') }}</th>
                                </tr>
                                <tr>
                                    <th colspan="7">Total Pengeluaran :
                                        {{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</th>
                                </tr>
                                <tr>
                                    <th colspan="7">Saldo :
                                        {{ 'Rp ' . number_format($total_keseluruhan, 0, ',', '.') }}
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
