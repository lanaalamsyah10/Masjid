@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Zakat Fitrah</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ url('zakat-zakat_fitrah') }}" method="post" enctype="multipart/form-data">
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
                                    name="alamat" id="alamat" placeholder="alamat...">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Beras</label>
                                    <input type="text" class="form-control  @error('jumlah_beras') is-invalid @enderror"
                                        name="jumlah_beras" id="jumlah_beras" placeholder="jumlah_beras...">
                                    @error('jumlah_beras')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Uang</label>
                                        <input type="text"
                                            class="form-control  @error('jumlah_uang') is-invalid @enderror"
                                            name="jumlah_uang" id="jumlah_uang" placeholder="jumlah_uang...">
                                        @error('jumlah_uang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <div>
                                                <input class="form-control @error('tanggal') is-invalid @enderror"
                                                    type="date" value="{{ old('tanggal') }}" id="example-date-input"
                                                    name="tanggal">
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



    <div class="container mt-5">
        <div class="col-12 col-md-6">
            <div class="card shadow px-3 py-3">
                <h5>
                    tambah data zakat
                </h5>
                <form action="{{ url('zakat-zakat_fitrah') }}" method="POST" class="form-group">
                    @csrf
                    <input type="text" class="form-control mb-2" name="nama" placeholder="nama">
                    <input type="text" class="form-control mb-2" name="alamat" placeholder="alamat">
                    <input type="text" class="form-control mb-2" name="alamat" placeholder="alamat">
                    <input type="text" class="form-control mb-2" name="alamat" placeholder="alamat">
                    <input type="date" class="form-control mb-2" name="tanggal">
                    {{-- <select name="kode_jenis_zakat" id="kode_jenis_zakat_select" class="form-control mb-2">
                        @foreach ($jenis as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_zakat }}
                            </option>
                        @endforeach
                    </select>
                    <select name="kode_isi_zakat" id="kode_isi_zakat_select" class="form-control mb-2"
                        style="display: none;">
                        <option value="{{ $item->id }}" selected disabled>-- Pilih Jenis Isi Zakat --</option>
                        @foreach ($isi_zakat as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->jenis_isi }}
                            </option>
                        @endforeach
                    </select> --}}
                    <input type="text" class="form-control mb-2" name="jumlah_beras" placeholder="jumlah"
                        style="display: none;">
                    <input type="text" class="form-control mb-2" name="jumlah_uang" placeholder="jumlah"
                        style="display: none;">

                    <script>
                        var kodeJenisZakatSelect = document.getElementById('kode_jenis_zakat_select');
                        var kodeIsiZakatSelect = document.getElementById('kode_isi_zakat_select');
                        var jumlahBerasInput = document.getElementById('jumlah_beras_input');
                        var jumlahUangInput = document.getElementById('jumlah_uang_input');

                        kodeJenisZakatSelect.addEventListener('change', function() {
                            if (kodeJenisZakatSelect.value === '2') {
                                kodeIsiZakatSelect.style.display = 'none';
                                jumlahBerasInput.style.display = 'none';
                                jumlahUangInput.style.display = 'none';
                            } else {
                                kodeIsiZakatSelect.style.display = 'block';
                            }
                        });

                        kodeIsiZakatSelect.addEventListener('change', function() {
                            if (kodeIsiZakatSelect.value === '1') {
                                jumlahBerasInput.style.display = 'block';
                                jumlahUangInput.style.display = 'none';
                            } else if (kodeIsiZakatSelect.value === '2') {
                                jumlahBerasInput.style.display = 'none';
                                jumlahUangInput.style.display = 'block';
                            } else {
                                jumlahBerasInput.style.display = 'none';
                                jumlahUangInput.style.display = 'none';
                            }
                        });
                    </script>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>
        </div>
    @endsection
