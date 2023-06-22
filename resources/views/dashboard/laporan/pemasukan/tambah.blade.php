@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Pemasukan</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('dashboard.laporan-pemasukan.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Keterangan</label>
                            <div>
                                <input type="text"
                                    class="form-control @error('keterangan_pemasukan') is-invalid @enderror"
                                    id="keterangan_pemasukan" name="keterangan_pemasukan"required autofocus
                                    value="{{ old('keterangan_pemasukan') }}" placeholder="Infaq Jamaah" />
                                @error('keterangan_pemasukan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pemasukan</label>
                                <input type="text"
                                    class="form-control input-harga  @error('jumlah_pemasukan') is-invalid @enderror"
                                    name="jumlah_pemasukan" id="input-harga" placeholder="Jumlah">
                                @error('jumlah_pemasukan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input class="form-control  @error('tanggal_pemasukan') is-invalid @enderror"
                                        type="date" name="tanggal_pemasukan" id="tanggal_pemasukan">
                                    @error('tanggal_pemasukan')
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
