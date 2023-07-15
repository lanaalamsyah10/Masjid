@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <section class="event-area carousel-shadow single-view default-padding">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2>Kontak</h2>
                    </div>
                </div>
            </div>
            <!-- Start Contact Info                                                                                                                                                                                                 ============================================= -->
            <div class="contact-info-area">

                <div class="row">
                    <!-- Start Contact Info -->
                    <div class="contact-info">
                        <div class="kontak col-md-4 col-sm-4">
                            <div class="item">
                                <div class="icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div class="info">
                                    <h4>Telepon</h4>
                                    <span>08993332343</span>
                                </div>
                            </div>
                        </div>
                        <div class="kontak col-md-4 col-sm-4">
                            <div class="item">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info">
                                    <h4>Alamat</h4>
                                    <span>Jl. Garuda, Karangampel Kidul, Kec. Karangampel, Kabupaten
                                        Indramayu, Jawa Barat 45283</span>
                                </div>
                            </div>
                        </div>
                        <div class="kontak col-md-4 col-sm-4">
                            <div class="item">
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info">
                                    <h4>Email</h4>
                                    <span>masjidapekauman@gmail.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Contact Info -->

                    <div class="seperator col-md-12">
                        <span class="border"></span>
                    </div>

                    <!-- Start Maps & Contact Form -->
                    <div class="maps-form">
                        <div class="col-md-6 maps">
                            <h3>Lokasi</h3>
                            <div class="google-maps">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.430047634984!2d108.4511498142712!3d-6.467079665030993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eea3f91b78b2f%3A0x57bda39c50f1ac58!2sMasjid%20Al%20Islakh!5e0!3m2!1sid!2sid!4v1679325961450!5m2!1sid!2sid"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="col-md-6 form">
                            <div class="heading">
                                <h3>Saran</h3>
                                <p>
                                    Berikan saran anda kepada kami dengan mengisi form saran dibawah ini.
                                </p>
                            </div>
                            <form action="{{ route('kontak.store') }}" method="POST" class="contact-form"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <input class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('nama') }}" id="nama" name="nama" placeholder="Nama"
                                                type="text">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <input class="form-control" id="email" name="email" placeholder="Email"
                                                type="email">
                                            <span class="alert-error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <input class="form-control" id="no_hp" name="no_hp"
                                                placeholder="No. Telepon" type="text">
                                            <span class="alert-error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group comments">
                                            <textarea class="form-control" id="saran" name="saran" placeholder="Isi saran "></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <button type="submit">
                                            Kirim Pesan <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Maps & Contact Form -->
                </div>
            </div>
            <!-- End Contact Info -->
        </div>
    </section>
@endsection
