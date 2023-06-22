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
                                <th>Nama</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @empty($user->pengurus->nama_pengurus)
                                            <p class="text-muted">Data Kosong</p>
                                        @else
                                            {{ $user->pengurus->nama_pengurus }}
                                        @endempty
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
