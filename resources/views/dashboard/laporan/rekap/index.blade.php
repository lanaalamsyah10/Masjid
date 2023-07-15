@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Rekap Kas Masjid</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title">Data Rekap Kas Masjid Al-Islakh</h4>
                <div class="">
                    <div class="alert alert-success text-light "
                        style="background: linear-gradient(to top, #47acff,#1870d4);" role="alert">

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
                        <h2>
                            {{ 'Rp ' . number_format($total_keseluruhan, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title">Unduh rekap laporan kas pertanggal</h4>
                <form action="{{ url('/laporan-rekap/rekap') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" name="tglawal" id="tglawal"
                                value="{{ empty(session('tglawal')) ? '' : session('tglawal') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" name="tglakhir" id="tglakhir"
                                value="{{ empty(session('tglakhir')) ? '' : session('tglakhir') }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        @if (empty(session('rekapKas')))
                        @else
                            <a target="_blank"
                                href="{{ url('/laporan-rekap/unduh-periode/' . session('tglawal') . '/' . session('tglakhir')) }}"
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-download"> Unduh</i>
                            </a>
                        @endif
                        <button class="btn btn-sm btn-info ml-auto">
                            Cari...&nbsp;
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-right">
                            <a class="btn btn-info btn-sm mb-2" style="background-color: rgb(172, 0, 129)"
                                href="{{ route('dashboard.cetak-laporan-pdf') }}" role="button"><i
                                    class="mdi mdi-download"></i>
                                Unduh Semua</a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="datatable" class="table">
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
                                @if (empty(session('rekap_kas')))
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
                                @else
                                    @forelse (session("rekap_kas") as $item)
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
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
