<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use Illuminate\Http\Request;

class DashboardSaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "saran" => Saran::orderBy('created_at', 'desc')->get()
        ];

        return view('dashboard.saran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saran  $saran
     * @return \Illuminate\Http\Response
     */
    public function show(Saran $saran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saran  $saran
     * @return \Illuminate\Http\Response
     */
    public function edit(Saran $saran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Saran  $saran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saran $saran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saran  $saran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saran = Saran::find($id);
        $saran->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
