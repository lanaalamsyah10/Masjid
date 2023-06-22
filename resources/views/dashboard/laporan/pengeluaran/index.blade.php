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

                <div class="form-group row">
                    <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="tglawal" id="tglawal">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="tglakhir" id="tglakhir">
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-beetwen">
                    <a class="btn btn-info btn-sm mb-2" style="background-color: rgb(0, 118, 172)" href=""
                        onclick="this.href='/cetak-data-perbulan/'+ document.getElementById('tglawal').value +
                        '/' + document.getElementById('tglakhir').value"
                        role="button"><i class="mdi mdi-download"></i>
                        Unduh Periode</a> &nbsp;
                    <a class="btn btn-info btn-sm mb-2" style="background-color: rgb(172, 0, 129)"
                        href="{{ route('dashboard.generate-pdf-pengeluaran') }}" role="button"><i
                            class="mdi mdi-download"></i>
                        Unduh Semua</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form method="GET" action="/filter">
                        <div class="row pb-3">
                            <div class="col-md-5 my-4">
                                <a class="btn btn-success" href="{{ route('dashboard.laporan-pengeluaran.create') }}"
                                    role="button">Tambah
                                    Data</a>
                                {{-- <a class="btn btn-primary" href="{{ route('dashboard.laporan-pengeluaran.index') }}"><i
                                        class="mdi mdi-refresh"></i> Refresh</a> --}}
                            </div>
                            <div class="col-md-3">
                                <label>Tanggal Awal</label>
                                <input class="form-control" type="date" name="tglawal" id="tglawal">
                            </div>
                            <div class="col-md-3">
                                <label>Tanggal Akhir</label>
                                <input class="form-control" type="date" name="tglakhir" id="tglakhir">
                            </div>
                            <div class="col-md-1 pt-4">
                                <button type="submit" class="btn badge-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
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
                                @forelse ($pengeluaran_kas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $item->pemasukanKas->keterangan_pemasukan }}</td> --}}
                                        <td>{{ $item->keterangan_pengeluaran }}</td>
                                        <td>{{ 'Rp ' . number_format($item->jumlah_pengeluaran, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['tanggal_pengeluaran'])->format('d-m-Y') }}</td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
