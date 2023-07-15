@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12 ">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Pengumuman</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="text-left mb-4">
                        <a class="btn btn-success" href="{{ route('dashboard.pengumuman.create') }}" role="button">Tambah
                            Data</a>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Tempat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengumumanMasjid as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->gambar)
                                                <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->id }}"
                                                    width="100">
                                            @else
                                            @endif
                                        </td>
                                        <td>{{ $item->judul_pengumuman }}</td>
                                        <td>{!! Str::limit(strip_tags($item->isi_pengumuman), 30) !!}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->tempat }}</td>
                                        <td>
                                            <div class="d-flex button-items">
                                                <a class="btn btn-secondary"
                                                    href="{{ route('dashboard.pengumuman.show', $item->id) }}"
                                                    role="button"><i class="mdi mdi-eye"></i></a>
                                                <a href="{{ route('dashboard.pengumuman.edit', $item->id) }}"
                                                    class="btn btn-info"><i class="mdi mdi-lead-pencil"></i></a>
                                                <form action="{{ route('dashboard.pengumuman.destroy', $item->id) }}"
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
