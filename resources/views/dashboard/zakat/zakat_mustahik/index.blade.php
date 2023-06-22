@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Zakat Mustahik</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="text-left mb-4">
                        <a class="btn btn-success" href="{{ url('zakat-zakat_mustahik/create') }}" role="button">Tambah
                            Data</a>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($zakat_mustahik as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="d-flex button-items">
                                                <a class="btn btn-info"
                                                    href="{{ route('dashboard.jadwal-pengajian.edit', $item->id) }}"
                                                    role="button"><i class="mdi mdi-lead-pencil"></i></a>

                                                <button type="button" class="btn btn-danger" id="sa-params"
                                                    value="{{ route('dashboard.jadwal-pengajian.destroy', $item->id) }}"><i
                                                        class="mdi mdi-delete"></i></button>
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
