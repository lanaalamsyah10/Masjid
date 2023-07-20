<?php

namespace App\Http\Controllers;

use App\Models\Sholat;
use Illuminate\Http\Request;

class DashboardSholatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sholat = Sholat::orderBy('created_at', 'desc')->get();

        return view('dashboard.jadwal.sholat.index', [
            'sholat' => $sholat,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jadwal.sholat.tambah');
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
                'waktu' => 'required',
                'imam' => 'required',
            ],
            [
                'waktu.required' => 'Waktu tidak boleh kosong',
                'imam.required' => 'Nama imam tidak boleh kosong',
            ]
        );

        Sholat::create([
            'waktu' => $request->waktu,
            'imam' => $request->imam,
        ]);

        return redirect()->route('dashboard.jadwal-sholat.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sholat  $sholat
     * @return \Illuminate\Http\Response
     */
    public function show(Sholat $sholat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sholat  $sholat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sholat = Sholat::findOrFail($id);

        return view('dashboard.jadwal.sholat.edit', compact('sholat'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'waktu' => 'required',
                'imam' => 'required',
            ],
            [
                'waktu.required' => 'Waktu tidak boleh kosong',
                'imam.required' => 'Nama imam tidak boleh kosong',
            ]
        );

        $sholat = Sholat::findOrFail($id);

        $sholat->update([
            'waktu' => $request->waktu,
            'imam' => $request->imam,
        ]);

        return redirect()->route('dashboard.jadwal-sholat.index')->with('edit', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sholat  $sholat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sholat = Sholat::find($id);
        $sholat->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
