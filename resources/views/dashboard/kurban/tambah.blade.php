@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Kurban</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('dashboard.kurban.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <div>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama"required autofocus value="{{ old('nama') }}"
                                    placeholder="Nama..." />
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Hewan Kurban</label>
                                <div>
                                    <select class="form-control  @error('hewan_kurban') is-invalid @enderror"
                                        name="hewan_kurban" id="hewan_kurban" value="{{ old('hewan_kurban') }}" required>
                                        <option>Sapi</option>
                                        <option>Kambing</option>
                                    </select>
                                    @error('hewan_kurban')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Kurban</label>
                                <input type="text"
                                    class="form-control input-jumlah @error('jumlah') is-invalid @enderror" name="jumlah"
                                    id="input-jumlah" value="{{ old('jumlah') }}" placeholder="jumlah...">
                                @error('jumlah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Permintaan</label>
                                    <div>
                                        <input type="text" class="form-control @error('permintaan') is-invalid @enderror"
                                            id="permintaan" name="permintaan"required autofocus
                                            value="{{ old('permintaan') }}" placeholder="Permintaan..." />
                                        @error('permintaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control  @error('tanggal_masuk') is-invalid @enderror"
                                            type="date" name="tanggal_masuk" id="tanggal_masuk"
                                            value="{{ old('tanggal') }}">
                                        @error('tanggal_masuk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            @enderror
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

    </div> <!-- end row -->
@endsection
