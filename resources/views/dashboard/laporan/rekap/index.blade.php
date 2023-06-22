@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Datatable</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">Backgrounds</h4>
                <p class="text-muted m-b-30 font-14">Use background utility classes to
                    change the appearance of individual progress bars.</p>

                <div class="">
                    <div class="alert alert-success text-light " style="background-color: rgb(48, 172, 230)" role="alert">

                        <i class=" mdi mdi-information-outline"></i><span style="color:white;font-weight:bold;">
                            Rekap Kas Masjid
                        </span>
                        <h6 class="mt-3">
                            Pemasukan : {{ 'Rp ' . number_format($total_pemasukan, 0, ',', '.') }}
                        </h6>
                        <h6>
                            Pengeluaran : {{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}
                        </h6>
                        <hr>
                        <h1>
                            {{ 'Rp ' . number_format($total, 0, ',', '.') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title">Backgrounds</h4>
                <p class="text-muted m-b-30 font-14">Use background utility classes to
                    change the appearance of individual progress bars.</p>

                <div class="form-group row">
                    <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                    </div>
                </div>
                <a class="btn text-white" style="background-color: rgb(172, 0, 129)" href="" role="button"><i
                        class="mdi mdi-download"></i>
                    Unduh PDF</a> <a class="btn text-white" style="background-color: rgb(172, 0, 129)" href=""
                    role="button"><i class="mdi mdi-download"></i>
                    Unduh PDF</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mb-5 header-title">Data Rekap Kas Masjid</h4>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
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
                                                <p class="text-muted">Data tidak ada</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->pemasukan)
                                                {{ $item->pemasukan->tanggal_pemasukan }}
                                            @else
                                                <p class="text-muted">Data tidak ada</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->pengeluaran)
                                                {{ $item->pengeluaran->keterangan_pengeluaran }}
                                            @else
                                                <p class="text-muted">Data tidak ada</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->pengeluaran)
                                                {{ 'Rp ' . number_format($item->pengeluaran->jumlah_pengeluaran, 0, ',', '.') }}
                                            @else
                                                <p class="text-muted">Data tidak ada</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->pengeluaran)
                                                {{ $item->pengeluaran->tanggal_pengeluaran }}
                                            @else
                                                <p class="text-muted">Data tidak ada</p>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
