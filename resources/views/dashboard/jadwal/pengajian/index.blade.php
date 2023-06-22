@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Jadwal Pengajian</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="text-left mb-4">
                        <a class="btn btn-success" href="{{ route('dashboard.jadwal-pengajian.create') }}"
                            role="button">Tambah
                            Data</a>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <th>Hari</th>
                                    <th>Nama Pemateri</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajian as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->hari }}</td>
                                        <td>{{ $item->pemateri }}</td>
                                        <td>{{ $item->waktu . ' WIB' }}</td>
                                        <td>
                                            <div class="d-flex button-items">
                                                <a class="btn btn-info"
                                                    href="{{ route('dashboard.jadwal-pengajian.edit', $item->id) }}"
                                                    role="button"><i class="mdi mdi-lead-pencil"></i></a>
                                                <form action="{{ route('dashboard.jadwal-pengajian.destroy', $item->id) }}"
                                                    method="POST" onsubmit="return deleteConfirmation(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="mdi mdi-delete"></i></button>
                                                </form>
                                                {{-- <button type="button" class="btn btn-danger" id="sa-params"
                                                    value="{{ route('dashboard.jadwal-pengajian.destroy', $item->id) }}"><i
                                                        class="mdi mdi-delete"></i></button> --}}
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
