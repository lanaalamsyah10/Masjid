@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Jadwal Imam</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('dashboard.jadwal-sholat.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Waktu</label>
                            <div>
                                <select class="form-control  @error('waktu') is-invalid @enderror" name="waktu"
                                    id="waktu" required>
                                    <option>Subuh</option>
                                    <option>Dzuhur</option>
                                    <option>Ashar</option>
                                    <option>Maghrib</option>
                                    <option>Isya</option>
                                </select>
                                @error('waktu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Imam</label>
                            <input type="text" class="form-control  @error('imam') is-invalid @enderror" name="imam"
                                id="imam" placeholder="nama...">
                            @error('imam')
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

                                    <a href="javascript:window.history.go(-1)" class="btn btn-secondary waves-effect m-l-5">
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
