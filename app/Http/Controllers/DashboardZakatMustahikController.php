<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZakatMustahik;

class DashboardZakatMustahikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.zakat.zakat_mustahik.index', [
            'zakat_mustahik' => ZakatMustahik::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('dashboard.zakat.zakat_mustahik.tambah');
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
                'alamat' => 'required',
                'tanggal' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
            ]
        );

        ZakatMustahik::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->intended('/zakat-mustahik');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZakatMustahik  $zakatMustahik
     * @return \Illuminate\Http\Response
     */
    public function show(ZakatMustahik $zakatMustahik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ZakatMustahik  $zakatMustahik
     * @return \Illuminate\Http\Response
     */
    public function edit(ZakatMustahik $zakatMustahik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ZakatMustahik  $zakatMustahik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ZakatMustahik $zakatMustahik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZakatMustahik  $zakatMustahik
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZakatMustahik $zakatMustahik)
    {
        //
    }
}
