<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\JenisZakat;
use App\Models\ZakatFitrah;
use Illuminate\Http\Request;
use App\Models\IsiZakatFitrah;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DashboardZakatFitrahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zakat_fitrah = ZakatFitrah::orderBy('created_at', 'desc')->get();
        $total_beras = $zakat_fitrah->sum('jumlah_beras');
        $total_uang = $zakat_fitrah->sum('jumlah_uang');

        $data = [
            "zakat_fitrah" => $zakat_fitrah,
            "total_beras" => $total_beras,
            "total_uang" => $total_uang
        ];

        return view('dashboard.zakat.zakat_fitrah.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.zakat.zakat_fitrah.tambah',);
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
                'alamat' => 'nullable',
                'tanggal' => 'required',
                'jumlah_beras' => 'required_without_all:jumlah_uang',
                'jumlah_uang' => 'required_without_all:jumlah_beras'
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'jumlah_beras.required_without_all' => 'Jumlah Beras atau Jumlah Uang harus diisi salah satu',
                'jumlah_uang.required_without_all' => 'Jumlah Beras atau Jumlah Uang harus diisi salah satu',
            ]
        );

        ZakatFitrah::create([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "tanggal" => $request->tanggal,
            "jumlah_beras" => $request->jumlah_beras,
            "jumlah_uang" => $request->jumlah_uang,
        ]);
        return redirect()->route('dashboard.zakat-zakat_fitrah.index')->with('success', 'Data Zakat Fitrah Berhasil Diubah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZakatFitrah  $zakatFitrah
     * @return \Illuminate\Http\Response
     */
    public function show(ZakatFitrah $zakatFitrah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ZakatFitrah  $zakatFitrah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zakat_fitrah = ZakatFitrah::find($id);

        return view('dashboard.zakat.zakat_fitrah.edit', compact('zakat_fitrah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ZakatFitrah  $zakatFitrah
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $this->validate(
            $request,
            [
                'nama' => 'required',
                'alamat' => 'nullable',
                'tanggal' => 'required',
                'jumlah_beras' => 'required_without_all:jumlah_uang',
                'jumlah_uang' => 'required_without_all:jumlah_beras'
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'jumlah_beras.required_without_all' => 'Jumlah Beras atau Jumlah Uang harus diisi salah satu',
                'jumlah_uang.required_without_all' => 'Jumlah Beras atau Jumlah Uang harus diisi salah satu',
            ]
        );
        $zakat_fitrah = ZakatFitrah::findOrFail($id);

        $zakat_fitrah->update([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "tanggal" => $request->tanggal,
            "jumlah_beras" => $request->jumlah_beras,
            "jumlah_uang" => $request->jumlah_uang,
        ]);
        return redirect()->route('dashboard.zakat-zakat_fitrah.index')->with('edit', 'Data Zakat Fitrah Berhasil Diubah');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZakatFitrah  $zakatFitrah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zakat = ZakatFitrah::where("id", $id)->first();

        $zakat->delete();

        return back();
    }
}
