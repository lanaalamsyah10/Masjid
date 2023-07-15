<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use Illuminate\Http\Request;

class DashboardKurbanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $kurban = Kurban::orderBy('created_at', 'desc')->get();
        $data = Kurban::all();

        $totalSapi = 0;
        $totalKambing = 0;

        foreach ($data as $row) {
            if ($row->hewan_kurban === 'Sapi') {
                $totalSapi += $row->jumlah;
            } elseif ($row->hewan_kurban === 'Kambing') {
                $totalKambing += $row->jumlah;
            }
        }
        // $totalSapi = Kurban::where('hewan_kurban', 'sapi')->count();
        // $totalKambing = Kurban::where('hewan_kurban', 'kambing')->count();
        $totalKurban = $kurban->sum('jumlah');

        return view('dashboard.kurban.index', compact('kurban', 'totalSapi', 'totalKambing', 'totalKurban'));
    }

    // public function index()
    // {
    //     // $totalPemasukan = Kurban::sum('jumlah_pemasukan');

    //     $kurban = Kurban::get();

    //     return view('dashboard.kurban.index', [
    //         'kurban' => $kurban,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kurban.tambah');
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
                'hewan_kurban' => 'required',
                'jumlah' => 'required',
                'tanggal_masuk' => 'required',
                'permintaan' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'hewan_kurban.required' => 'Kurban tidak boleh kosong',
                'jumlah.required' => 'Jumlah Kurban tidak boleh kosong',
                'tanggal_masuk.required' => 'Tanggal tidak boleh kosong',
                'permintaan.required' => 'Permintaan tidak boleh kosong',
            ]
        );

        Kurban::create([
            'nama' => $request->nama,
            'hewan_kurban' => $request->hewan_kurban,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'permintaan' => $request->permintaan,
        ]);

        return redirect()->route('dashboard.kurban.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kurban  $kurban
     * @return \Illuminate\Http\Response
     */
    public function show(Kurban $kurban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kurban  $kurban
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kurban = Kurban::find($id);

        return view('dashboard.kurban.edit', compact('kurban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kurban  $kurban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required',
                'hewan_kurban' => 'required',
                'jumlah' => 'required',
                'tanggal_masuk' => 'required',
                'permintaan' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'hewan_kurban.required' => 'Kurban tidak boleh kosong',
                'jumlah.required' => 'Jumlah Kurban tidak boleh kosong',
                'tanggal_masuk.required' => 'Tanggal tidak boleh kosong',
                'permintaan.required' => 'Permintaan tidak boleh kosong',
            ]
        );
        $kurban = Kurban::findOrFail($id);

        $kurban->update([
            'nama' => $request->nama,
            'hewan_kurban' => $request->hewan_kurban,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'permintaan' => $request->permintaan,
        ]);

        return redirect()->route('dashboard.kurban.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kurban  $kurban
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kurban = Kurban::findOrFail($id);
        $kurban->delete();

        return redirect()->route('dashboard.kurban.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
}
