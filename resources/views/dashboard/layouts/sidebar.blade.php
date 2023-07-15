<div class="sidebar-inner slimscrollleft">

    <div id="sidebar-menu">
        <ul>
            <li class="menu-title">Main</li>
            <li>
                <a href="{{ url('dashboard') }}" class="waves-effect {{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="mdi mdi-airplay"></i>
                    <span> Dashboard <span class="badge badge-pill badge-primary float-right">7</span></span>
                </a>
            </li>
            <li class="has_sub">
                <a href="javascript:void(0);"
                    class="waves-effect {{ Request::routeIs(['dashboard.laporan-pemasukan*', 'dashboard.laporan-pengeluaran*']) ? 'active' : '' }}"><i
                        class="mdi mdi-book-multiple"></i>
                    <span>
                        Laporan Kas</span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="list-unstyled">
                    <li class=""><a href="{{ route('dashboard.laporan-pemasukan.index') }}">Pemasukan
                            Kas
                            Masjid</a></li>
                    <li><a href="{{ route('dashboard.laporan-pengeluaran.index') }}">Pengeluaran Kas Masjid</a></li>

                    <li><a href="{{ route('dashboard.laporan-rekap') }}"></i>Rekap Kas
                            Masjid</a></li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="javascript:void(0);"
                    class="waves-effect {{ Request::routeIs(['dashboard.jadwal-pengajian*', 'dashboard.jadwal-sholat*']) ? 'active' : '' }}"><i
                        class="mdi mdi-book-open-page-variant"></i> <span>
                        Jadwal Kegiatan</span> <span class="float-right"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ route('dashboard.jadwal-pengajian.index') }}">Jadwal Pengajian</a></li>
                    <li><a href="{{ route('dashboard.jadwal-sholat.index') }}">Jadwal Imam</a></li>
                </ul>
            </li>
            @if (Auth::user()->role == 'admin')
                <li class="has_sub">
                    <a href="javascript:void(0);"
                        class="waves-effect {{ Request::routeIs(['dashboard.biodata-pengurus.index*', 'dashboard.kelola-pengurus.index*']) ? 'active' : '' }}"><i
                            class="mdi mdi-account-multiple"></i> <span>
                            Pengurus</span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('dashboard.biodata-pengurus.index') }}">Data Pengurus</a></li>
                        <li><a href="{{ route('dashboard.kelola-pengurus.index') }}">Kelola Pengurus</a></li>
                    </ul>
                </li>
            @endif
            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-scale-balance"></i> <span>
                        Zakat</span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ route('dashboard.zakat-zakat_fitrah.index') }}">Zakat Fitrah</a></li>
                    <li><a href="{{ route('dashboard.zakat-zakat_mustahik.index') }}">Zakat Mustahik</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('dashboard.pengumuman.index') }}" class="waves-effect"><i
                        class="mdi mdi-bullhorn"></i><span>
                        Pengumuman </span></a>
            </li>
            <li>
                <a href="{{ route('dashboard.kurban.index') }}" class="waves-effect"><i
                        class="mdi mdi-cow
                    "></i><span>
                        Kurban </span></a>
            </li>
            <li>
                <a href="{{ route('dashboard.saran.index') }}" class="waves-effect"><i class="mdi mdi-email"></i><span>
                        Form Saran </span></a>
            </li>
            <li class="menu-title mt-3">Menu</li>
            <li>
                <a href="/" class="waves-effect"><i class="mdi mdi-home"></i><span>
                        Home </span></a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="waves-effect"><i class="mdi mdi-logout"></i><span>
                        Keluar </span></a>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div> <!-- end sidebarinner -->
