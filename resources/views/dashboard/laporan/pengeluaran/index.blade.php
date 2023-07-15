@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Pengeluaran Kas Masjid</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title">Saldo Pengeluaran Kas Masjid Al-Islakh</h4>
                <div class="">
                    <div class="alert alert-danger text-light " style="background-color: red" role="alert">
                        <i class=" mdi mdi-information-outline"></i><span>
                            Total Pengeluaran Kas Masjid
                        </span>
                        <h2>{{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-3">Unduh laporan pengeluaran kas pertanggal</h4>
                <form action="{{ url('/laporan-pengeluaran/pengeluaran') }}" method="POST">
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
                        @if (empty(session('pengeluaranKas')))
                        @else
                            <a target="_blank"
                                href="{{ url('/laporan-pengeluaran/unduh-periode/' . session('tglawal') . '/' . session('tglakhir')) }}"
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
                        <div class="col text-left">
                            <a class="btn btn-sm btn-success" href="{{ route('dashboard.laporan-pengeluaran.create') }}"
                                role="button">Tambah Data</a>
                        </div>
                        <div class="col text-right">
                            <a class="btn btn-sm btn-success mb-2 nobe " style="background-color: rgb(172, 0, 129)"
                                href="{{ route('dashboard.generate-pdf-pengeluaran') }}" role="button"><i
                                    class="mdi mdi-download"></i>
                                Unduh</a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (empty(session('pengeluaranKas')))
                                    @forelse ($pengeluaran_kas as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->keterangan_pengeluaran }}</td>
                                            <td>{{ 'Rp ' . number_format($item->jumlah_pengeluaran, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item['tanggal_pengeluaran'])->format('d-m-Y') }}
                                            </td>
                                            <td>
                                                <div class="d-flex button-items">
                                                    <a class="btn btn-info"
                                                        href="{{ route('dashboard.laporan-pengeluaran.edit', $item->id) }}"
                                                        role="button"><i class="mdi mdi-lead-pencil"></i></a>
                                                    <form
                                                        action="{{ route('dashboard.laporan-pengeluaran.destroy', $item->id) }}"
                                                        method="POST" onsubmit="return deleteConfirmation(event)">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="mdi mdi-delete"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @forelse (session("pengeluaranKas") as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->keterangan_pengeluaran }}</td>
                                            <td>{{ 'Rp ' . number_format($item->jumlah_pengeluaran, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item['tanggal_pengeluaran'])->format('d-m-Y') }}
                                            </td>
                                            <td>
                                                <div class="d-flex button-items">
                                                    <a class="btn btn-info"
                                                        href="{{ route('dashboard.laporan-pengeluaran.edit', $item->id) }}"
                                                        role="button"><i class="mdi mdi-lead-pencil"></i></a>
                                                    <form
                                                        action="{{ route('dashboard.laporan-pengeluaran.destroy', $item->id) }}"
                                                        method="POST" onsubmit="return deleteConfirmation(event)">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="mdi mdi-delete"></i></button>
                                                    </form>
                                                </div>
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
