@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <section id="event" class="event-area bg-gray carousel-shadow single-view default-padding">
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
                        {{-- <!-- Single Item -->
                        <div class="item horizontal col-md-12">
                            <div class="col-md-6 thumb bg-cover" style="background-image: url(assets/img/1500x700.png);">
                                <div class="date">
                                    <h4><span>12</span> Dec, 2018</h4>
                                </div>
                            </div>
                            <div class="col-md-6 info">
                                <h4>
                                    <a href="#">Secondary Schools United Nations</a>
                                </h4>
                                <div class="meta">
                                    <ul>
                                        <li><i class="fas fa-calendar-alt"></i> 15 Oct, 2019</li>
                                        <li><i class="fas fa-clock"></i> 8:00 AM - 5:00 PM</li>
                                        <li><i class="fas fa-map"></i> California, TX 70240 </li>
                                    </ul>
                                </div>
                                <p>
                                    Early had add equal china quiet visit. Appear an manner as no limits either praise in.
                                    In in written on charmed justice is amiable farther besides. Law insensible middletons
                                    unsatiable for apartments boy delightful unreserved.
                                </p>
                                <a href="#" class="btn btn-dark effect btn-sm">
                                    <i class="fas fa-chart-bar"></i> Book Now
                                </a>
                                <a href="#" class="btn btn-gray btn-sm">
                                    <i class="fas fa-ticket-alt"></i> 43 Available
                                </a>
                            </div>
                        </div>
                        <!-- Single Item --> --}}

                        <!-- Single Item -->
                        {{-- <div class="item vertical">
                            <div class="thumb">
                                <a href="#"><img src="assets/img/cek2.jpeg" alt="Thumb"></a>
                            </div>
                            <div class="info">
                                <h4>
                                    <a href="#">Actualized Leadership Network</a>
                                </h4>
                                <div class="meta">
                                    <ul>
                                        <li><i class="fas fa-clock"></i> 8:00 AM - 5:00 PM</li>
                                        <li><i class="fas fa-map"></i> California, TX 70240 </li>
                                    </ul>
                                </div>
                                <p>
                                    Early had add equal china quiet visit. Appear an manner as no limits either praise in.
                                    In in written on charmed justice is amiable farther besides.
                                </p>
                                <a href="#" class="btn btn-dark effect btn-xsm">
                                    <i class="fas fa-chart-bar"></i> Book Now
                                </a>
                                <a href="#" class="btn btn-gray btn-xsm">
                                    <i class="fas fa-ticket-alt"></i> 78 Available
                                </a>
                            </div>
                        </div> --}}
                        <!-- Single Item -->

                        <!-- Single Item -->
                        {{-- <div class="item vertical">
                            <div class="thumb">
                                <a href="#"><img src="assets/img/cek.jpeg" alt="Thumb"></a>
                            </div>
                            <div class="info">
                                <h4>
                                    <a href="#">Conference on Art Business</a>
                                </h4>
                                <div class="meta">
                                    <ul>
                                        <li><i class="fas fa-clock"></i> 8:00 AM - 5:00 PM</li>
                                        <li><i class="fas fa-map"></i> California, TX 70240 </li>
                                    </ul>
                                </div>
                                <p>
                                    Early had add equal china quiet visit. Appear an manner as no limits either praise in.
                                    In in written on charmed justice is amiable farther besides.
                                </p>
                                <a href="#" class="btn btn-dark effect btn-xsm">
                                    <i class="fas fa-chart-bar"></i> Book Now
                                </a>
                                <a href="#" class="btn btn-gray btn-xsm">
                                    <i class="fas fa-ticket-alt"></i> 53 Available
                                </a>
                            </div>
                        </div> --}}
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
@endsection
