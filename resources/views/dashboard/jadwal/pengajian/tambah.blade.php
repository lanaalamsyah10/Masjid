@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Jadwal Pengajian</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form class="" action="#">
                        <div class="form-group">
                            <label>Hari</label>
                            <div>
                                <select class="form-control">
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jum'at</option>
                                    <option>Sabtu</option>
                                    <option>Minggu</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Pengisi Acara</label>
                            <input type="text" class="form-control" id="title" placeholder="KH. Agus Wijaya S.Pd.">
                        </div>
                        <div class="form-group">
                            <label>Waktu</label>
                            <div>
                                <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Simpan
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

    </div> <!-- end row --> --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('dashboard.jadwal-pengajian.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Hari</label>
                            <div>
                                <input type="text" class="form-control @error('hari') is-invalid @enderror"
                                    id="hari" name="hari"required autofocus value="{{ old('hari') }}"
                                    placeholder="senin" />
                                @error('hari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Pemateri</label>
                                <input type="text" class="form-control  @error('pemateri') is-invalid @enderror"
                                    name="pemateri" id="pemateri" placeholder="nama...">
                                @error('pemateri')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Waktu</label>
                                    <div>
                                        <input class="form-control @error('waktu') is-invalid @enderror" type="time"
                                            value="{{ old('waktu') }}" id="example-time-input" name="waktu">
                                        @error('waktu')
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

    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('dashboard.jadwal-pengajian.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Hari</label>
                            <div>
                                <input type="text" class="form-control @error('hari') is-invalid @enderror"
                                    id="hari" name="hari"required autofocus value="{{ old('hari') }}"
                                    placeholder="Infaq Jamaah" />
                                @error('hari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pemasukan</label>
                            <input type="text" class="form-control  @error('pemateri') is-invalid @enderror"
                                name="pemateri" id="pemateri" placeholder="Jumlah">
                            @error('pemateri')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Waktu</label>
                            <div>
                                <input class="form-control @error('waktu') is-invalid @enderror" type="time"
                                    value="{{ old('waktu') }}" id="example-time-input" name="waktu">
                                @error('waktu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
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

    </div> --}}
@endsection
