@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Edit Jadwal Pengajian</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('dashboard.jadwal-pengajian.update', $pengajian->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Hari</label>
                            <div>
                                <input type="text" class="form-control @error('hari') is-invalid @enderror"
                                    id="hari" name="hari"required autofocus value="{{ $pengajian->hari }}" />
                                @error('hari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Pemateri</label>
                                <input type="text" class="form-control  @error('pemateri') is-invalid @enderror"
                                    name="pemateri" id="pemateri" value="{{ $pengajian->pemateri }}">
                                @error('pemateri')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Materi Kajian</label>
                                    <input type="text" class="form-control  @error('materi') is-invalid @enderror"
                                        name="materi" id="materi" value="{{ $pengajian->materi }}">
                                    @error('materi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu</label>
                                        <div>
                                            <input class="form-control @error('waktu') is-invalid @enderror" type="time"
                                                value="{{ $pengajian->waktu }}" id="example-time-input" name="waktu">
                                            @error('waktu')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                                    onclick="disableButton3(this);">
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
