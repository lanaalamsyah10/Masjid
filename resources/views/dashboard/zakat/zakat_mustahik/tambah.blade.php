@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Zakat Mustahik</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('dashboard.zakat-zakat_mustahik.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <div>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama"required autofocus value="{{ old('nama') }}"
                                    placeholder="Nama mustahik" />
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control  @error('alamat') is-invalid @enderror"
                                    name="alamat" id="alamat" placeholder="alamat..." value="{{ old('alamat') }}">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div>
                                        <input class="form-control @error('tanggal') is-invalid @enderror" type="date"
                                            value="{{ old('tanggal') }}" id="example-date-input" name="tanggal">
                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                                                onclick="disableButton2(this);">
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

    </div>
@endsection
