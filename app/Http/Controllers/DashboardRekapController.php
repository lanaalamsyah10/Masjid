<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
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
            "rekap_kas" => Rekap::orderBy('created_at', 'desc')->get(),
            "total_keseluruhan" => $total_keseluruhan,
            "total_pemasukan" => $total_pemasukan,
            "total_pengeluaran" => $total_pengeluaran,
        ];

        return view('dashboard.laporan.rekap.index', $data);
    }

    public function generatePDF()
    {
        // Mengambil data pemasukan dan pengeluaran
        $total_pemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
        $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
        $pemasukan = PemasukanKasMasjid::all();
        $pengeluaran = PengeluaranKasMasjid::all();
        $rekap_kas = Rekap::orderBy('created_at', 'desc')->get();
        $total_keseluruhan = $total_pemasukan - $total_pengeluaran;

        $dompdf = new Dompdf();
        // Membuat tampilan PDF
        $html = view('dashboard.laporan.rekap.cetak', compact('total_pemasukan', 'rekap_kas', 'total_pengeluaran', 'pemasukan', 'pengeluaran', 'total_keseluruhan'))->render();
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // Mengirimkan output PDF ke browser
        return $dompdf->stream('laporan_rekap.pdf');
    }

    public function filter_rekap($tglawal, $tglakhir)
    {
        // Total pengeluaran sebelum tanggal awal
        $totalPengeluaranSebelum = PengeluaranKasMasjid::where('tanggal_pengeluaran', '<', $tglawal)
            ->sum('jumlah_pengeluaran');
        $totalPemasukanSebelum = PemasukanKasMasjid::where('tanggal_pemasukan', '<', $tglawal)
            ->sum('jumlah_pemasukan');
        $pengeluaran = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->get();
        $pemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->get();
        $rekap_kas = Rekap::orderBy('created_at', 'desc')->get();
        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Load view PDF dan berikan data yang diperlukan
        $html = view('dashboard.laporan.rekap.cetak_perbulan', [
            "pengeluaran" => $pengeluaran,
            "pemasukan" => $pemasukan,
            "tglwal" => $tglawal,
            "tglakhir" => $tglakhir,
            "total" => $totalPengeluaranSebelum,
            "total" => $totalPemasukanSebelum,
            "rekap_kas" => $rekap_kas,
        ]);

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'rekap_laporan_' . \Carbon\Carbon::parse($tglawal)->format('d-m-Y') . '_' . \Carbon\Carbon::parse($tglakhir)->format('d-m-Y') . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }

    public function rekap(Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $rekap_kas = Rekap::orderBy('created_at', 'desc')->get();
        $pemasukanKas = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->get();
        $pengeluaranKas = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->get();

        $totalPemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->sum('jumlah_pemasukan');
        $totalPengeluaran = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->sum('jumlah_pengeluaran');

        return redirect("/laporan-rekap")->withInput()->with([
            "tglawal" => $tglawal,
            "tglakhir" => $tglakhir,
            "pengeluaranKas" => $pengeluaranKas,
            "pemasukanKas" => $pemasukanKas,
            "rekap_kas" => $rekap_kas,
        ]);
    }
}
