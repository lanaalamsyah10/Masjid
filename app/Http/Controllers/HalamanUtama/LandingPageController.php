<?php

namespace App\Http\Controllers\HalamanUtama;

use App\Models\Rekap;
use App\Models\Sholat;
use App\Models\Pengurus;
use App\Models\Pengajian;
use Illuminate\Http\Request;
use App\Models\PengumumanMasjid;
use App\Models\PemasukanKasMasjid;
use App\Http\Controllers\Controller;
use App\Models\PengeluaranKasMasjid;

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
        $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
        $total_pemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
        $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        $data = [
            "rekap_kas" => Rekap::orderBy('created_at', 'desc')->get(),
            "total_keseluruhan" => $total_keseluruhan,
            "total_pemasukan" => $total_pemasukan,
            "total_pengeluaran" => $total_pengeluaran,
            // "kas_masjid" => PemasukanKasMasjid::get()
        ];

        return view('profil.laporan', $data);
    }
    public function pengurus()
    {
        $data = [
            "pengurus" => Pengurus::get()
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
    public function pengumuman(Request $request)
    {
        $search = $request->input('search');

        $data = [
            "pengumuman" => PengumumanMasjid::where('judul_pengumuman', 'LIKE', "%$search%")
                ->orWhere('isi_pengumuman', 'LIKE', "%$search%")
                ->get()
        ];
        return view('pengumuman.index', $data);
    }
}
