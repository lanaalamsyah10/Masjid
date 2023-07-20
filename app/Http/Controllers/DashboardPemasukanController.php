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

        $pemasukanKas = PemasukanKasMasjid::orderBy('created_at', 'desc')->get();

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

        $rekap = Rekap::where('id_pemasukan', $id)->first();

        if ($rekap) {
            $rekap->delete();
        }

        return back();
    }


    public function cetak_pdf()
    {
        $totalPemasukan = PemasukanKasMasjid::sum('jumlah_pemasukan');
        $pemasukan = PemasukanKasMasjid::all();

        $dompdf = new Dompdf();

        // Load view PDF dan berikan data yang diperlukan
        $html = view('dashboard.laporan.pemasukan.cetak', [
            'pemasukan' => $pemasukan,
            'totalPemasukan' => $totalPemasukan,
        ]);

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Generate nama file PDF
        $filename = 'laporan-pemasukan-kas' . 'pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }

    public function filter_pemasukan($tglawal, $tglakhir)
    {
        // Total pemasukan sebelum tanggal awal
        $totalPemasukanSebelum = PemasukanKasMasjid::where('tanggal_pemasukan', '<', $tglawal)
            ->sum('jumlah_pemasukan');

        $pemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->get();

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Load view PDF dan berikan data yang diperlukan
        $html = view('dashboard.laporan.pemasukan.cetak_perbulan', [
            "pemasukan" => $pemasukan,
            "tglwal" => $tglawal,
            "tglakhir" => $tglakhir,
            "total" => $totalPemasukanSebelum
        ]);

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'laporan_pemasukan_' . \Carbon\Carbon::parse($tglawal)->format('d-m-Y') . '_' . \Carbon\Carbon::parse($tglakhir)->format('d-m-Y') . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }

    public function pemasukan(Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');

        $pemasukanKas = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->get();

        $totalPemasukan = PemasukanKasMasjid::whereBetween('tanggal_pemasukan', [$tglawal, $tglakhir])->sum('jumlah_pemasukan');

        return redirect("/laporan-pemasukan")->withInput()->with([
            "tglawal" => $tglawal,
            "tglakhir" => $tglakhir,
            "pemasukanKas" => $pemasukanKas
        ]);
    }
}
