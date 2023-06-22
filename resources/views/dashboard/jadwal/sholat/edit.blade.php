@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Annex</a></li>
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active">Form Validation</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Jadwal Imam</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form class="" action="#">

                        <div class="form-group">
                            <label>Waktu</label>
                            <div>
                                <select class="form-control">
                                    <option>Subuh</option>
                                    <option>Dzuhur</option>
                                    <option>Ashar</option>
                                    <option>Maghrib</option>
                                    <option>Isya'</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Imam</label>
                            <input type="text" class="form-control" id="title" placeholder="KH. Agus Wijaya S.Pd.">
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
