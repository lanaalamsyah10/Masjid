<?php

namespace App\Http\Controllers;

use App\Models\Pengajian;
use Illuminate\Http\Request;

class DashboardPengajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajian = Pengajian::get();

        return view('dashboard.jadwal.pengajian.index', [
            'pengajian' => $pengajian,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jadwal.pengajian.tambah');
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
                'hari' => 'required',
                'pemateri' => 'required',
                'waktu' => 'required',
            ],
            [
                'hari.required' => 'Hari tidak boleh kosong',
                'pemateri.required' => 'Pemateri tidak boleh kosong',
                'waktu.required' => 'Waktu tidak boleh kosong',
            ]
        );

        Pengajian::create([
            'hari' => $request->hari,
            'pemateri' => $request->pemateri,
            'waktu' => $request->waktu,
        ]);

        return redirect()->route('dashboard.jadwal-pengajian.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengajian  $pengajian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajian $pengajian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengajian  $pengajian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengajian = Pengajian::find($id);

        return view('dashboard.jadwal.pengajian.edit', compact('pengajian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengajian  $pengajian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'hari' => 'required',
                'pemateri' => 'required',
                'waktu' => 'required',
            ],
            [
                'hari.required' => 'Hari tidak boleh kosong',
                'pemateri.required' => 'Pemateri tidak boleh kosong',
                'waktu.required' => 'Waktu tidak boleh kosong',
            ]
        );

        $pengajian = Pengajian::findOrFail($id);

        $pengajian->update([
            'hari' => $request->hari,
            'pemateri' => $request->pemateri,
            'waktu' => $request->waktu,
        ]);

        return redirect()->route('dashboard.jadwal-pengajian.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengajian  $pengajian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengajian = Pengajian::findOrFail($id);
        $pengajian->delete();

        return redirect()->route('dashboard.jadwal-pengajian.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
}
