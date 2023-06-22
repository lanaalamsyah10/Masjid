<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumumanMasjid;
use Illuminate\Support\Facades\Storage;

class DashboardPengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumumanMasjid = PengumumanMasjid::get();
        return view('dashboard.pengumuman.index', [
            'pengumumanMasjid' => $pengumumanMasjid,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pengumuman.tambah');
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
                'judul_pengumuman' => 'required',
                'isi_pengumuman' => 'required',
                'tanggal' => 'required',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:7048',
                'tempat' => 'required',
                'waktu' => 'required',
            ],
            [
                'judul_pengumuman.required' => 'Judul tidak boleh kosong',
                'isi_pengumuman.required' => 'Isi tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'tempat.required' => 'Tempat tidak boleh kosong',
                'waktu.required' => 'Waktu tidak boleh kosong',
            ]
        );

        $pengumuman = new PengumumanMasjid();
        $pengumuman->judul_pengumuman = $request->judul_pengumuman;
        $pengumuman->isi_pengumuman = $request->isi_pengumuman;
        $pengumuman->tanggal = $request->tanggal;
        $pengumuman->tempat = $request->tempat;
        $pengumuman->waktu = $request->waktu;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('public/images');
            $pengumuman->gambar = $gambarPath;
        }

        $pengumuman->save();

        return redirect()->route('dashboard.pengumuman.index')->with('status', 'Data pengumuman berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengumumanMasjid  $pengumumanMasjid
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('dashboard.pengumuman.show');
        // $pengumumanMasjid = PengumumanMasjid::whereId($id)->get();
        // $pengumumanMasjid = PengumumanMasjid::findOrFail($id);

        // return view('dashboard.pengumuman.show', [
        //     'pengumumanMasjid' => $pengumumanMasjid,
        // ]);


        $pengumumanMasjid = PengumumanMasjid::find($id);
        return view('dashboard.pengumuman.show', compact('pengumumanMasjid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengumumanMasjid  $pengumumanMasjid
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengumumanMasjid = PengumumanMasjid::findOrFail($id);
        return view('dashboard.pengumuman.edit', compact('pengumumanMasjid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengumumanMasjid  $pengumumanMasjid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengumumanMasjid = PengumumanMasjid::findOrFail($id);

        $validatedData = $request->validate([
            'judul_pengumuman' => 'required',
            'isi_pengumuman' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat' => 'required',
            'waktu' => 'required',
        ]);

        $pengumumanMasjid->update([
            'judul_pengumuman' => $validatedData['judul_pengumuman'],
            'isi_pengumuman' => $validatedData['isi_pengumuman'],
            'tanggal' => $validatedData['tanggal'],
            'tempat' => $validatedData['tempat'],
            'waktu' => $validatedData['waktu'],
        ]);

        if ($request->hasFile('gambar')) {
            Storage::delete($pengumumanMasjid->gambar);
            $pengumumanMasjid->gambar = $request->file('gambar')->store('public/images');
            $pengumumanMasjid->save();
        }

        return redirect()->route('dashboard.pengumuman.index', $pengumumanMasjid->id)
            ->with('success', 'Pengumuman berhasil diperbarui');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengumumanMasjid  $pengumumanMasjid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengumumanMasjid = PengumumanMasjid::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($pengumumanMasjid->gambar) {
            Storage::delete($pengumumanMasjid->gambar);
        }

        // Hapus data pengumuman dari database
        $pengumumanMasjid->delete();

        return redirect()->route('dashboard.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
}
