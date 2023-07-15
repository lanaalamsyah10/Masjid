<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use App\Models\Kurban;
use App\Models\Pengurus;
use App\Models\ZakatFitrah;
use Illuminate\Http\Request;
use App\Models\PengumumanMasjid;
use App\Models\PemasukanKasMasjid;
use Illuminate\Routing\Controller;
use App\Models\PengeluaranKasMasjid;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
        $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
        $total_keseluruhan = $totalPemasukan - $total_pengeluaran;
        $pengurus = Pengurus::count();
        $zakat_fitrah = ZakatFitrah::count();
        $pengumuman = PengumumanMasjid::count();
        $kurban = Kurban::get();
        $saran = Saran::count();
        $data = Kurban::all();

        $totalSapi = 0;
        $totalKambing = 0;

        foreach ($data as $row) {
            if ($row->hewan_kurban === 'Sapi') {
                $totalSapi += $row->jumlah;
            } elseif ($row->hewan_kurban === 'Kambing') {
                $totalKambing += $row->jumlah;
            }
        }
        $totalKurban = $kurban->sum('jumlah');

        return view('dashboard.index', [
            'totalSapi' => $totalSapi,
            'totalKambing' => $totalKambing,
            'totalKurban' => $totalKurban,
            'total_keseluruhan' => $total_keseluruhan,
            'totalPemasukan' => $totalPemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'pengurus' => $pengurus,
            'zakat_fitrah' => $zakat_fitrah,
            'pengumuman' => $pengumuman,
            'kurban' => $kurban,
            'saran' => $saran,
        ]);
    }
}
