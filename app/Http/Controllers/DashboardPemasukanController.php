<?php

namespace App\Http\Controllers;

use PDF;
use Dompdf\Dompdf;
use App\Models\Rekap;
use Illuminate\Http\Request;
use App\Models\PemasukanKasMasjid;

class DashboardPemasukanController extends Controller
{
    /**
     * Display a listing of xthe resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalPemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');

        $pemasukanKas = PemasukanKasMasjid::get();

        return view('dashboard.laporan.pemasukan.index', [
            'pemasukanKas' => $pemasukanKas,
            'totalPemasukan' => $totalPemasukan,
        ]);
    }

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
        // return view('dashboard.laporan.pemasukan.edit', compact('pemasukan'));
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

        return redirect()->route('dashboard.laporan-pemasukan.index')->with('success', 'Data Berhasil Diubah');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PemasukanKasMasjid  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $pemasukan = PemasukanKasMasjid::find($id);

        // if (!$pemasukan) {
        //     return back()->with('error', 'Data tidak ditemukan');
        // }

        // $pemasukan->delete();

        // // Delete the associated rekap record
        // Rekap::where('id_pemasukan', $id)->delete();

        // return back()->with('success', 'Data Berhasil Dihapus');

        $pemasukan = PemasukanKasMasjid::findOrFail($id);
        $pemasukan->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }


    public function cetak_pdf()
    {
        $totalPemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
        $pemasukan = PemasukanKasMasjid::all();

        $pdf = PDF::loadview('dashboard.laporan.pemasukan.cetak', [
            'pemasukan' => $pemasukan,
            'totalPemasukan' => $totalPemasukan,
        ]);
        return $pdf->download('laporan-pemasukan-pdf.pdf');
    }

    // public function cetak_perbulan()
    // {
    //     $totalPemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
    //     $pemasukan = PemasukanKasMasjid::all();

    //     $pdf = PDF::loadview('dashboard.laporan.pemasukan.cetak_perbulan', [
    //         'pemasukan' => $pemasukan,
    //         'totalPemasukan' => $totalPemasukan,
    //     ]);
    //     return $pdf->download('laporan-pemasukan_perbulan-pdf.pdf');
    // }

    // public function cetak_perbulan($tglwal, $tglakhir)
    // {
    //     // Total pemasukan sebelum tanggal awal
    //     $totalPemasukanSebelum = PemasukanKasMasjid::where('tanggal_pemasukan', '<', $tglwal)
    //         ->sum('jumlah_pemasukan');

    //     // Total pemasukan dalam rentang tanggal yang diberikan
    //     $totalPemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglwal, $tglakhir])
    //         ->sum('jumlah_pemasukan');

    //     $pemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglwal, $tglakhir])->get();
    //     return view('dashboard.laporan.pemasukan.cetak_perbulan', compact('pemasukan', 'totalPemasukan', 'tglwal', 'tglakhir', 'totalPemasukanSebelum'));
    // }

    public function cetak_pertanggal($tglwal, $tglakhir)
    {
        // Total pemasukan sebelum tanggal awal
        $totalPemasukanSebelum = PemasukanKasMasjid::where('tanggal_pemasukan', '<', $tglwal)
            ->sum('jumlah_pemasukan');

        // Total pemasukan dalam rentang tanggal yang diberikan
        $totalPemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglwal, $tglakhir])
            ->sum('jumlah_pemasukan');

        $pemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglwal, $tglakhir])->get();

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Load view PDF dan berikan data yang diperlukan
        $html = view('dashboard.laporan.pemasukan.cetak_perbulan', compact('pemasukan', 'totalPemasukan', 'tglwal', 'tglakhir', 'totalPemasukanSebelum'))->render();

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'laporan_pemasukan_pertanggal' . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }

    public function filter_pemasukan(Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');

        $pemasukanKas = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->get();

        $totalPemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->sum('jumlah_pemasukan');

        return view('dashboard.laporan.pemasukan.index', compact('pemasukanKas', 'totalPemasukan'));
    }
    // public function filter(Request $request)
    // {
    //     $tglawal = $request->tglawal;
    //     $tglakhir = $request->tglakhir;

    //     $pemasukanKas = PemasukanKasMasjid::whereBetween('created_at', '>=', $tglawal)
    //         ->whereDate('created_at', '<=', $tglakhir)
    //         ->get();
    //     return view('dashboard.laporan.pemasukan.index', compact('pemasukanKas'));
    // }
}
