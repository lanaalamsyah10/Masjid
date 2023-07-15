<!-- Header
    ============================================= -->
<header id="home">
    <!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-sticky bootsnav">

        <!-- Start Top Search -->
        <div class="container">
            <div class="row">
                <div class="top-search">
                    <div class="input-group">
                        <form action="{{ route('pengumuman.search') }}" method="GET">
                            <input type="text" name="search" class="form-control" placeholder="Search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Search -->

        <div class="container">

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/sss.png') }}" class="logo" alt="Logo" style="width: 200px">
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="#" data-out="#">
                    <li class="dropdown">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profil.pengurus') }}">Struktur Organisasi</a></li>
                            <li><a href="{{ route('profil.laporan') }}">Laporan Kas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jadwal</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('jadwal.sholat') }}">Jadwal Imam</a></li>
                            <li><a href="{{ route('jadwal.pengajian') }}">Jadwal Pengajian</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('pengumuman.index') }}">Pengumuman</a>
                    </li>
                    <li>
                        <a href="{{ route('kontak.index') }}">Kontak</a>
                    </li>
                    @auth
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li><a href="{{ route('logout') }}">Keluar <i class="fas fa-sign-out-alt"></i></a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>

    </nav>
    <!-- End Navigation -->

</header>
<!-- End Header -->
