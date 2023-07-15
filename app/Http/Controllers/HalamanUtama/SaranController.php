<?php

namespace App\Http\Controllers\HalamanUtama;

use App\Models\Saran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaranController extends Controller
{
    public function index()
    {
        return view('kontak.index', [
            'saran' => Saran::get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required',
                'email' => 'nullable|email',
                'no_hp' => 'nullable|numeric',
                'saran' => 'required',
            ],
            [
                'nama.required' => 'Nama harus diisi',
                'email.email' => 'Email tidak valid',
                'no_hp.numeric' => 'No HP harus angka',
                'saran.required' => 'Saran harus diisi',
            ]
        );
        Saran::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'saran' => $request->saran,
        ]);
        return redirect()->route('kontak.index')->with('success', 'Data Berhasil Ditambahkan');
    }
}
