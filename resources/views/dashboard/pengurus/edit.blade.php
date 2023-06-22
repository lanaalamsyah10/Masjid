@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Pengumuman</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <form method="post" action="#"enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title"required autofocus value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="title" class="form-label">Jabatan</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title"required autofocus value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label>Waktu</label>
                            <div>
                                <select class="form-control">
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label>
                            <input type="text" class="form-control item" id="number" placeholder="089898888833">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <div>
                                <input parsley-type="url" type="url" class="form-control" required placeholder="URL" />
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

    </div> <!-- end row -->
@endsection
