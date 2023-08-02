@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Kurban</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">Total Hewan Kurban Masjid Al-Islakh</h4>

                <div class="">
                    <div class="alert alert-success text-light "
                        style="background: linear-gradient(to top, #1cb0dd,#0a8396);" role="alert">

                        <i class=" mdi mdi-information-outline"></i><span>
                            Data Hewan Kurban
                        </span>
                        <h5 class="mt-3">
                            Total Sapi : {{ $totalSapi }} Ekor</h5>
                        <h5>
                            Total Kambing : {{ $totalKambing }} Ekor</h5>
                        <hr>
                        <h2> Total Hewan Kurban : {{ $totalKurban }} Ekor</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-13">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-3">Unduh Data Kurban pertanggal</h4>
                <form action="{{ url('/laporan-kurban/kurban') }}" method="POST">
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
                        @if (empty(session('Kurban')))
                        @else
                            <a target="_blank"
                                href="{{ url('/laporan-kurban/unduh-periode/' . session('tglawal') . '/' . session('tglakhir')) }}"
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
                    <div class="text-left mb-4">
                        <a class="btn btn-success" href="{{ route('dashboard.kurban.create') }}" role="button">Tambah
                            Data</a>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Hewan Kurban</th>
                                    <th>Jumlah Kurban</th>
                                    <th>Permintaan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (empty(session('Kurban')))
                                    @forelse ($kurban as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->hewan_kurban }}</td>
                                            <td>{{ $item->jumlah }} Ekor</td>
                                            <td>{{ $item->permintaan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item['tanggal_masuk'])->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="d-flex button-items">
                                                    <a class="btn btn-info"
                                                        href="{{ route('dashboard.kurban.edit', $item->id) }}"
                                                        role="button"><i class="mdi mdi-lead-pencil"></i></a>
                                                    <form action="{{ route('dashboard.kurban.destroy', $item->id) }}"
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
                                    @forelse (session('Kurban') as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->hewan_kurban }}</td>
                                            <td>{{ $item->jumlah }} Ekor</td>
                                            <td>{{ $item->permintaan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item['tanggal_masuk'])->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="d-flex button-items">
                                                    <a class="btn btn-info"
                                                        href="{{ route('dashboard.kurban.edit', $item->id) }}"
                                                        role="button"><i class="mdi mdi-lead-pencil"></i></a>
                                                    <form action="{{ route('dashboard.kurban.destroy', $item->id) }}"
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
