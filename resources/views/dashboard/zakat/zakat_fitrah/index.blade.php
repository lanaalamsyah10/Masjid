@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12 ">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Zakat Fitrah</h4>
            </div>
        </div>
    </div>
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
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
