<link rel="shortcut icon" href="{{ asset('db/assets/images/msjd.png') }}">

<link href="{{ asset('db/assets/plugins/morris/morris.css') }}" rel="stylesheet">

<link href="{{ asset('db/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('db/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('db/assets/css/style.css') }}" rel="stylesheet" type="text/css">


<!-- Begin page -->
{{-- <section class=" bg-login">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container py-3 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">LOGIN</h2>
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif


                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('loginError') }}
                                </div>
                            @endif
                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Email</label>
                                    <input type="email" name="email" placeholder="nama@gmail.com" autofocus required
                                        value="{{ old('email') }}"
                                        class="form-control  @error('email')is-invalid @enderror" id="email" />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" name="password" placeholder="Password" id="password"
                                        class="form-control " required />
                                </div>

                                <div class="d-flex justify-content-center mb-4">
                                    <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Login</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Login</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />


</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">

        <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
                <h2 class="text-uppercase text-center mb-5">LOGIN</h2>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif


                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                    </div>
                @endif
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example3cg">Email</label>
                        <input type="email" name="email" placeholder="nama@gmail.com" autofocus required
                            value="{{ old('email') }}" class="form-control  @error('email')is-invalid @enderror"
                            id="email" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" placeholder="Password" id="password"
                            class="form-control " required />
                    </div>

                    <div class="d-flex justify-content-center mb-4">
                        <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>
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
