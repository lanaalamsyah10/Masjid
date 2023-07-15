@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Edit Akun Pengurus</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form method="post"
                        action="{{ route('dashboard.kelola-pengurus.update', $users->id) }}"enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-outline mb-4">
                            <label class="form-label" for="name">Nama</label>
                            <input type="text" name="name" id="name"autofocus
                                class="form-control @error('name') is-invalid @enderror" value="{{ $users->name }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ $users->username }}">
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3cg">Email</label>
                            <input type="email" name="email" value="{{ $users->email }}"
                                class="form-control  @error('email')is-invalid @enderror" id="email" />
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" placeholder="Password" id="password"
                                class="form-control " />
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                    onclick="disableButton3(this);">
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
