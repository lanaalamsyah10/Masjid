<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DashboardPengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengurus = Pengurus::orderBy('created_at', 'desc')->get();
        return view('dashboard.pengurus.biodata_pengurus.index', [
            'pengurus' => $pengurus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pengurus.biodata_pengurus.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'jabatan' => 'required',
                'jenis_kelamin' => 'required',
                'no_hp' => 'nullable',
                'alamat' => 'required',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'jabatan.required' => 'Jabatan tidak boleh kosong',
                'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
            ]

        );
        Pengurus::create([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('dashboard.biodata-pengurus.index')->with('success', 'Data Pengurus Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function show(Pengurus $pengurus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengurus = Pengurus::find($id);

        return view('dashboard.pengurus.biodata_pengurus.edit', compact('pengurus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'jabatan' => 'required',
                'jenis_kelamin' => 'required',
                'no_hp' => 'nullable',
                'alamat' => 'required',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'jabatan.required' => 'Jabatan tidak boleh kosong',
                'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
            ]
        );
        $pengurus = Pengurus::findOrFail($id);

        $pengurus->update([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('dashboard.biodata-pengurus.index')->with('edit', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        $pengurus->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
