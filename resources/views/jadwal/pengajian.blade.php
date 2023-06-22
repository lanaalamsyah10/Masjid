@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <div class="our-featues-area inc-trending-courses about-area default-padding">
        <div class="container">
            <div class="card" style="box-shadow: 5px 5px 50px 5px lightblue;">
                <div class="card-body" style="padding: 20px">
                    <table id="datatable" style="width: 100%;" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Nama Pemateri</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajian as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ $item->pemateri }}</td>
                                    <td>{{ $item->waktu }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
