<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Dashboard Admin Al-Islakh</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @include('dashboard.layouts.head')

</head>


<body class="fixed-left">

    @stack('style')

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    {{-- <a href="index.html" class="logo"><i class="mdi mdi-assistant"></i> Annex</a> --}}
                    <a href="{{ url('dashboard') }}" class="logo"><img src="{{ asset('assets/img/sss.png') }}"
                            height="20" alt="logo"></a>
                </div>
            </div>

            @include('dashboard.layouts.sidebar')
        </div>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                @include('dashboard.layouts.header')

                <div class="page-content-wrapper ">

                    <div class="container-fluid">
                        @yield('content')
                    </div><!-- container -->


                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <footer class="footer">
                © 2023 Masjid Al-Islakh
            </footer>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->

    @include('dashboard.layouts.body')

    @stack('javascript')

</body>

</html>
