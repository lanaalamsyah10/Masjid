@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Biodata Pengurus</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form method="post"
                        action="{{ route('dashboard.biodata-pengurus.store') }}"enctype="multipart/form-data">
                        @csrf
                        <div class="form-outline mb-4">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" placeholder="Tuliskan nama lengkap..."
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" placeholder="Jabatan..."
                                class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}"
                                required>
                            @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <div>
                                <select class="form-control  @error('jenis_kelamin') is-invalid @enderror"
                                    name="jenis_kelamin" id="jenis_kelamin" value="{{ old('jenis_kelamin') }}" required>
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="no_hp">No HP</label>
                            <input type="text" name="no_hp" id="no_hp"
                                class="form-control @error('no_hp') is-invalid @enderror" placeholder="0891111111"
                                value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat"
                                class="form-control @error('alamat') is-invalid @enderror" placeholder="alamat..."
                                value="{{ old('alamat') }}" required></input>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                    onclick="disableButton2(this);">
                                    <span id="buttonText">Simpan</span>
                                </button>
                                <a href="javascript:window.history.go(-1)" class="btn btn-secondary waves-effect m-l-5">
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
