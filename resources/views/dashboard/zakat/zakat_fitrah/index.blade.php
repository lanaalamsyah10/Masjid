@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12 ">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Zakat Fitrah</h4>
            </div>
        </div>
    </div>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">Total beras dan uang zakat fitrah</h4>

                <div class="">
                    <div class="alert alert-success text-light "
                        style="background: linear-gradient(to top, #ae20b3,#903fdb);" role="alert">

                        <i class=" mdi mdi-information-outline"></i><span>
                            Data beras dan uang zakat fitrah
                        </span>
                        <h5 class="mt-3">
                            Total Beras : {{ $total_beras }} Kg
                        </h5>
                        <h5>
                            Total Uang : {{ 'Rp ' . number_format($total_uang, 0, ',', '.') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <form action="{{ route('dashboard.zakat-zakat_fitrah.filter') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="tahun">Filter Tahun:</label>
            <select name="tahun" id="tahun" class="form-control">
                <option value="">Pilih Tahun</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form> --}}
    {{-- <form action="{{ route('dashboard.zakat-zakat_fitrah.index') }}" method="get">
        @csrf
        <div class="form-group">
            <label for="tahun">Filter Tahun:</label>
            <select name="tahun" id="tahun" class="form-control">
                <option value="">Pilih Tahun</option>
                @foreach ($available_years as $year)
                    <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form> --}}
    {{-- @if ($zakat_fitrah->isEmpty())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Tidak ada data yang tersedia.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @else
        <!-- ... Kode untuk menampilkan tabel dan total seperti sebelumnya ... -->
    @endif --}}
    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-3">Filter Tahun:</h4>
                <form action="{{ route('dashboard.zakat-zakat_fitrah.index') }}" method="get">
                    @csrf
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">Pilih Tahun</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                    <div class="d-flex mt-2 justify-content-between">
                        @if ($tahun)
                            <a href="{{ route('dashboard.generate-pdf-zakat_fitrah', ['tahun' => $tahun]) }}"
                                class="btn btn-success border-0" target="_blank"
                                style="background-color: rgb(172, 0, 129)"><i class="fa fa-download"> Unduh</i></a>
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
    {{-- <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-3">Unduh Data Kurban pertanggal</h4>
                <form action="{{ url('/zakat-zakat_fitrah/zakat_fitrah') }}" method="POST">
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
                        @if (empty(session('zakat_fitrah')))
                        @else
                            <a target="_blank"
                                href="{{ url('/zakat-zakat_fitrah/unduh-periode/' . session('tglawal') . '/' . session('tglakhir')) }}"
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
    </div> --}}
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="text-left mb-4">
                        <a class="btn btn-success" href="{{ url('zakat-zakat_fitrah/create') }}" role="button">Tambah
                            Data</a>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jumlah Uang</th>
                                    <th>Jumlah Beras</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if (empty(session('zakat_fitrah')))
                                    @forelse ($zakat_fitrah as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                            <td>
                                                {{ $item->alamat }}
                                            </td>
                                            <td>
                                                @if (isset($item->jumlah_uang))
                                                    {{ 'Rp. ' . number_format($item->jumlah_uang, 0, ',', '.') }}
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($item->jumlah_beras))
                                                    {{ $item->jumlah_beras }} kg
                                                @else
                                                    0 kg
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="d-flex button-items">
                                                    <a class="btn btn-info"
                                                        href="{{ route('dashboard.zakat-zakat_fitrah.edit', $item->id) }}"
                                                        role="button"><i class="mdi mdi-lead-pencil"></i></a>

                                                    <form
                                                        action="{{ route('dashboard.zakat-zakat_fitrah.destroy', $item->id) }}"
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
                                    @forelse (session('zakat_fitrah') as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                            <td>
                                                {{ $item->alamat }}
                                            </td>
                                            <td>
                                                @if (isset($item->jumlah_uang))
                                                    {{ 'Rp ' . number_format($item->jumlah_uang, 0, ',', '.') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($item->jumlah_beras))
                                                    {{ $item->jumlah_beras }} kg
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="d-flex button-items">
                                                    <a class="btn btn-info"
                                                        href="{{ route('dashboard.zakat-zakat_fitrah.edit', $item->id) }}"
                                                        role="button"><i class="mdi mdi-lead-pencil"></i></a>

                                                    <form
                                                        action="{{ route('dashboard.zakat-zakat_fitrah.destroy', $item->id) }}"
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
                                @endif --}}

                                {{-- @foreach (empty(session('zakat_fitrah')) ? $zakat_fitrah : session('zakat_fitrah') as $item) --}}
                                @if ($tahun == null)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Tidak ada data yang tersedia, Silahkan pilih tahun terlebih dahulu.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @else
                                    @foreach ($zakat_fitrah as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                            <td>
                                                {{ $item->alamat }}
                                            </td>
                                            <td>
                                                @if (isset($item->jumlah_uang))
                                                    {{ 'Rp. ' . number_format($item->jumlah_uang, 0, ',', '.') }}
                                                @else
                                                    Rp. 0
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($item->jumlah_beras))
                                                    {{ $item->jumlah_beras }} kg
                                                @else
                                                    0 kg
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="d-flex button-items">
                                                    <a class="btn btn-info"
                                                        href="{{ route('dashboard.zakat-zakat_fitrah.edit', $item->id) }}"
                                                        role="button"><i class="mdi mdi-lead-pencil"></i></a>

                                                    <form
                                                        action="{{ route('dashboard.zakat-zakat_fitrah.destroy', $item->id) }}"
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
                                {{-- @foreach ($zakat_fitrah as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $item->nama }}
                                        </td>
                                        <td>
                                            {{ $item->alamat }}
                                        </td>
                                        <td>
                                            @if (isset($item->jumlah_uang))
                                                {{ 'Rp ' . number_format($item->jumlah_uang, 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($item->jumlah_beras))
                                                {{ $item->jumlah_beras }} kg
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="d-flex button-items">
                                                <a class="btn btn-info"
                                                    href="{{ route('dashboard.zakat-zakat_fitrah.edit', $item->id) }}"
                                                    role="button"><i class="mdi mdi-lead-pencil"></i></a>

                                                <form
                                                    action="{{ route('dashboard.zakat-zakat_fitrah.destroy', $item->id) }}"
                                                    method="POST" onsubmit="return deleteConfirmation(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="mdi mdi-delete"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
