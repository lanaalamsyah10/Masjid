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
    <div class="default-padding">
        <div class="container">
            <div class="container mt-5">
                <div class="card">
                    <div class="table-responsive px-3 py-3">

                        <table style="width:100%">
                            <thead>
                                <tr style="background-color: aliceblue">
                                    <th>No</th>
                                    <th>Waktu</th>
                                    <th>Nama Imam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sholat as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->imam }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="our-featues-area inc-trending-courses about-area default-padding">
        <div class="container">
            <div class="card" style="box-shadow: 5px 5px 50px 5px lightblue;">
                <div class="card-body" style="padding: 20px">
                    <table id="datatable" style="width: 100%;" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu</th>
                                <th>Nama Imam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sholat as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->waktu }}</td>
                                    <td>{{ $item->imam }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
