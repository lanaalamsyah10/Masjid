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

                    <form method="post" action="{{ route('dashboard.pengumuman.store') }}"enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul_pengumuman" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul_pengumuman') is-invalid @enderror"
                                id="judul_pengumuman" name="judul_pengumuman"required autofocus
                                value="{{ old('judul_pengumuman') }}">
                            @error('judul_pengumuman')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="example-date-input">Tanggal</label>
                                <input class="form-control @error('tanggal') is-invalid @enderror" type="date"
                                    value="{{ old('tanggal') }}" id="example-date-input" name="tanggal">
                                @error('tanggal')
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
                                        <label>Tempat</label>
                                        <div>
                                            <input type="text" class="form-control @error('tempat') is-invalid @enderror"
                                                id="tempat" name="tempat"required autofocus value="{{ old('tempat') }}">
                                            @error('tempat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <img alt="image" class="img-preview" style="display: none;" width="100px">
                                            <label for="gambar" class="d-block">Upload Gambar</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="gambar"name="gambar"
                                                    required onchange="previewImage()">
                                                @error('gambar')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    @enderror
                                                    <label class="custom-file-label" for="gambar"></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <div>
                                                    <textarea required class="form-control @error('isi_pengumuman') is-invalid @enderror" rows="5"
                                                        name="isi_pengumuman" id="deskripsi">{{ old('isi_pengumuman') }}</textarea>
                                                    @error('isi_pengumuman')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light"
                                                            onclick="disableButton2(this);">
                                                            <span id="buttonText">Simpan</span>
                                                        </button>
                                                        <a href="javascript:window.history.go(-1)"
                                                            class="btn btn-secondary waves-effect m-l-5">
                                                            Batal
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->
    @push('javascript')
        <script>
            function disableButton(button) {
                button.disabled = true;
                var buttonText = document.getElementById("buttonText");
                buttonText.innerText = "Tunggu...";
                // Menjalankan submit form setelah 500ms
                setTimeout(function() {
                    button.form.submit();
                }, 500);
            }
        </script>
        <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
        <script>
            CKEDITOR.replace('deskripsi');
        </script>
        <script>
            function previewImage() {
                const image = document.querySelector('#gambar');
                const imgPreview = document.querySelector('.img-preview');

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        </script>
    @endpush
@endsection
