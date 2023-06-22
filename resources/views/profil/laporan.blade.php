@extends('layouts.main')
@section('title', 'Home')
@section('content')

    <div class="our-featues-area inc-trending-courses about-area default-padding">
        <div class="container">
            <div class="card" style="box-shadow: 5px 5px 50px 5px lightblue;">
                <div class="card-body" style="padding: 20px">
                    <table id="datatable" style="width: 100%;" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Uraian Pemasukan</th>
                                <th>Tanggal Pemasukan</th>
                                <th>Pemasukan</th>
                                <th>Uraian Pengeluaran</th>
                                <th>Pengeluaran</th>
                                <th>Tanggal Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @forelse ($kas_masjid as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal_pemasukan }}</td>
                                    <td>{{ $item->keterangan_pemasukan }}</td>
                                    <td>{{ 'Rp ' . number_format($item->jumlah_pemasukan, 0, ',', '.') }}</td>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
