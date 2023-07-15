@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <!-- Start Banner
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ============================================= -->
    <div class="banner-area content-top-heading less-paragraph text-normal">
        <div id="bootcarousel" class="carousel slide animate_text carousel-fade" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner text-light carousel-zoom">
                <div class="item active">
                    <div class="slider-thumb bg-fixed" style="background-image:  url(assets/img/masjid.jpg);"></div>
                    <div class="box-table shadow dark">
                        <div class="box-cell">
                            <div class="container">
                                <div class="container" data-aos="zoom-out" data-aos-delay="100">
                                    <h4 class="text-center">أَهْلًا وَسَهْلًا فِي</h4>
                                    <h1 class="text-light text-center">MASJID AL-ISLAKH</h1>
                                    <p class=" text-light text-center">“Dan bahwasanya Dia yang memberikan kekayaan dan
                                        memberikan kecukupan.” (QS. An-Najm ayat 48).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Wrapper for slides -->
        </div>
    </div>
    <!-- End Banner -->


    <div class="our-featues-area inc-trending-courses about-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8 our-feature-items ">
                    <div class="row ">
                        <div class="col-md-12 info less-bar ">
                            <h5>Profil Masjid</h5>
                            <h1>MASJID AL-ISLAKH</h1>
                            <p style="text-align: justify">
                                &nbsp;&nbsp;&nbsp; Masjid memiliki peran yang sangat penting dalam kehidupan masyarakat
                                muslim, baik sebagai
                                tempat ibadah, perayaan hari besar islam, kajian agama, membaca Al-Quran, infaq, shodaqoh,
                                serta pendidikan keagamaan dan berbagai kegiatan lainya.
                                Masjid Al-Islakh yang terletak di Desa Karangampel. Masjid ini didirikan pada zaman
                                penjajahan
                                belanda dan menjadi pusat kegiatan keagamaan bagi umat Muslim di sekitar wilayah karangampel
                                kidul.
                            </p>
                            <p style="text-align: justify">
                                &nbsp;&nbsp;&nbsp;Seiring berjalannya waktu, Masjid Al-Islakh mengalami perkembangan. Masjid
                                Al-Islakh juga
                                menyelenggarakan shalat lima waktu, dan kegiatan pengajian rutin. Dengan
                                demikian, Masjid Al-Islakh menjadi pusat spiritual dan intelektual bagi komunitas Muslim di
                                wilayah karangampel kidul.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End Our Features -->

                <!-- End Home Sidebar -->
                <div class="col-md-4 container-fluid home-sidebar">
                    <iframe data-lazyloaded="1" src="https://jadwalsholat.org/jadwal-sholat/monthly.php"
                        data-src="https://jadwalsholat.org/jadwal-sholat/monthly.php" width="430" height="940"
                        frameborder="0" data-ll-status="loaded" class="entered litespeed-loaded"></iframe>
                </div>
                <!-- End Home Sidebar -->

            </div>
        </div>
    </div>
    <section id="event" class="event-area carousel-shadow single-view">
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
                        @foreach ($pengumuman_masjid as $item)
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
                                                    class="fas fa-calendar-alt"></i>{{ $item['tanggal'] . ' | ' . $item['waktu'] . ' WIB- selesai' }}
                                            </li>
                                            <li> <i class=" fas fa-map"></i>{{ $item['tempat'] }}
                                            </li>
                                        </ul>
                                    </div>
                                    <p style="text-align: justify">
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
    @push('style')
        <style>
            .home-sidebar {
                width: 100%;
                padding: 0;
            }

            .home-sidebar iframe {
                width: 100%;
                height: 500px;
                /* ubah sesuai kebutuhan */
            }

            @media (min-width: 768px) {
                .home-sidebar {
                    width: 33.333%;
                    padding: 0 15px;
                    float: left;
                }
            }
        </style>
    @endpush

@endsection
