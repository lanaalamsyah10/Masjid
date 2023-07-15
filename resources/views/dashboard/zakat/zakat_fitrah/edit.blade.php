@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Edit Zakat Fitrah</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('dashboard.zakat-zakat_fitrah.update', $zakat_fitrah->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama</label>
                            <div>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama"required autofocus value="{{ $zakat_fitrah->nama }}"
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
                                    name="alamat" id="alamat" value="{{ $zakat_fitrah->alamat }}">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Beras</label>
                                    <input type="text"
                                        class="form-control input-beras  @error('jumlah_beras') is-invalid @enderror"
                                        name="jumlah_beras" id="input-beras" value="{{ $zakat_fitrah->jumlah_beras }}">
                                    @error('jumlah_beras')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Uang</label>
                                        <input type="text"
                                            class="form-control  @error('jumlah_uang') is-invalid @enderror"
                                            name="jumlah_uang" id="input-harga"
                                            value="{{ $zakat_fitrah->jumlah_uang ? 'Rp ' . number_format($zakat_fitrah->jumlah_uang, 0, ',', '.') : '' }}">
                                        @error('jumlah_uang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <div>
                                                <input class="form-control @error('tanggal') is-invalid @enderror"
                                                    type="date" value="{{ $zakat_fitrah->tanggal }}"
                                                    id="example-date-input" name="tanggal">
                                                @error('tanggal')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light"
                                                        onclick="disableButton1(this);">
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
