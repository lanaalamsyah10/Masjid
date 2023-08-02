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
            'zakat_mustahik' => ZakatMustahik::orderBy('created_at', 'desc')->get(),
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
        return redirect()->route('dashboard.zakat-zakat_mustahik.index')->with('success', 'Data Mustahik Berhasil Ditambahkan');
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
    public function edit($id)
    {
        $zakat_mustahik = ZakatMustahik::find($id);

        return view('dashboard.zakat.zakat_mustahik.edit', compact('zakat_mustahik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ZakatMustahik  $zakatMustahik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $zakat_mustahik = ZakatMustahik::findOrFail($id);

        $zakat_mustahik->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->route('dashboard.zakat-zakat_mustahik.index')->with('edit', 'Data Mustahik Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZakatMustahik  $zakatMustahik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zakat_mustahik = ZakatMustahik::find($id);
        $zakat_mustahik->delete();

        return back();
    }
}
