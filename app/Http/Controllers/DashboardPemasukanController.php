<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Rekap;
use Illuminate\Http\Request;
use App\Models\PemasukanKasMasjid;
use Illuminate\Support\Facades\App;
use App\Models\PengeluaranKasMasjid;
use Illuminate\Support\Facades\Auth;

class DashboardPemasukanController extends Controller
{
    /**
     * Display a listing of xthe resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $months = PemasukanKasMasjid::selectRaw('MONTH(tanggal_pemasukan) as month')->distinct()->orderBy('month', 'desc')->pluck('month');

        if ($bulan) {
            $pemasukanKas = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', $bulan)->orderBy('tanggal_pemasukan', 'desc')->get();

            $totalPemasukan = $pemasukanKas->sum('jumlah_pemasukan');
            $user = Auth::user();
        } else {
            // Menampilkan data bulan terakhir secara default
            // $lastMonth = $months->first();
            // $pemasukanKas = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', $lastMonth)->orderBy('tanggal_pemasukan', 'desc')->get();
            $pemasukanKas =  collect();;
            $totalPemasukan = 0;
            $user = Auth::user();
        }

        return view('dashboard.laporan.pemasukan.index', [
            'pemasukanKas' => $pemasukanKas,
            'totalPemasukan' => $totalPemasukan,
            'user' => $user,
            'bulan' => $bulan,
            'months' => $months,
        ]);
    }


    // $monthNames = [];
    // foreach ($months as $month) {
    //     $monthName = Carbon::create()->month($month)->format('F');
    //     // Terjemahkan nama bulan ke bahasa Indonesia
    //     if (App::getLocale() === 'id') {
    //         $monthName = trans('bulan.' . strtolower($monthName));
    //     }
    //     $monthNames[$month] = $monthName;
    // }

    // $totalPemasukan = 0;

    // if ($request->has('tglawal') && $request->has('tglakhir')) {
    //     $totalPemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
    // }

    // $pemasukanKas = PemasukanKasMasjid::orderBy('created_at', 'desc')->get();
    // $user = Auth::user();

    // return view('dashboard.laporan.pemasukan.index', [
    //     'pemasukanKas' => $pemasukanKas,
    //     'totalPemasukan' => $totalPemasukan,
    //     'user' => $user,
    // ]);

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.laporan.pemasukan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validate(
            $request,
            [
                'tanggal_pemasukan' => 'required',
                'keterangan_pemasukan' => 'required',
                'jumlah_pemasukan' => 'required',
            ],
            [
                'tanggal_pemasukan.required' => 'Tanggal tidak boleh kosong',
                'keterangan_pemasukan.required' => 'Keterangan tidak boleh kosong',
                'jumlah_pemasukan.required' => 'Jumlah tidak boleh kosong',
            ]
        );

        $pemasukan = PemasukanKasMasjid::create([
            'user_id' => $user->id,
            'tanggal_pemasukan' => $request->tanggal_pemasukan,
            'keterangan_pemasukan' => $request->keterangan_pemasukan,
            'jumlah_pemasukan' => $request->jumlah_pemasukan,
        ]);
        Rekap::create([
            'id_pemasukan' => $pemasukan->id,
        ]);
        return redirect()->route('dashboard.laporan-pemasukan.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PemasukanKasMasjid  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show(PemasukanKasMasjid $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PemasukanKasMasjid  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pemasukan = PemasukanKasMasjid::find($id);

        return view('dashboard.laporan.pemasukan.edit', compact('pemasukan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'tanggal_pemasukan' => 'required',
                'keterangan_pemasukan' => 'required',
                'jumlah_pemasukan' => 'required',
            ],
            [
                'tanggal_pemasukan.required' => 'Tanggal tidak boleh kosong',
                'keterangan_pemasukan.required' => 'Keterangan tidak boleh kosong',
                'jumlah_pemasukan.required' => 'Jumlah tidak boleh kosong',
            ]
        );

        $pemasukan = PemasukanKasMasjid::findOrFail($id);

        $pemasukan->update([
            'tanggal_pemasukan' => $request->tanggal_pemasukan,
            'keterangan_pemasukan' => $request->keterangan_pemasukan,
            'jumlah_pemasukan' => $request->jumlah_pemasukan,
        ]);

        return redirect()->route('dashboard.laporan-pemasukan.index')->with('edit', 'Data Berhasil Diubah');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PemasukanKasMasjid  $pemasukan
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $pemasukan = PemasukanKasMasjid::findOrFail($id);
        $pemasukan->delete();

        $rekap = Rekap::where('id', $id)->first();

        if ($rekap) {
            $rekap->delete();
        }

        return back();
    }


    // public function cetak_pdf()
    // {
    //     $totalPemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
    //     $pemasukan = PemasukanKasMasjid::all();

    //     $dompdf = new Dompdf();

    //     // Load view PDF dan berikan data yang diperlukan
    //     $html = view('dashboard.laporan.pemasukan.cetak', [
    //         'pemasukan' => $pemasukan,
    //         'totalPemasukan' => $totalPemasukan,
    //     ]);

    //     // Konversi view HTML menjadi PDF
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     // Generate nama file PDF
    //     $filename = 'laporan-pemasukan-kas' . 'pdf';

    //     // Mengirimkan hasil PDF sebagai respons file download
    //     return $dompdf->stream($filename);
    // }

    // code asli
    // public function cetak_pdf(Request $request)
    // {
    //     $bulan = $request->input('bulan');
    //     $months = PemasukanKasMasjid::selectRaw('MONTH(tanggal_pemasukan) as month')->distinct()->orderBy('month', 'desc')->pluck('month');
    //     if ($bulan) {
    //         $pemasukanKas = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', $bulan)->orderBy('tanggal_pemasukan', 'desc')->get();


    //         $totalPemasukan = $pemasukanKas->sum('jumlah_pemasukan');
    //         $user = Auth::user();

    //         $dompdf = new Dompdf();
    //         $dompdf = App::make('dompdf.wrapper');
    //         // Load view PDF dan berikan data yang diperlukan
    //         $html = view('dashboard.laporan.pemasukan.cetak', [
    //             'pemasukanKas' => $pemasukanKas,
    //             'totalPemasukan' => $totalPemasukan,
    //             'user' => $user,
    //             'bulan' => $bulan,
    //             'months' => $months,
    //         ]);

    //         // Konversi view HTML menjadi PDF
    //         $dompdf->loadHtml($html);
    //         $dompdf->setPaper('A4', 'portrait');
    //         $dompdf->render();

    //         // Generate nama file PDF
    //         $filename = 'laporan-pemasukan-kas-' . $bulan . '.pdf';

    //         // Mengirimkan hasil PDF sebagai respons file download
    //         return $dompdf->stream($filename);
    //     }
    // }

    // code cobaan
    public function cetak_pdf(Request $request)
    {
        $bulan = $request->input('bulan');
        $months = PemasukanKasMasjid::selectRaw('MONTH(tanggal_pemasukan) as month')
            ->distinct()
            ->orderBy('month', 'desc')
            ->pluck('month');

        $totalPemasukanSebelum = 0; // Inisialisasi total pemasukan sebelumnya
        $totalPengeluaranSebelum = 0; // Inisialisasi total pengeluaran sebelumnya

        if ($bulan) {
            $pemasukanKas = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', $bulan)
                ->orderBy('tanggal_pemasukan', 'desc')
                ->get();
            // $pemasukanKasSebelum = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', '<', $bulan)
            //     ->orderBy('tanggal_pemasukan', 'desc')
            //     ->get();
            // // Menghitung total pemasukan sebelumnya hanya jika bulan tersedia
            // $totalPemasukanSebelum = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', '<', $bulan)
            //     ->sum('jumlah_pemasukan');

            // // Menghitung total pengeluaran bulan sebelumnya
            // $totalPengeluaranSebelum = PengeluaranKasMasjid::whereMonth('tanggal_pengeluaran', '<', $bulan)
            //     ->sum('jumlah_pengeluaran');

            $pemasukanKas = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', $bulan)->orderBy('tanggal_pemasukan', 'desc')->get();
            $totalPemasukan = $pemasukanKas->sum('jumlah_pemasukan');
        } else {
            // Menampilkan data bulan terakhir secara default
            // $lastMonth = $months->first();
            // $pemasukanKas = PemasukanKasMasjid::whereMonth('tanggal_pemasukan', $lastMonth)
            //     ->orderBy('tanggal_pemasukan', 'desc')
            //     ->get();
            $pemasukanKas = PemasukanKasMasjid::orderByDesc('created_at')->get();
        }

        // Menghitung total pemasukan setelah dikurangi total pengeluaran
        // $totalPemasukanSetelah = $totalPemasukanSebelum - $totalPengeluaranSebelum;

        $user = Auth::user();

        $dompdf = new Dompdf();
        $dompdf = App::make('dompdf.wrapper');
        // Load view PDF dan berikan data yang diperlukan
        $html = view('dashboard.laporan.pemasukan.cetak', [
            'pemasukanKas' => $pemasukanKas,
            'totalPemasukan' => $totalPemasukan, // Menggunakan total pemasukan setelah dikurangi total pengeluaran
            'totalPemasukanSebelum' => $totalPemasukanSebelum,
            'totalPengeluaranSebelum' => $totalPengeluaranSebelum,
            // 'pemasukanKasSebelum' => $pemasukanKasSebelum,
            'user' => $user,
            'bulan' => $bulan,
            'months' => $months,
        ]);

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'laporan-pemasukan-kas-bulan' . $bulan . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }






    // public function filter_pemasukan($tglawal, $tglakhir)
    // {
    //     // Total pemasukan sebelum tanggal awal
    //     $totalPemasukanSebelum = PemasukanKasMasjid::where('tanggal_pemasukan', '<', $tglawal)
    //         ->sum('jumlah_pemasukan');

    //     $pemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->get();

    //     // Buat objek Dompdf
    //     $dompdf = new Dompdf();

    //     // Load view PDF dan berikan data yang diperlukan
    //     $html = view('dashboard.laporan.pemasukan.cetak_perbulan', [
    //         "pemasukan" => $pemasukan,
    //         "tglwal" => $tglawal,
    //         "tglakhir" => $tglakhir,
    //         "total" => $totalPemasukanSebelum
    //     ]);

    //     // Konversi view HTML menjadi PDF
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     // Generate nama file PDF
    //     $filename = 'laporan_pemasukan_' . \Carbon\Carbon::parse($tglawal)->format('d-m-Y') . '_' . \Carbon\Carbon::parse($tglakhir)->format('d-m-Y') . '.pdf';

    //     // Mengirimkan hasil PDF sebagai respons file download
    //     return $dompdf->stream($filename);
    // }

    // public function pemasukan(Request $request)
    // {
    //     $tglawal = $request->input('tglawal');
    //     $tglakhir = $request->input('tglakhir');

    //     $pemasukanKas = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->get();

    //     $totalPemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->sum('jumlah_pemasukan');

    //     return redirect("/laporan-pemasukan")->withInput()->with([
    //         "tglawal" => $tglawal,
    //         "tglakhir" => $tglakhir,
    //         "pemasukanKas" => $pemasukanKas
    //     ]);
    // }
}
