@extends('layouts.main')
@section('title', 'Home')
@section('content')
    @if ($pengumuman->count())
        <section id="event" class="event-area carousel-shadow single-view default-padding">
            <div class="container">
                <div class="row">
                    <div class="site-heading text-center">
                        <div class="col-md-8 col-md-offset-2">
                            <h2>Pengumuman</h2>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="event-items event-carousel owl-theme">
                            <!-- Single Item -->
                            @foreach ($pengumuman as $item)
                                <!-- Single Item -->
                                <div class="item vertical" style="margin-bottom: 100px">
                                    <div class="thumb">
                                        <a href="#"><img src="{{ Storage::url($item['gambar']) }}"
                                                alt="{{ $item['gambar'] }}" width="100%"></a>
                                    </div>
                                    <div class="info">
                                        <h4>
                                            <a href="#">{{ $item['judul_pengumuman'] }}</a>
                                        </h4>
                                        <div class="meta">
                                            <ul>
                                                <li><i
                                                        class="fas fa-calendar"></i>{{ $item['tanggal'] . ' | ' . $item['waktu'] . ' WIB- selesai' }}
                                                </li>
                                                <li><i class="fas fa-map"></i>{{ $item['tempat'] }}</li>
                                            </ul>
                                        </div>
                                        <p>
                                            {!! htmlspecialchars_decode($item->isi_pengumuman) !!}
                                        </p>
                                    </div>
                                </div>
                                <!-- Single Item -->
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="error-page-area default-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center content">
                        <h1>404</h1>
                        <h3>Tidak menemukan data yang anda cari!</h3>
                        <a class="btn btn-dark effect btn-md" href="javascript:window.history.go(-1)"> <i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
