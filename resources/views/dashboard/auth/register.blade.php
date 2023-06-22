<link rel="shortcut icon" href="{{ asset('db/assets/images/favicon.ico') }}">

<link href="{{ asset('db/assets/plugins/morris/morris.css') }}" rel="stylesheet">

<link href="{{ asset('db/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('db/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('db/assets/css/style.css') }}" rel="stylesheet" type="text/css">


<!-- Begin page -->
<section class="h-100 bg-register">
    <div class="container py-3 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-10">
                <div class="card  text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registrasi</p>

                                <form action="/register" method="post">
                                    @csrf
                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4cd">Nama</label>
                                            <input type="text" name="name" placeholder="Nama" autofocus required
                                                value="{{ old('name') }}"
                                                class="form-control @error('name')is-invalid @enderror"
                                                id="name" />
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4cd">Username</label>
                                            <input type="text" name="username" placeholder="Username" required
                                                value="{{ old('username') }}"
                                                class="form-control @error('username')is-invalid @enderror"
                                                id="username" />
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example3c">Email</label>
                                            <input type="email" name="email" placeholder="nama@gmail.com" required
                                                value="{{ old('email') }}"
                                                class="form-control @error('email')is-invalid @enderror"
                                                id="email" />
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4c">Password</label>
                                            <input type="password" name="password" placeholder="Password" required
                                                class="form-control  @error('password')is-invalid @enderror"
                                                id="password" />
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Daftar</button>
                                    </div>

                                </form>
                                <small class="d-block text-center img-fluid mt-3">Sudah Mendaftar? <a
                                        href="/login">Login!</a></small>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="{{ asset('assets/img/register.svg') }}" class="img-fluid" alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<!-- jQuery  -->
<script src="{{ asset('db/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('db/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('db/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('db/assets/js/modernizr.min.js') }}"></script>
<script src="{{ asset('db/assets/js/detect.js') }}"></script>
<script src="{{ asset('db/assets/js/fastclick.js') }}"></script>
<script src="{{ asset('db/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('db/assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('db/assets/js/waves.js') }}"></script>
<script src="{{ asset('db/assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('db/assets/js/jquery.scrollTo.min.js') }}"></script>

<script src="{{ asset('db/assets/plugins/skycons/skycons.min.js') }}"></script>
<script src="{{ asset('db/assets/plugins/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('db/assets/plugins/morris/morris.min.js') }}"></script>

<script src="{{ asset('db/assets/pages/dashborad.js') }}"></script>

<!-- App js -->
<script src="{{ asset('db/assets/js/app.js') }}"></script>
<script>
    /* BEGIN SVG WEATHER ICON */
    if (typeof Skycons !== 'undefined') {
        var icons = new Skycons({
                "color": "#fff"
            }, {
                "resizeClear": true
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);
        icons.play();
    };

    // scroll

    $(document).ready(function() {

        $("#boxscroll").niceScroll({
            cursorborder: "",
            cursorcolor: "#cecece",
            boxzoom: true
        });
        $("#boxscroll2").niceScroll({
            cursorborder: "",
            cursorcolor: "#cecece",
            boxzoom: true
        });

    });
</script>
