@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-6 col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-information"></i>
                            </div>
                        </div>
                        <div class="col-6 text-center align-self-center">
                            <div class="m-l-10 ">

                                <h5 class="mt-0 round-inner">{{ 'Rp ' . number_format($total_keseluruhan, 0, ',', '.') }}
                                </h5>
                                <p class="mb-0 text-muted">Total saldo kas masjid</p>
                            </div>
                        </div>
                        <div class="col-3 align-self-end align-self-center">
                            <h6 class="m-0 float-right text-center"> <i class="mdi mdi-book-multiple"></i>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="text-success round">
                                <i class="mdi mdi-arrow-up"></i>
                            </div>
                        </div>
                        <div class="col-6 text-center align-self-center">
                            <div class="m-l-10 ">

                                <h5 class="mt-0 round-inner">{{ 'Rp ' . number_format($totalPemasukan, 0, ',', '.') }}</h5>
                                <p class="mb-0 text-muted">Total pemasukan kas </p>
                            </div>
                        </div>
                        <div class="col-3 align-self-end align-self-center">
                            <h6 class="m-0 float-right text-center "> <i class="mdi mdi-book-open-page-variant"></i>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center text-danger">
                            <div class="text-danger round">
                                <i class="mdi mdi mdi-arrow-down"></i>
                            </div>
                        </div>
                        <div class="col-6 text-center align-self-center">
                            <div class="m-l-10 ">

                                <h5 class="mt-0 round-inner">{{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}
                                </h5>
                                <p class="mb-0 text-muted">Total pengeluaran kas</p>
                            </div>
                        </div>
                        <div class="col-3 align-self-end align-self-center">
                            <h6 class="m-0 float-right text-center "> <i class="mdi mdi-book-open-page-variant"></i>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
@endsection
