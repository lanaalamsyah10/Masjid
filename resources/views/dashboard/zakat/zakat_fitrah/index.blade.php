@extends('dashboard.layouts.main')
@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="table-responsive px-3 py-3">
                <a href="{{ url('zakat-zakat_fitrah/create') }}">
                    tambah data
                </a>
                <p>
                    total beras: {{ $total_beras }} kg
                </p>
                <p>
                    total uang: Rp. {{ $total_uang }}
                </p>
                <table class="table table-bordered">
                    <thead>
                        <th>
                            no
                        </th>
                        <th>
                            nama
                        </th>
                        <th>
                            alamat
                        </th>
                        {{-- <th>
                            jenis zakat
                        </th> --}}
                        {{-- <th>
                            isi zakat
                        </th> --}}
                        <th>
                            jumlah uang
                        </th>
                        <th>
                            jumlah beras
                        </th>
                        <th>
                            aksi
                        </th>
                    </thead>
                    <tbody>
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
                                {{-- <td>
                                    {{ $item->jenis_zakat->nama_zakat }}
                                </td> --}}
                                {{-- <td>
                                    @if (isset($item->isi_zakat))
                                        {{ $item->isi_zakat->jenis_isi }}
                                    @else
                                        -
                                    @endif
                                </td> --}}

                                <td>
                                    @if (isset($item->jumlah_uang))
                                        Rp. {{ number_format($item->jumlah_uang, 0, ',', '.') }}
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
                                <td>
                                    <form action="{{ url('zakat-zakat_fitrah/' . $item->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">
                                            hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 ">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Zakat Fitrah</h4>
            </div>
        </div>
    </div>

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
                                    <th>Jenis Zakat</th>
                                    <th>Isi Zakat</th>
                                    <th>Jumlah Uang</th>
                                    <th>Jumlah Beras</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                            {{-- {{ $item->jenis_zakat->nama_zakat }} --}}
                                        </td>
                                        <td>
                                            @if (isset($item->isi_zakat))
                                                {{ $item->isi_zakat->jenis_isi }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if (isset($item->jumlah_uang))
                                                {{ $item->jumlah_uang }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($item->jumlah_beras))
                                                {{ $item->jumlah_beras }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ url('zakat-zakat_fitrah/' . $item->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">
                                                    hapus
                                                </button>
                                            </form>
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
