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
            "pengeluaran_kas" => PengeluaranKasMasjid::get()
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
        $this->validate(
            $request,
            [
                // 'pemasukan_id' => 'nullable',
                'tanggal_pengeluaran' => 'required',
                'keterangan_pengeluaran' => 'required',
                'jumlah_pengeluaran' => 'required',
            ],
            [
                // 'pemasukan_id.nullable' => 'Pemasukan Kas tidak boleh kosong',
                'tanggal_pengeluaran.required' => 'Tanggal tidak boleh kosong',
                'keterangan_pengeluaran.required' => 'Keterangan tidak boleh kosong',
                'jumlah_pengeluaran.required' => 'Jumlah tidak boleh kosong',
            ]
        );

        $pengeluaran = PengeluaranKasMasjid::findOrFail($id);

        $pengeluaran->update([
            // 'pemasukan_id' => $request->pemasukan_id, // 'nullable
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
        // $pengeluaran = PengeluaranKasMasjid::find($id);

        // if (!$pengeluaran) {
        //     return back()->with('error', 'Data tidak ditemukan');
        // }

        // $pengeluaran->delete();

        // Rekap::where('id_pengeluaran', $id)->delete();

        // return back()->with('success', 'Data Berhasil Dihapus');
        $pengeluaran = PengeluaranKasMasjid::findOrFail($id);
        $pengeluaran->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function cetak_pdf()
    {
        $pengeluaran = PengeluaranKasMasjid::all();

        $pdf = PDF::loadview('dashboard.laporan.pengeluaran.cetak', ['pengeluaran' => $pengeluaran]);
        return $pdf->download('laporan-pengeluaran-pdf.pdf');
    }

    public function cetak_perbulan($tglwal, $tglakhir)
    {
        // Total pengeluaran sebelum tanggal awal
        $total_pengeluaranSebelum = PengeluaranKasMasjid::where('tanggal_pengeluaran', '<', $tglwal)
            ->sum('jumlah_pengeluaran');

        // Total pengeluaran dalam rentang tanggal yang diberikan
        $total_pengeluaran = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglwal, $tglakhir])
            ->sum('jumlah_pengeluaran');

        $pengeluaran_kas = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglwal, $tglakhir])->get();

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Load view PDF dan berikan data yang diperlukan
        $html = view('dashboard.laporan.pengeluaran.cetak_perbulan', compact('pengeluaran_kas', 'total_pengeluaran', 'tglwal', 'tglakhir', 'total_pengeluaranSebelum'))->render();

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'laporan_pengeluran_pertanggal' . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }

    public function filter(Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');

        $pengeluaran_kas = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->get();

        $total_pengeluaran = PengeluaranKasMasjid::whereBetween('tanggal_pengeluaran', [$tglawal, $tglakhir])->sum('jumlah_pengeluaran');

        return view('dashboard.laporan.pengeluaran.index', compact('pengeluaran_kas', 'total_pengeluaran'));
    }
}
