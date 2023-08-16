<?php

namespace App\Http\Controllers;

use PDF;
use Dompdf\Dompdf;
use App\Models\Rekap;
use Illuminate\Http\Request;
use App\Models\PemasukanKasMasjid;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use App\Models\PengeluaranKasMasjid;
use Illuminate\Support\Facades\Auth;

class DashboardPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $months = PengeluaranKasMasjid::selectRaw('MONTH(tanggal_pengeluaran) as month')->distinct()->orderBy('month', 'desc')->pluck('month');

        if ($bulan) {
            $pengeluaran_kas = PengeluaranKasMasjid::whereMonth('tanggal_pengeluaran', $bulan)->orderBy('tanggal_pengeluaran', 'desc')->get();

            $total_pengeluaran = $pengeluaran_kas->sum('jumlah_pengeluaran');
            $user = Auth::user();
        } else {
            // Menampilkan data bulan terakhir secara default
            // $lastMonth = $months->first();
            // $pengeluaran_kas = PengeluaranKasMasjid::whereMonth('tanggal_pengeluaran', $lastMonth)->orderBy('tanggal_pengeluaran', 'desc')->get();
            $pengeluaran_kas = PengeluaranKasMasjid::orderByDesc('created_at')->get();

            $total_pengeluaran = 0;
            $user = Auth::user();
        }

        // $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');

        // $pengeluaran_kas = PengeluaranKasMasjid::orderBy('created_at', 'desc')->get();
        return view('dashboard.laporan.pengeluaran.index', [
            'total_pengeluaran' => $total_pengeluaran,
            'pengeluaran_kas' => $pengeluaran_kas,
            'user' => $user,
            'bulan' => $bulan,
            'months' => $months,
        ]);
    }
    // public function index()
    // {
    //     $user = Auth::user();

    //     $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');

    //     $pengeluaran_kas = PengeluaranKasMasjid::orderBy('created_at', 'desc')->get();
    //     return view('dashboard.laporan.pengeluaran.index', [
    //         'total_pengeluaran' => $total_pengeluaran,
    //         'pengeluaran_kas' => $pengeluaran_kas,
    //         'user' => $user,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $pemasukanKas = PemasukanKasMasjid::get();

        return view('dashboard.laporan.pengeluaran.tambah');
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
        // validate saldo jika saldo tidak mencukupi maka akan di redirect ke halaman sebelumnya
        $total_pemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
        $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
        $saldo_pemasukan = $total_pemasukan - $total_pengeluaran;

        $requested_pengeluaran = $request->jumlah_pengeluaran;

        if ($saldo_pemasukan < $requested_pengeluaran) {
            return redirect()->route('dashboard.laporan-pengeluaran.index')->with('error', 'Saldo pemasukan tidak mencukupi')->withInput();
        }

        $pengeluaran = PengeluaranKasMasjid::create([
            'user_id' => $user->id,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'keterangan_pengeluaran' => $request->keterangan_pengeluaran,
            'jumlah_pengeluaran' => $requested_pengeluaran,
        ]);

        Rekap::create([
            'id_pengeluaran' => $pengeluaran->id,
        ]);

        return redirect()->route('dashboard.laporan-pengeluaran.index')->with('success', 'Data Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengeluaranKasMasjid  $pengeluaranKasMasjid
     * @return \Illuminate\Http\Response
     */
    public function show(PengeluaranKasMasjid $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengeluaranKasMasjid  $pengeluaranKasMasjid
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengeluaran = PengeluaranKasMasjid::find($id);

        return view('dashboard.laporan.pengeluaran.edit', compact('pengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengeluaranKasMasjid  $pengeluaranKasMasjid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'tanggal_pengeluaran' => 'required',
                'keterangan_pengeluaran' => 'required',
                'jumlah_pengeluaran' => 'required',
            ],
            [
                'tanggal_pengeluaran.required' => 'Tanggal tidak boleh kosong',
                'keterangan_pengeluaran.required' => 'Keterangan tidak boleh kosong',
                'jumlah_pengeluaran.required' => 'Jumlah tidak boleh kosong',
            ]
        );

        $pengeluaran = PengeluaranKasMasjid::findOrFail($id);

        $pengeluaran->update([
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'keterangan_pengeluaran' => $request->keterangan_pengeluaran,
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
        ]);

        return redirect()->route('dashboard.laporan-pengeluaran.index')->with('edit', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengeluaranKasMasjid  $pengeluaranKasMasjid
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $pengeluaran = PengeluaranKasMasjid::findOrFail($id);
        $pengeluaran->delete();

        $rekap = Rekap::where('id_pengeluaran', $id)->first();

        if ($rekap) {
            $rekap->delete();
        }

        return back();
    }
    public function cetak_pdf(Request $request)
    {
        $bulan = $request->input('bulan');
        $months = PengeluaranKasMasjid::selectRaw('MONTH(tanggal_pengeluaran) as month')->distinct()->orderBy('month', 'desc')->pluck('month');

        if ($bulan) {
            $pengeluaran_kas = PengeluaranKasMasjid::whereMonth('tanggal_pengeluaran', $bulan)->orderBy('tanggal_pengeluaran', 'desc')->get();

            $total_pengeluaran = $pengeluaran_kas->sum('jumlah_pengeluaran');
            $user = Auth::user();
        } else {
            // Menampilkan data bulan terakhir secara default
            // $lastMonth = $months->first();
            // $pengeluaran_kas = PengeluaranKasMasjid::whereMonth('tanggal_pengeluaran', $lastMonth)->orderBy('tanggal_pengeluaran', 'desc')->get();
            $pengeluaran_kas = PengeluaranKasMasjid::orderByDesc('created_at')->get();

            $total_pengeluaran = 0;
            $user = Auth::user();
        }
        $dompdf = new Dompdf();
        $dompdf = App::make('dompdf.wrapper');
        // Load view PDF dan berikan data yang diperlukan
        $html = view('dashboard.laporan.pengeluaran.cetak', [
            'total_pengeluaran' => $total_pengeluaran,
            'pengeluaran_kas' => $pengeluaran_kas,
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

    //cetak pertanggal
    // public function filter_pengeluaran($tglawal, $tglakhir)
    // {
    //     // Total pengeluaran sebelum tanggal awal
    //     $totalPengeluaranSebelum = PengeluaranKasMasjid::where('tanggal_pengeluaran', '<', $tglawal)
    //         ->sum('jumlah_pengeluaran');

    //     $pengeluaran = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->get();

    //     // Buat objek Dompdf
    //     $dompdf = new Dompdf();

    //     // Load view PDF dan berikan data yang diperlukan
    //     $html = view('dashboard.laporan.pengeluaran.cetak_perbulan', [
    //         "pengeluaran" => $pengeluaran,
    //         "tglwal" => $tglawal,
    //         "tglakhir" => $tglakhir,
    //         "total" => $totalPengeluaranSebelum
    //     ]);

    //     // Konversi view HTML menjadi PDF
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     // Generate nama file PDF
    //     $filename = 'laporan_pengeluran_' . \Carbon\Carbon::parse($tglawal)->format('d-m-Y') . '_' . \Carbon\Carbon::parse($tglakhir)->format('d-m-Y') . '.pdf';

    //     // Mengirimkan hasil PDF sebagai respons file download
    //     return $dompdf->stream($filename);
    // }

    // public function pengeluaran(Request $request)
    // {
    //     $tglawal = $request->input('tglawal');
    //     $tglakhir = $request->input('tglakhir');

    //     $pengeluaranKas = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->get();

    //     $totalPengeluaran = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->sum('jumlah_pengeluaran');

    //     return redirect("/laporan-pengeluaran")->withInput()->with([
    //         "tglawal" => $tglawal,
    //         "tglakhir" => $tglakhir,
    //         "pengeluaranKas" => $pengeluaranKas
    //     ]);
    // }
}
