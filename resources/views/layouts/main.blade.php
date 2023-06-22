<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Examin - Education and LMS Template">

    <!-- ========== Page Title ========== -->
    <title>@yield('title')</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('assets/img/msjd.png') }}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    @include('layouts.partials.css.style')

    @yield('css')

</head>

<body>

    @stack('style')

    <!-- Preloader Start -->
    {{-- <div class="se-pre-con"></div> --}}
    <!-- Preloader Ends -->

    @include('layouts.header')
    @include('layouts.navbar')
    @yield('content')
    @include('layouts.footer')

    @stack('javascript')

    <!-- jQuery Frameworks
    ============================================= -->
    @include('layouts.partials.js.style')
</body>

</html>
