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
    {{-- <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-3">Filter Bulan:</h4>
                <form action="{{ url('/laporan-rekap/filter') }}" method="get">
                    @csrf
                    <select name="bulan" id="bulan" class="form-control mb-4" required>
                        <option value="">Pilih Bulan</option>
                        @foreach ($months as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    <h4 class="mt-0 header-title mb-3">Filter Tahun:</h4>
                    <select name="tahun" id="tahun" class="form-control" required>
                        <option value="">Pilih Tahun</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                    <div class="d-flex mt-2 justify-content-between">
                        @if ($bulan)
                            <a href="{{ route('dashboard.generate-pdf-rekap', ['bulan' => $bulan]) }}" target="_blank"
                                class="btn btn-success border-0" style="background-color: rgb(172, 0, 129)"><i
                                    class="fa fa-download"> Unduh</i></a>
                        @endif
                        <button class="btn btn-sm btn-info ml-auto">
                            Cari...&nbsp;
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-3">Filter Bulan:</h4>
                <form action="{{ url('/laporan-rekap/filter') }}" method="get">
                    @csrf
                    <select name="bulan" id="bulan" class="form-control mb-4" required>
                        <option value="">Pilih Bulan</option>
                        @foreach ($months as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    <h4 class="mt-0 header-title mb-3">Filter Tahun:</h4>
                    <select name="tahun" id="tahun" class="form-control" required>
                        <option value="">Pilih Tahun</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                    @if ($showDownloadButton)
                        <div class="col-lg-13">
                            <a href="{{ route('dashboard.generate-pdf-rekap', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                                class="btn btn-success border-0" target="_blank"
                                style="background-color: rgb(172, 0, 129)"><i class="fa fa-download"> Unduh</i></a>
                        </div>
                    @endif
                    <div class="d-flex mt-2 justify-content-between">
                        <button class="btn btn-sm btn-info">
                            Cari...&nbsp;
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-3">Filter Bulan:</h4>
                <form action="{{ url('/laporan-rekap/filter') }}" method="get">
                    @csrf
                    <select name="bulan" id="bulan" class="form-control mb-4" required>
                        <option value="">Pilih Bulan</option>
                        @foreach ($months as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    <h4 class="mt-0 header-title mb-3">Filter Tahun:</h4>
                    <select name="tahun" id="tahun" class="form-control" required>
                        <option value="">Pilih Tahun</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                    <div class="d-flex mt-2 justify-content-between">
                        <button class="btn btn-sm btn-info">
                            Cari...&nbsp;
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($showDownloadButton)
        <div class="col-lg-13">
            <a href="{{ route('dashboard.generate-pdf-rekap', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                class="btn btn-success border-0" style="background-color: rgb(172, 0, 129)"><i
                    class="fa fa-download"> Unduh</i></a>
        </div>
    @endif --}}

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Uraian</th>
                                    <th>Jumlah Pemasukan</th>
                                    <th>Jumlah Pengeluaran</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if ($bulan == null)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Tidak ada data yang tersedia, Silahkan pilih bulan terlebih dahulu.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @else
                                    @foreach ($rekap_kas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->keterangan }}</td>
                                            <td>
                                                @if ($data->tipe == 'pemasukan')
                                                    {{ 'Rp. ' . number_format($data->jumlah, 0, ',', '.') }}
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->tipe == 'pengeluaran')
                                                    {{ 'Rp. ' . number_format($data->jumlah, 0, ',', '.') }}
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                    @else
                                    @forelse (session("rekap_kas") as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($item->pemasukan)
                                                    {{ $item->pemasukan->keterangan_pemasukan ?? '-' }}
                                                @elseif ($item->pengeluaran)
                                                    {{ $item->pengeluaran->keterangan_pengeluaran ?? '-' }}
                                                @else
                                                    <p class="text-muted">-</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->pemasukan)
                                                    {{ 'Rp. ' . number_format($item->pemasukan->jumlah_pemasukan ?? 0, 0, ',', '.') }}
                                                @else
                                                    <p class="text-muted">Rp.</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->pengeluaran)
                                                    {{ 'Rp. ' . number_format($item->pengeluaran->jumlah_pengeluaran ?? 0, 0, ',', '.') }}
                                                @else
                                                    <p class="text-muted">Rp. 0</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->pemasukan)
                                                    {{ \Carbon\Carbon::parse($item->pemasukan->tanggal_pemasukan)->format('d-m-Y') ?? '-' }}
                                                @elseif ($item->pengeluaran)
                                                    {{ \Carbon\Carbon::parse($item->pengeluaran->tanggal_pengeluaran)->format('d-m-Y') ?? '-' }}
                                                @else
                                                    <p class="text-muted">-</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif --}}



                                @if ($bulan && $tahun == null)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Tidak ada data yang tersedia, Silahkan pilih bulan dan tahun terlebih dahulu.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if ($bulan && $tahun)
                                    @foreach ($rekap_kas as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->keterangan }}
                                            </td>
                                            <td>
                                                @if ($item->tipe == 'pemasukan')
                                                    {{ 'Rp. ' . number_format($item->jumlah, 0, ',', '.') }}
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->tipe == 'pengeluaran')
                                                    {{ 'Rp. ' . number_format($item->jumlah, 0, ',', '.') }}
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                            {{-- <td>
                                                {{ $item->tipe }}
                                            </td> --}}
                                            <td>
                                                {{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @elseif($bulan)
                                    @foreach ($rekap_kas as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->keterangan }}
                                            </td>
                                            <td>
                                                @if ($item->tipe == 'pemasukan')
                                                    {{ 'Rp. ' . number_format($item->jumlah, 0, ',', '.') }}
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->tipe == 'pengeluaran')
                                                    {{ 'Rp. ' . number_format($item->jumlah, 0, ',', '.') }}
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @elseif($tahun)
                                    @foreach ($rekap_kas as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->keterangan }}
                                            </td>
                                            <td>
                                                @if ($item->tipe == 'pemasukan')
                                                    {{ 'Rp. ' . number_format($item->jumlah, 0, ',', '.') }}
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->tipe == 'pengeluaran')
                                                    {{ 'Rp. ' . number_format($item->jumlah, 0, ',', '.') }}
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}
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
