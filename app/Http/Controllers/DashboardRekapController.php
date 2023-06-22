<?php

namespace App\Http\Controllers;

use App\Models\Rekap;
use Illuminate\Http\Request;
use App\Models\PemasukanKasMasjid;
use Illuminate\Routing\Controller;
use App\Models\PengeluaranKasMasjid;

class DashboardRekapController extends Controller
{
    public function index()
    {
        $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
        $total_pemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
        $total_keseluruhan = $total_pemasukan - $total_pengeluaran;

        $data = [
            "rekap_kas" => Rekap::orderBy('created_at', 'asc')->get(),
            "total" => $total_keseluruhan,
            "total_pemasukan" => $total_pemasukan,
            "total_pengeluaran" => $total_pengeluaran,
        ];

        return view('dashboard.laporan.rekap.index', $data);
    }
}
