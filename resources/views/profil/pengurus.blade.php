@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center
        }
    </style>
    <section id="event" class="event-area carousel-shadow single-view default-padding">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Pengurus Masjid</h2>

                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="card">
                    <div class="table-responsive px-3 py-3">
                        <table style="width:100%">
                            <thead>
                                <tr style="background-color: aliceblue">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengurus as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->jabatan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
