@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Pengeluaran</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('dashboard.laporan-pengeluaran.store') }}"method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Keterangan</label>
                            <div>
                                <input type="text"
                                    class="form-control @error('keterangan_pengeluaran') is-invalid @enderror"
                                    id="keterangan_pengeluaran" name="keterangan_pengeluaran"required autofocus
                                    value="{{ old('keterangan_pengeluaran') }}" placeholder="Infaq Jamaah" />
                                @error('keterangan_pengeluaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pengeluaran</label>
                                <input type="text" class="form-control input-harga" name="jumlah_pengeluaran"
                                    id="input-harga" value="{{ old('jumlah_pengeluaran') }}" placeholder="Jumlah">
                                @error('jumlah_pengeluaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal_pengeluaran"
                                        id="tanggal_pengeluaran" value="{{ old('tanggal_pengeluaran') }}">
                                    @error('tanggal_pengeluaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                                                onclick="disableButton(this);">
                                                <span id="buttonText">Simpan</span>
                                            </button>

                                            <a href="javascript:window.history.go(-1)"
                                                class="btn btn-secondary waves-effect m-l-5">
                                                Batal
                                            </a>
                                        </div>
                                    </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->
@endsection
