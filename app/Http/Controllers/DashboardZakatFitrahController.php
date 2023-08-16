<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\PDF;
use App\Models\JenisZakat;
use App\Models\ZakatFitrah;
use Illuminate\Http\Request;
use App\Models\IsiZakatFitrah;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DashboardZakatFitrahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun = $request->input('tahun');
        if ($tahun) {
            $zakat_fitrah = ZakatFitrah::whereYear('tanggal', $tahun)->orderBy('tanggal', 'desc')->get();
            $total_beras = $zakat_fitrah->sum('jumlah_beras');
            $total_uang = $zakat_fitrah->sum('jumlah_uang');
        } else {
            // $zakat_fitrah = collect();
            $total_beras = 0;
            $total_uang = 0;
            // $zakat_fitrah = ZakatFitrah::orderBy('tanggal', 'desc')->get();
            $zakat_fitrah = ZakatFitrah::orderByDesc('created_at')->get();
        }


        $years = ZakatFitrah::selectRaw('YEAR(tanggal) as year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('dashboard.zakat.zakat_fitrah.index', [
            'zakat_fitrah' => $zakat_fitrah,
            'total_beras' => $total_beras,
            'total_uang' => $total_uang,
            'tahun' => $tahun,
            'years' => $years
        ]);
    }

    // public function downloadPDF(Request $request)
    // {
    //     $tahun = $request->input('tahun');
    //     $years = ZakatFitrah::selectRaw('YEAR(tanggal) as year')->distinct()->orderBy('year', 'desc')->pluck('year');

    //     if ($tahun) {
    //         $zakat_fitrah = ZakatFitrah::whereYear('tanggal', $tahun)->orderBy('tanggal', 'desc')->get();
    //         $total_beras = $zakat_fitrah->sum('jumlah_beras');
    //         $total_uang = $zakat_fitrah->sum('jumlah_uang');
    //     } else {
    //         $zakat_fitrah = collect();
    //         $total_beras = 0;
    //         $total_uang = 0;
    //     }

    //     $dompdf = new Dompdf();
    //     $html = view('dashboard.zakat.zakat_fitrah.cetak_perbulan', [
    //         'zakat_fitrah' => $zakat_fitrah,
    //         'total_beras' => $total_beras,
    //         'total_uang' => $total_uang,
    //         'tahun' => $tahun,
    //         'years' => $years
    //     ]);
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     $filename = 'laporan_zakat_fitrah_' . ($tahun ? $tahun : 'all_years') . '.pdf';
    //     return $dompdf->stream($filename);
    // }

    public function downloadPDF(Request $request)
    {
        $tahun = $request->input('tahun');
        $years = ZakatFitrah::selectRaw('YEAR(tanggal) as year')->distinct()->orderBy('year', 'desc')->pluck('year');

        if ($tahun) {
            $zakat_fitrah = ZakatFitrah::whereYear('tanggal', $tahun)->orderBy('tanggal', 'desc')->get();
            $total_beras = $zakat_fitrah->sum('jumlah_beras');
            $total_uang = $zakat_fitrah->sum('jumlah_uang');
        } else {
            $zakat_fitrah = collect();
            $total_beras = 0;
            $total_uang = 0;
        }
        $dompdf = new Dompdf();
        $dompdf = App::make('dompdf.wrapper');
        $html = view('dashboard.zakat.zakat_fitrah.cetak_perbulan', [
            'zakat_fitrah' => $zakat_fitrah,
            'total_beras' => $total_beras,
            'total_uang' => $total_uang,
            'tahun' => $tahun,
            'years' => $years
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $filename = 'laporan_zakat_fitrah_' . ($tahun ? $tahun : 'all_years') . '.pdf';
        return $dompdf->stream($filename);
    }




    // public function index(Request $request)
    // {
    //     $zakat_fitrah = ZakatFitrah::orderBy('created_at', 'desc')->get();
    //     $total_beras = $zakat_fitrah->sum('jumlah_beras');
    //     $total_uang = $zakat_fitrah->sum('jumlah_uang');

    //     return view('dashboard.zakat.zakat_fitrah.index', [
    //         'zakat_fitrah' => $zakat_fitrah,
    //         'total_beras' => $total_beras,
    //         'total_uang' => $total_uang
    //     ]);
    // }
    // $tahun = $request->input('tahun');

    // if ($tahun) {
    //     $zakat_fitrah = ZakatFitrah::whereYear('tanggal', $tahun)->orderBy('tanggal', 'desc')->get();
    // } else {
    //     $zakat_fitrah = ZakatFitrah::orderBy('tanggal', 'desc')->get();
    // }

    // $total_beras = $zakat_fitrah->sum('jumlah_beras');
    // $total_uang = $zakat_fitrah->sum('jumlah_uang');
    // $zakat_fitrah = ZakatFitrah::orderBy('tanggal', 'desc')->get();


    // $years = ZakatFitrah::selectRaw('YEAR(tanggal) as year')->distinct()->orderBy('year', 'desc')->pluck('year');

    // return view('dashboard.zakat.zakat_fitrah.index', compact('zakat_fitrah', 'total_beras', 'total_uang', 'years'));

    // public function filterByYear(Request $request)
    // {
    //     $tahun = $request->input('tahun');

    //     if ($tahun) {
    //         $zakat_fitrah = ZakatFitrah::whereYear('tanggal', $tahun)->orderBy('tanggal', 'desc')->get();
    //     } else {
    //         $zakat_fitrah = ZakatFitrah::orderBy('tanggal', 'desc')->get();
    //     }

    //     $total_beras = $zakat_fitrah->sum('jumlah_beras');
    //     $total_uang = $zakat_fitrah->sum('jumlah_uang');
    //     $zakat_fitrah = ZakatFitrah::orderBy('tanggal', 'desc')->get();


    //     $years = ZakatFitrah::selectRaw('YEAR(tanggal) as year')->distinct()->orderBy('year', 'desc')->pluck('year');

    //     return view('dashboard.zakat.zakat_fitrah.index', compact('zakat_fitrah', 'total_beras', 'total_uang', 'years'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.zakat.zakat_fitrah.tambah',);
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
                'nama' => 'required',
                'alamat' => 'nullable',
                'tanggal' => 'required',
                'jumlah_beras' => 'required_without_all:jumlah_uang',
                'jumlah_uang' => 'required_without_all:jumlah_beras'
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'jumlah_beras.required_without_all' => 'Jumlah Beras atau Jumlah Uang harus diisi salah satu',
                'jumlah_uang.required_without_all' => 'Jumlah Beras atau Jumlah Uang harus diisi salah satu',
            ]
        );

        ZakatFitrah::create([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "tanggal" => $request->tanggal,
            "jumlah_beras" => $request->jumlah_beras,
            "jumlah_uang" => $request->jumlah_uang,
        ]);
        return redirect()->route('dashboard.zakat-zakat_fitrah.index')->with('success', 'Data Zakat Fitrah Berhasil Diubah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZakatFitrah  $zakatFitrah
     * @return \Illuminate\Http\Response
     */
    public function show(ZakatFitrah $zakatFitrah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ZakatFitrah  $zakatFitrah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zakat_fitrah = ZakatFitrah::find($id);

        return view('dashboard.zakat.zakat_fitrah.edit', compact('zakat_fitrah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ZakatFitrah  $zakatFitrah
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $this->validate(
            $request,
            [
                'nama' => 'required',
                'alamat' => 'nullable',
                'tanggal' => 'required',
                'jumlah_beras' => 'required_without_all:jumlah_uang',
                'jumlah_uang' => 'required_without_all:jumlah_beras'
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'jumlah_beras.required_without_all' => 'Jumlah Beras atau Jumlah Uang harus diisi salah satu',
                'jumlah_uang.required_without_all' => 'Jumlah Beras atau Jumlah Uang harus diisi salah satu',
            ]
        );
        $zakat_fitrah = ZakatFitrah::findOrFail($id);

        $zakat_fitrah->update([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "tanggal" => $request->tanggal,
            "jumlah_beras" => $request->jumlah_beras,
            "jumlah_uang" => $request->jumlah_uang,
        ]);
        return redirect()->route('dashboard.zakat-zakat_fitrah.index')->with('edit', 'Data Zakat Fitrah Berhasil Diubah');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZakatFitrah  $zakatFitrah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zakat = ZakatFitrah::where("id", $id)->first();

        $zakat->delete();

        return back();
    }
    public function filter_zakat_fitrah($tglawal, $tglakhir)
    {
        $zakat_fitrah = ZakatFitrah::whereBetween('tanggal', [$tglawal, $tglakhir])->get();

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Load view PDF dan berikan data yang diperlukan
        $html = view('dashboard.zakat.zakat_fitrah.cetak_perbulan', [
            "zakat_fitrah" => $zakat_fitrah,
            "tglwal" => $tglawal,
            "tglakhir" => $tglakhir,
        ]);

        // Konversi view HTML menjadi PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Generate nama file PDF
        $filename = 'laporan_zakat_fitrah_' . \Carbon\Carbon::parse($tglawal)->format('d-m-Y') . '.pdf';

        // Mengirimkan hasil PDF sebagai respons file download
        return $dompdf->stream($filename);
    }

    public function zakat_fitrah(Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');

        $zakat_fitrah = ZakatFitrah::whereBetween('tanggal', [$tglawal, $tglakhir])->get();

        // $totalZakat_fitrah = ZakatFitrah::whereBetween('tanggal', [$tglawal, $tglakhir])->sum('jumlah');
        $total_beras = $zakat_fitrah->sum('jumlah_beras');
        $total_uang = $zakat_fitrah->sum('jumlah_uang');
        return redirect("/zakat-zakat_fitrah")->withInput()->with([
            "tglawal" => $tglawal,
            "tglakhir" => $tglakhir,
            "zakat_fitrah" => $zakat_fitrah,
            "total_beras" => $total_beras,
            "total_uang" => $total_uang,
        ]);
    }
}
