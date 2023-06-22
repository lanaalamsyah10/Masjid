<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return view('dashboard.index', [
            'total_keseluruhan' => $total_keseluruhan,
            'totalPemasukan' => $totalPemasukan,
            'total_pengeluaran' => $total_pengeluaran,
        ]);
    }
}
