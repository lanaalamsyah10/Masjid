<?php

namespace App\Http\Controllers;

use PDF;
use Dompdf\Dompdf;
use App\Models\Rekap;
use Illuminate\Http\Request;
use App\Models\PemasukanKasMasjid;
use Illuminate\Routing\Controller;
use App\Models\PengeluaranKasMasjid;

class DashboardPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "total_pengeluaran" => PengeluaranKasMasjid::sum('jumlah_pengeluaran'),
            "pengeluaran_kas" => PengeluaranKasMasjid::orderBy('created_at', 'desc')->get()
        ];

        return view('dashboard.laporan.pengeluaran.index', $data);
    }

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
        // validate saldo jika saldo tidak mencukupi maka akan di redirect ke halaman sebelumnya
        $total_pemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
        $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
        $saldo_pemasukan = $total_pemasukan - $total_pengeluaran;

        $requested_pengeluaran = $request->jumlah_pengeluaran;

        if ($saldo_pemasukan < $requested_pengeluaran) {
            return redirect()->route('dashboard.laporan-pengeluaran.index')->with('error', 'Saldo pemasukan tidak mencukupi')->withInput();
        }

        $pengeluaran = PengeluaranKasMasjid::create([
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

        return redirect()->route('dashboard.laporan-pengeluaran.index')->with('success', 'Data Berhasil Diubah');
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

        return back()->with('success', 'Data Berhasil Dihapus');
    }
    public function cetak_pdf()
    {
        $pengeluaran = PengeluaranKasMasjid::all();
        $total_pengeluaran = PengeluaranKasMasjid::sum('jumlah_pengeluaran');
        $pdf = PDF::loadview('dashboard.laporan.pengeluaran.cetak', [
            'pengeluaran' => $pengeluaran,
            'total_pengeluaran' => $total_pengeluaran
        ]);
        return $pdf->download('laporan-pengeluaran-kas.pdf');
    }

    //cetak pertanggal
    public function filter_pengeluaran($tglawal, $tglakhir)
    {
        // Total pengeluaran sebelum tanggal awal
        $totalPengeluaranSebelum = PengeluaranKasMasjid::where('tanggal_pengeluaran', '<', $tglawal)
            ->sum('jumlah_pengeluaran');

        $pengeluaran = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->get();

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Load view PDF dan berikan data yang diperlukan
        $html = view('dashboard.laporan.pengeluaran.cetak_perbulan', [
            "pengeluaran" => $pengeluaran,
            "tglwal" => $tglawal,
            "tglakhir" => $tglakhir,
            "total" => $totalPengeluaranSebelum
        ]);

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'laporan_pengeluran_' . \Carbon\Carbon::parse($tglawal)->format('d-m-Y') . '_' . \Carbon\Carbon::parse($tglakhir)->format('d-m-Y') . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }

    public function pengeluaran(Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');

        $pengeluaranKas = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->get();

        $totalPengeluaran = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->sum('jumlah_pengeluaran');

        return redirect("/laporan-pengeluaran")->withInput()->with([
            "tglawal" => $tglawal,
            "tglakhir" => $tglakhir,
            "pengeluaranKas" => $pengeluaranKas
        ]);
    }
}
