<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Rekap;
use Illuminate\Http\Request;
use App\Models\PemasukanKasMasjid;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\PengeluaranKasMasjid;

class DashboardRekapController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $months = PemasukanKasMasjid::selectRaw('MONTH(tanggal_pemasukan) as month')
            ->union(PengeluaranKasMasjid::selectRaw('MONTH(tanggal_pengeluaran) as month'))
            ->distinct()
            ->orderBy('month', 'desc')
            ->pluck('month');
        $years = PemasukanKasMasjid::selectRaw('YEAR(tanggal_pemasukan) as year')
            ->union(PengeluaranKasMasjid::selectRaw('YEAR(tanggal_pengeluaran) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($bulan && $tahun) {
            $rekap_kas = PemasukanKasMasjid::select('tanggal_pemasukan as tanggal', 'keterangan_pemasukan as keterangan', 'jumlah_pemasukan as jumlah', DB::raw("'pemasukan' as tipe"))
                ->whereMonth('tanggal_pemasukan', $bulan)
                ->whereYear('tanggal_pemasukan', $tahun)
                ->union(
                    PengeluaranKasMasjid::select('tanggal_pengeluaran as tanggal', 'keterangan_pengeluaran as keterangan', DB::raw("(jumlah_pengeluaran) as jumlah"), DB::raw("'pengeluaran' as tipe"))
                        ->whereMonth('tanggal_pengeluaran', $bulan)
                        ->whereYear('tanggal_pengeluaran', $tahun)
                )
                ->orderBy('tanggal', 'desc')
                ->get();

            $showDownloadButton = $rekap_kas->isNotEmpty();
            $total_pemasukan = $rekap_kas->where('tipe', 'pemasukan')->sum('jumlah');
            $total_pengeluaran = $rekap_kas->where('tipe', 'pengeluaran')->sum('jumlah');
            $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        } elseif ($bulan) {
            $rekap_kas = PemasukanKasMasjid::select('tanggal_pemasukan as tanggal', 'keterangan_pemasukan as keterangan', 'jumlah_pemasukan as jumlah', DB::raw("'pemasukan' as tipe"))
                ->whereMonth('tanggal_pemasukan', $bulan)
                ->union(
                    PengeluaranKasMasjid::select('tanggal_pengeluaran as tanggal', 'keterangan_pengeluaran as keterangan', DB::raw("(jumlah_pengeluaran) as jumlah"), DB::raw("'pengeluaran' as tipe"))
                        ->whereMonth('tanggal_pengeluaran', $bulan)
                )
                ->orderBy('tanggal', 'desc')
                ->get();

            $total_pemasukan = $rekap_kas->where('tipe', 'pemasukan')->sum('jumlah');
            $total_pengeluaran = $rekap_kas->where('tipe', 'pengeluaran')->sum('jumlah');
            $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        } elseif ($tahun) {
            $rekap_kas = PemasukanKasMasjid::select('tanggal_pemasukan as tanggal', 'keterangan_pemasukan as keterangan', 'jumlah_pemasukan as jumlah', DB::raw("'pemasukan' as tipe"))
                ->whereYear('tanggal_pemasukan', $tahun)
                ->union(
                    PengeluaranKasMasjid::select('tanggal_pengeluaran as tanggal', 'keterangan_pengeluaran as keterangan', DB::raw("(jumlah_pengeluaran) as jumlah"), DB::raw("'pengeluaran' as tipe"))
                        ->whereYear('tanggal_pengeluaran', $tahun)
                )
                ->orderBy('tanggal', 'desc')
                ->get();

            $total_pemasukan = $rekap_kas->where('tipe', 'pemasukan')->sum('jumlah');
            $total_pengeluaran = $rekap_kas->where('tipe', 'pengeluaran')->sum('jumlah');
            $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        } else {
            $rekap_kas = Rekap::orderByDesc('created_at')->get();
            $total_pemasukan = 0;
            $total_pengeluaran = 0;
            $total_keseluruhan = 0;
            $showDownloadButton = false;
        };
        return view('dashboard.laporan.rekap.index', [
            'rekap_kas' => $rekap_kas,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'total_keseluruhan' => $total_keseluruhan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'months' => $months,
            'years' => $years,
            'showDownloadButton' => $showDownloadButton,
        ]);
    }


    // public function index()
    // {
    //     $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
    //     $total_pemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
    //     $total_keseluruhan = $total_pemasukan - $total_pengeluaran;

    //     $pemasukanKas = PemasukanKasMasjid::orderBy('tanggal_pemasukan', 'desc')->get();
    //     $pengeluaranKas = PengeluaranKasMasjid::orderBy('tanggal_pengeluaran', 'desc')->get();

    //     $rekap_kas = Rekap::orderBy('created_at', 'desc')->get();
    //     return view('dashboard.laporan.rekap.index', [
    //         "total_keseluruhan" => $total_keseluruhan,
    //         "total_pemasukan" => $total_pemasukan,
    //         "total_pengeluaran" => $total_pengeluaran,
    //         'pemasukanKas' => $pemasukanKas,
    //         'pengeluaranKas' => $pengeluaranKas,
    //         'rekap_kas' => $rekap_kas,
    //     ]);
    // }
    // public function index(Request $request)
    // {
    //     $bulan = $request->input('bulan');
    //     $months = Rekap::selectRaw('MONTH("tanggal_pemasukan") as month')
    //         ->union(Rekap::selectRaw('MONTH("tanggal_pengeluaran") as month'))
    //     $months = Rekap::selectRaw('MONTH("tanggal_pemasukan") as month')
    //         ->union(Rekap::selectRaw('MONTH("tanggal_pengeluaran") as month'))
    //         ->distinct()
    //         ->orderBy('month', 'desc')
    //         ->pluck('month');

    //     $months = PemasukanKasMasjid::selectRaw('MONTH(tanggal_pemasukan) as month')->distinct()->orderBy('month', 'desc')->pluck('month');
    //     $pemasukanKas = PemasukanKasMasjid::->orderBy('tanggal_pemasukan', 'desc')->get();


    //     if ($bulan) {
    //         $pemasukanKas = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', $bulan)->orderBy('tanggal_pemasukan', 'desc')->get();

    //         $rekap_kas = Rekap::whereMonth('tanggal_pemasukan', $bulan)
    //             ->orWhereMonth('tanggal_pengeluaran', $bulan)
    //             ->orderBy('tanggal_pemasukan', 'desc')
    //             ->orderBy('tanggal_pengeluaran', 'desc')
    //             ->get();

    //         $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
    //         $total_pemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
    //         $total_keseluruhan = $total_pemasukan - $total_pengeluaran;

    //     } else {
    //         $rekap_kas = collect();
    //         $total_pemasukan = 0;
    //         $total_pengeluaran = 0;
    //         $total_keseluruhan = 0;
    //     }

    //     return view('dashboard.laporan.rekap.index', [
    //         'rekap_kas' => $rekap_kas,
    //         "total_keseluruhan" => $total_keseluruhan,
    //         "total_pemasukan" => $total_pemasukan,
    //         "total_pengeluaran" => $total_pengeluaran,
    //         'pemasukanKas' => $pemasukanKas,
    //         "bulan" => $bulan,
    //         "months" => $months,
    //     ]);
    // }
    public function test(Request $request)
    {
        // $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
        // $total_pemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
        // $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        // $rekap_kas = Rekap::orderBy('created_at', 'desc')->get();


        // return view('dashboard.laporan.rekap.index', [
        //     'rekap_kas' => $rekap_kas,
        //     "total_keseluruhan" => $total_keseluruhan,
        //     "total_pemasukan" => $total_pemasukan,
        //     "total_pengeluaran" => $total_pengeluaran,
        // ]);
        // $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        // $selectedYear = $tahun;
        // $selectedMonth = $bulan;
        if ($bulan) {
            // $rekap_kas = Rekap::whereYear('tanggal_pemasukan', $tahun)
            //     ->orWhereYear('tanggal_pengeluaran', $tahun)
            //     ->orderBy('tanggal_pemasukan', 'desc')
            //     ->orderBy('tanggal_pengeluaran', 'desc')
            //     ->get();

            $rekap_kas = Rekap::whereMonth('tanggal_pemasukan', $bulan)
                ->orWhereMonth('tanggal_pengeluaran', $bulan)
                ->orderBy('tanggal_pemasukan', 'desc')
                ->orderBy('tanggal_pengeluaran', 'desc')
                ->get();

            $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
            $total_pemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
            $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        } else {
            $rekap_kas = collect();
            $total_pemasukan = 0;
            $total_pengeluaran = 0;
            $total_keseluruhan = 0;
        }

        // $years = Rekap::selectRaw('YEAR("tanggal_pemasukan") as year')
        //     ->union(Rekap::selectRaw('YEAR("tanggal_pengeluaran") as year'))
        //     ->distinct()
        //     ->orderBy('year', 'desc')
        //     ->pluck('year');
        $months = Rekap::selectRaw('MONTH("tanggal_pemasukan") as month')
            ->union(Rekap::selectRaw('MONTH("tanggal_pengeluaran") as month'))
            ->distinct()
            ->orderBy('month', 'desc')
            ->pluck('month');
        return view('dashboard.laporan.rekap.index', [
            'rekap_kas' => $rekap_kas,
            "total_keseluruhan" => $total_keseluruhan,
            "total_pemasukan" => $total_pemasukan,
            "total_pengeluaran" => $total_pengeluaran,
            // "years" => $years,
            "months" => $months,
            // "selectedYear" => $selectedYear, // Pass the selected year to the view
            // "selectedMonth" => $selectedMonth,
        ]);
        // $bulan = $request->input('bulan');
        // $tahun = $request->input('tahun');

        // $total_pengeluaran = PengeluaranKasMasjid::whereMonth('tanggal_pengeluaran', $bulan)
        //     ->whereYear('tanggal_pengeluaran', $tahun)
        //     ->sum('jumlah_pengeluaran');
        // $total_pemasukan = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', $bulan)
        //     ->whereYear('tanggal_pemasukan', $tahun)
        //     ->sum('jumlah_pemasukan');
        // $total_keseluruhan = $total_pemasukan - $total_pengeluaran;

        // return view('dashboard.laporan.rekap.index', [
        //     "rekap_kas" => Rekap::orderBy('created_at', 'desc')->get(),
        //     "total_keseluruhan" => $total_keseluruhan,
        //     "total_pemasukan" => $total_pemasukan,
        //     "total_pengeluaran" => $total_pengeluaran,
        //     "bulan" => $bulan,
        //     "tahun" => $tahun,
        // ]);
    }

    public function generatePDF(Request $request, $bulan, $tahun)
    {
        // Mengambil data pemasukan dan pengeluaran
        // $total_pemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
        // $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
        // $pemasukan = PemasukanKasMasjid::all();
        // $pengeluaran = PengeluaranKasMasjid::all();
        // $rekap_kas = Rekap::orderBy('created_at', 'desc')->get();
        // $total_keseluruhan = $total_pemasukan - $total_pengeluaran;

        // $dompdf = new Dompdf();
        // // Membuat tampilan PDF
        // $html = view('dashboard.laporan.rekap.cetak', compact('total_pemasukan', 'rekap_kas', 'total_pengeluaran', 'pemasukan', 'pengeluaran', 'total_keseluruhan'))->render();
        // $dompdf->loadHtml($html);

        // // Render PDF
        // $dompdf->render();

        // // Mengirimkan output PDF ke browser
        // return $dompdf->stream('laporan_rekap.pdf');
        $total_pengeluaran = PengeluaranKasMasjid::whereMonth('tanggal_pengeluaran', $bulan)
            ->whereYear('tanggal_pengeluaran', $tahun)
            ->sum('jumlah_pengeluaran');
        $total_pemasukan = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', $bulan)
            ->whereYear('tanggal_pemasukan', $tahun)
            ->sum('jumlah_pemasukan');
        $total_keseluruhan = $total_pemasukan - $total_pengeluaran;

        $rekap_kas = Rekap::orderBy('created_at', 'desc')->get();
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
            "totalPemasukan" => $totalPemasukan,
            "totalPengeluaran" => $totalPengeluaran,
        ]);
    }
    public function filter(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $months = PemasukanKasMasjid::selectRaw('MONTH(tanggal_pemasukan) as month')
            ->union(PengeluaranKasMasjid::selectRaw('MONTH(tanggal_pengeluaran) as month'))
            ->distinct()
            ->orderBy('month', 'desc')
            ->pluck('month');


        $years = PemasukanKasMasjid::selectRaw('YEAR(tanggal_pemasukan) as year')
            ->union(PengeluaranKasMasjid::selectRaw('YEAR(tanggal_pengeluaran) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        if ($bulan && $tahun) {
            $rekap_kas = PemasukanKasMasjid::select('tanggal_pemasukan as tanggal', 'keterangan_pemasukan as keterangan', 'jumlah_pemasukan as jumlah', DB::raw("'pemasukan' as tipe"))
                ->whereMonth('tanggal_pemasukan', $bulan)
                ->whereYear('tanggal_pemasukan', $tahun)
                ->union(
                    PengeluaranKasMasjid::select('tanggal_pengeluaran as tanggal', 'keterangan_pengeluaran as keterangan', DB::raw("(jumlah_pengeluaran) as jumlah"), DB::raw("'pengeluaran' as tipe"))
                        ->whereMonth('tanggal_pengeluaran', $bulan)
                        ->whereYear('tanggal_pengeluaran', $tahun)
                )
                ->orderBy('tanggal', 'desc')
                ->get();

            $showDownloadButton = $rekap_kas->isNotEmpty();
            $total_pemasukan = $rekap_kas->where('tipe', 'pemasukan')->sum('jumlah');
            $total_pengeluaran = $rekap_kas->where('tipe', 'pengeluaran')->sum('jumlah');
            $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        } elseif ($bulan) {
            $rekap_kas = PemasukanKasMasjid::select('tanggal_pemasukan as tanggal', 'keterangan_pemasukan as keterangan', 'jumlah_pemasukan as jumlah', DB::raw("'pemasukan' as tipe"))
                ->whereMonth('tanggal_pemasukan', $bulan)
                ->union(
                    PengeluaranKasMasjid::select('tanggal_pengeluaran as tanggal', 'keterangan_pengeluaran as keterangan', DB::raw("(jumlah_pengeluaran) as jumlah"), DB::raw("'pengeluaran' as tipe"))
                        ->whereMonth('tanggal_pengeluaran', $bulan)
                )
                ->orderBy('tanggal', 'desc')
                ->get();

            $total_pemasukan = $rekap_kas->where('tipe', 'pemasukan')->sum('jumlah');
            $total_pengeluaran = $rekap_kas->where('tipe', 'pengeluaran')->sum('jumlah');
            $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        } elseif ($tahun) {
            $rekap_kas = PemasukanKasMasjid::select('tanggal_pemasukan as tanggal', 'keterangan_pemasukan as keterangan', 'jumlah_pemasukan as jumlah', DB::raw("'pemasukan' as tipe"))
                ->whereYear('tanggal_pemasukan', $tahun)
                ->union(
                    PengeluaranKasMasjid::select('tanggal_pengeluaran as tanggal', 'keterangan_pengeluaran as keterangan', DB::raw("(jumlah_pengeluaran) as jumlah"), DB::raw("'pengeluaran' as tipe"))
                        ->whereYear('tanggal_pengeluaran', $tahun)
                )
                ->orderBy('tanggal', 'desc')
                ->get();

            $total_pemasukan = $rekap_kas->where('tipe', 'pemasukan')->sum('jumlah');
            $total_pengeluaran = $rekap_kas->where('tipe', 'pengeluaran')->sum('jumlah');
            $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        } else {
            $rekap_kas = Rekap::orderByDesc('created_at')->get();
            $total_pemasukan = 0;
            $total_pengeluaran = 0;
            $total_keseluruhan = 0;
            $showDownloadButton = false;
        };

        $data = [
            'rekap_kas' => $rekap_kas,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'total_keseluruhan' => $total_keseluruhan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'months' => $months,
            'years' => $years,
            'showDownloadButton' => $showDownloadButton,
        ];

        return view('dashboard.laporan.rekap.index', $data);
    }

    // public function filter(Request $request)
    // {
    //     $bulan = $request->input('bulan');
    //     $tahun = $request->input('tahun');
    //     $months = PemasukanKasMasjid::selectRaw('MONTH(tanggal_pemasukan) as month')
    //         ->union(PengeluaranKasMasjid::selectRaw('MONTH(tanggal_pengeluaran) as month'))
    //         ->distinct()
    //         ->orderBy('month', 'desc')
    //         ->pluck('month');
    //     $years = PemasukanKasMasjid::selectRaw('YEAR(tanggal_pemasukan) as year')
    //         ->union(PengeluaranKasMasjid::selectRaw('YEAR(tanggal_pengeluaran) as year'))
    //         ->distinct()
    //         ->orderBy('year', 'desc')
    //         ->pluck('year');

    //     if ($bulan) {
    //         $rekap_kas = PemasukanKasMasjid::select('tanggal_pemasukan as tanggal', 'keterangan_pemasukan as keterangan', 'jumlah_pemasukan as jumlah', DB::raw("'pemasukan' as tipe"))
    //             ->whereMonth('tanggal_pemasukan', $bulan)
    //             ->union(
    //                 PengeluaranKasMasjid::select('tanggal_pengeluaran as tanggal', 'keterangan_pengeluaran as keterangan', DB::raw("(jumlah_pengeluaran) as jumlah"), DB::raw("'pengeluaran' as tipe"))
    //                     ->whereMonth('tanggal_pengeluaran', $bulan)
    //             )
    //             ->orderBy('tanggal', 'desc')
    //             ->get();
    //         $total_pemasukan = $rekap_kas->where('tipe', 'pemasukan')->sum('jumlah');
    //         $total_pengeluaran = $rekap_kas->where('tipe', 'pengeluaran')->sum('jumlah');
    //         $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
    //         $total_pengeluaran;
    //     } else {
    //         $rekap_kas = Rekap::orderByDesc('created_at')->get();
    //         $total_pemasukan = 0;
    //         $total_pengeluaran = 0;
    //         $total_keseluruhan = 0;
    //     }

    //     return view('dashboard.laporan.rekap.index', [
    //         'rekap_kas' => $rekap_kas,
    //         'total_pemasukan' => $total_pemasukan,
    //         'total_pengeluaran' => $total_pengeluaran,
    //         'total_keseluruhan' => $total_keseluruhan,
    //         'bulan' => $bulan,
    //         'months' => $months,
    //         "years" => $years,
    //     ]);
    // }
    public function cetak_pdf(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $months = PemasukanKasMasjid::selectRaw('MONTH(tanggal_pemasukan) as month')
            ->union(PengeluaranKasMasjid::selectRaw('MONTH(tanggal_pengeluaran) as month'))
            ->distinct()
            ->orderBy('month', 'desc')
            ->pluck('month');

        $years = PemasukanKasMasjid::selectRaw('YEAR(tanggal_pemasukan) as year')
            ->union(PengeluaranKasMasjid::selectRaw('YEAR(tanggal_pengeluaran) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        if ($bulan && $tahun) {
            $rekap_kas = PemasukanKasMasjid::select('tanggal_pemasukan as tanggal', 'keterangan_pemasukan as keterangan', 'jumlah_pemasukan as jumlah', DB::raw("'pemasukan' as tipe"))
                ->whereMonth('tanggal_pemasukan', $bulan)
                ->whereYear('tanggal_pemasukan', $tahun)
                ->union(
                    PengeluaranKasMasjid::select('tanggal_pengeluaran as tanggal', 'keterangan_pengeluaran as keterangan', DB::raw("(jumlah_pengeluaran) as jumlah"), DB::raw("'pengeluaran' as tipe"))
                        ->whereMonth('tanggal_pengeluaran', $bulan)
                        ->whereYear('tanggal_pengeluaran', $tahun)
                )
                ->orderBy('tanggal', 'desc')
                ->get();

            $total_pemasukan = $rekap_kas->where('tipe', 'pemasukan')->sum('jumlah');
            $total_pengeluaran = $rekap_kas->where('tipe', 'pengeluaran')->sum('jumlah');
            $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        } elseif ($bulan) {
            $rekap_kas = PemasukanKasMasjid::select('tanggal_pemasukan as tanggal', 'keterangan_pemasukan as keterangan', 'jumlah_pemasukan as jumlah', DB::raw("'pemasukan' as tipe"))
                ->whereMonth('tanggal_pemasukan', $bulan)
                ->union(
                    PengeluaranKasMasjid::select('tanggal_pengeluaran as tanggal', 'keterangan_pengeluaran as keterangan', DB::raw("(jumlah_pengeluaran) as jumlah"), DB::raw("'pengeluaran' as tipe"))
                        ->whereMonth('tanggal_pengeluaran', $bulan)
                )
                ->orderBy('tanggal', 'desc')
                ->get();

            $total_pemasukan = $rekap_kas->where('tipe', 'pemasukan')->sum('jumlah');
            $total_pengeluaran = $rekap_kas->where('tipe', 'pengeluaran')->sum('jumlah');
            $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        } elseif ($tahun) {
            $rekap_kas = PemasukanKasMasjid::select('tanggal_pemasukan as tanggal', 'keterangan_pemasukan as keterangan', 'jumlah_pemasukan as jumlah', DB::raw("'pemasukan' as tipe"))
                ->whereYear('tanggal_pemasukan', $tahun)
                ->union(
                    PengeluaranKasMasjid::select('tanggal_pengeluaran as tanggal', 'keterangan_pengeluaran as keterangan', DB::raw("(jumlah_pengeluaran) as jumlah"), DB::raw("'pengeluaran' as tipe"))
                        ->whereYear('tanggal_pengeluaran', $tahun)
                )
                ->orderBy('tanggal', 'desc')
                ->get();

            $total_pemasukan = $rekap_kas->where('tipe', 'pemasukan')->sum('jumlah');
            $total_pengeluaran = $rekap_kas->where('tipe', 'pengeluaran')->sum('jumlah');
            $total_keseluruhan = $total_pemasukan - $total_pengeluaran;
        } else {
            $rekap_kas = Rekap::orderByDesc('created_at')->get();
            $total_pemasukan = 0;
            $total_pengeluaran = 0;
            $total_keseluruhan = 0;
        };

        $dompdf = new Dompdf();
        $dompdf = App::make('dompdf.wrapper');
        // Load view PDF dan berikan data yang diperlukan
        $html =  view('dashboard.laporan.rekap.cetak_perbulan', [
            'rekap_kas' => $rekap_kas,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'total_keseluruhan' => $total_keseluruhan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'months' => $months,
            "years" => $years,
        ]);

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'laporan-rekap-kas-bulan' . $bulan . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }
}
