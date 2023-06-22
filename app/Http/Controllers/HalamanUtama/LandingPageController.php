<?php

namespace App\Http\Controllers\HalamanUtama;

use App\Models\User;
use App\Models\Sholat;
use App\Models\Pengurus;
use App\Models\Pengajian;
use Illuminate\Http\Request;
use App\Models\PengumumanMasjid;
use App\Models\PemasukanKasMasjid;
use App\Http\Controllers\Controller;
use App\Models\PemasukanKasMasjidKasMasjid;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $data = [
            "pengumuman_masjid" => PengumumanMasjid::get()
        ];

        return view('.index', $data);
    }

    public function laporan()
    {
        $data = [
            "kas_masjid" => PemasukanKasMasjid::get()
        ];

        return view('profil.laporan', $data);
    }
    public function pengurus()
    {
        $data = [
            "pengurus" => Pengurus::get()
        ];
        $data = [
            "users" => User::get()
        ];

        return view('profil.pengurus', $data);
    }

    public function pengajian()
    {
        $data = [
            "pengajian" => Pengajian::get()
        ];

        return view('jadwal.pengajian', $data);
    }
    public function sholat()
    {
        $data = [
            "sholat" => Sholat::get()
        ];

        return view('jadwal.sholat', $data);
    }
    public function pengumuman()
    {
        $data = [
            "pengumuman" => PengumumanMasjid::get()
        ];

        return view('pengumuman.index', $data);
    }
    public function kontak()
    {
        return view('kontak.index');
    }
    public function index()
    {
        return view('profil.index1');
    }
}
