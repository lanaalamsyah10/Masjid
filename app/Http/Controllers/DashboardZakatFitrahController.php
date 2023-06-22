<?php

namespace App\Http\Controllers;

use App\Models\JenisZakat;
use App\Models\ZakatFitrah;
use Illuminate\Http\Request;
use App\Models\IsiZakatFitrah;
use App\Http\Controllers\Controller;

class DashboardZakatFitrahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zakat_fitrah = ZakatFitrah::get();
        $total_beras = $zakat_fitrah->sum('jumlah_beras');
        $total_uang = $zakat_fitrah->sum('jumlah_uang');

        $data = [
            "zakat_fitrah" => $zakat_fitrah,
            "total_beras" => $total_beras,
            "total_uang" => $total_uang
        ];

        return view('dashboard.zakat.zakat_fitrah.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('dashboard.zakat.zakat_fitrah.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ZakatFitrah::create([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "tanggal" => $request->tanggal,
            "jumlah_beras" => $request->jumlah_beras,
            "jumlah_uang" => $request->jumlah_uang,
            // "kode_jenis_zakat" => $request->kode_jenis_zakat,
            // "kode_isi_zakat" => $request->kode_isi_zakat,
        ]);

        return redirect()->intended('/zakat-zakat_fitrah');

        // return redirect()->intended('/zakat-zakat_fitrah');
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
    public function edit(ZakatFitrah $zakatFitrah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ZakatFitrah  $zakatFitrah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ZakatFitrah $zakatFitrah)
    {
        //
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
}
