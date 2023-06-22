<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')
            ->with(['pengurus'])
            ->get();
        return view('dashboard.pengurus.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        $pengurus = Pengurus::get();
        return view('dashboard.pengurus.tambah', [
            'users' => $users,
            'pengurus' => $pengurus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'nullable|unique:users,username',
            'email' => 'nullable|email:dns|unique:users,email',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'pengurus_id' => 'required',
            'password' => 'nullable|min:6',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'username.required' => 'Username tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            'no_hp.required' => 'No HP tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'pengurus_id.required' => 'Pengurus tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => 1,
            'pengurus_id' => $request->pengurus_id,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->route('dashboard.pengurus.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('dashboard.pengurus.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function kategori()
    {
        return view('dashboard.pengurus.kategori');
    }

    public function kategori_store(Request $request)
    {
        try {

            $validated = $request->validate([
                'nama_pengurus' => 'required|string|min:3',
            ]);
            Pengurus::create([
                'nama_pengurus' => $validated['nama_pengurus'],
            ]);
            return back()->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Throwable $th) {
            return back()->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
}
