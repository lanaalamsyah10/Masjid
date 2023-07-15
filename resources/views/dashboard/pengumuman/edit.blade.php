@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Edit Pengumuman</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <form method="POST" action="{{ route('dashboard.pengumuman.update', $pengumumanMasjid->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="judul_pengumuman" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul_pengumuman') is-invalid @enderror"
                                id="judul_pengumuman" name="judul_pengumuman"required autofocus
                                value="{{ $pengumumanMasjid->judul_pengumuman }}">
                        </div>

                        <div class="form-group">
                            <label for="example-date-input">Tanggal</label>
                            <input class="form-control" type="date" value="{{ $pengumumanMasjid->tanggal }}"
                                id="example-date-input" name="tanggal">
                        </div>

                        <div class="form-group">
                            <label>Waktu</label>
                            <div>
                                <input class="form-control" type="time" value="{{ $pengumumanMasjid->waktu }}"
                                    id="example-time-input" name="waktu">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tempat</label>
                            <div>
                                <input type="text" class="form-control @error('tempat') is-invalid @enderror"
                                    id="tempat" name="tempat"required autofocus value="{{ $pengumumanMasjid->tempat }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gambar" class="d-block">Upload Gambar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar" onchange="previewImage(this)">
                                <label class="custom-file-label" for="gambar">
                                    {{-- {{ $pengumumanMasjid->gambar ? basename($pengumumanMasjid->gambar) : 'Pilih file' }} --}}
                                </label>
                                @error('gambar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @if ($pengumumanMasjid->gambar)
                                <img id="preview" src="{{ Storage::url($pengumumanMasjid->gambar) }}"
                                    alt="{{ $pengumumanMasjid->id }}" class="img-thumbnail mt-2" width="300">
                            @else
                                <img id="preview" src="" alt="" class="img-thumbnail mt-2"
                                    style="display: none;">
                            @endif

                            <div class="form-group">
                                <label>Keterangan</label>
                                <div>
                                    <textarea required class="form-control" rows="5" name="isi_pengumuman" id="deskripsi"> {!! htmlspecialchars_decode($pengumumanMasjid->isi_pengumuman) !!}</textarea>
                                </div>
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
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->


    @push('javascript')
        <script>
            document.getElementById('gambar').addEventListener('change', function(e) {
                var fileName = e.target.files[0].name;
                var label = document.querySelector('.custom-file-label');
                label.textContent = fileName;
            });
        </script>
        <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
        <script>
            CKEDITOR.replace('deskripsi');
        </script>
        <script>
            function previewImage(input) {
                var preview = document.getElementById('preview');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            }
        </script>
    @endpush
@endsection
