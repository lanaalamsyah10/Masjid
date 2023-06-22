@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Pengumuman</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="">
                        @if ($->gambar)
                            <img src="{{ Storage::url($pengumumanMasjid->gambar) }}" class="img-fluid"
                                alt="Responsive image">
                        @elsepengumumanMasjid
                        @endif

                    </div>
                    <h4 class="mt-3 header-title">{{ $pengumumanMasjid->judul_pengumuman }}</h4>
                    <p class="text-muted font-14"><i class="mdi mdi-calendar-clock"></i>
                        {{ \Carbon\Carbon::parse($pengumumanMasjid['tanggal'])->format('d-m-Y') . ' | ' . $pengumumanMasjid['waktu'] . ' WIB- Selesai' }}
                        &nbsp;<i class="mdi mdi-map-marker"></i>{{ $pengumumanMasjid->tempat }}</p>
                    <hr>
                    <p style="text-align: justify">
                        {!! htmlspecialchars_decode($pengumumanMasjid->isi_pengumuman) !!}
                    </p>
                    <div class="form-group">
                        <div>
                            <a href="javascript:window.history.go(-1)" class="btn btn-secondary waves-effect m-l-5"><i
                                    class="mdi mdi-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
