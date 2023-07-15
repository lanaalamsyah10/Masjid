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
        <div class="col-md-6 col-lg-6 col-xl-3 dashboard">
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <p class="mb-0 text-muted">Total saldo kas masjid</p>
                    <h5 class="mt-0 round-inner">{{ 'Rp ' . number_format($total_keseluruhan, 0, ',', '.') }}</h5>
                    <div class="round">
                        <i class=" mdi mdi-book-multiple"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 dashboard">
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <p class="mb-0 text-muted">Total pemasukan kas</p>
                    <h5 class="mt-0 round-inner">{{ 'Rp ' . number_format($totalPemasukan, 0, ',', '.') }}</h5>
                    <div class="text-success round">
                        <i class="mdi mdi mdi-arrow-up"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 dashboard">
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <p class="mb-0 text-muted">Total pengeluaran kas</p>
                    <h5 class="mt-0 round-inner">{{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</h5>
                    <div class="text-danger round">
                        <i class="mdi mdi mdi-arrow-down"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 dashboard">
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <p class="mb-0 text-muted">Total pengurus</p>
                    <h5 class="mt-0 round-inner">{{ $pengurus }}</h5>
                    <div class=" round">
                        <i class="mdi mdi-account-multiple"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 dashboard">
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <p class="mb-0 text-muted">Total zakat fitrah</p>
                    <h5 class="mt-0 round-inner">{{ $zakat_fitrah }}</h5>
                    <div class="round">
                        <i class=" mdi mdi-scale-balance"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 dashboard">
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <p class="mb-0 text-muted">Total pengumuman</p>
                    <h5 class="mt-0 round-inner">{{ $pengumuman }}</h5>
                    <div class="round">
                        <i class="mdi mdi mdi-bullhorn"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 dashboard">
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <p class="mb-0 text-muted">Total hewan kurban</p>
                    <h5 class="mt-0 round-inner">{{ $totalKurban }}</h5>
                    <div class=" round">
                        <i class="mdi mdi mdi-cow"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 dashboard">
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <p class="mb-0 text-muted">Total form saran</p>
                    <h5 class="mt-0 round-inner">{{ $saran }}</h5>
                    <div class=" round">
                        <i class="mdi mdi-email"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Column -->
    </div>
@endsection
