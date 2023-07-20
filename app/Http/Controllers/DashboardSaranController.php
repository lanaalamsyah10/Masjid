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
