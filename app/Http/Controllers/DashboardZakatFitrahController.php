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
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'alamat' => 'nullable',
                'tanggal' => 'required',
                'jumlah_beras' => 'required_if:jumlah_uang,null|numeric',
                'jumlah_uang' => 'required_if:jumlah_beras,null',
            ], [
                'nama.required' => 'Nama tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'jumlah_beras.required_if' => 'Jumlah Beras atau Jumlah Uang harus diisi salah satu',
                'jumlah_beras.numeric' => 'Jumlah Beras harus berupa angka',
                'jumlah_uang.required_if' => 'Jumlah Beras atau Jumlah Uang harus diisi salah satu',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            ZakatFitrah::create([
                "nama" => $request->nama,
                "alamat" => $request->alamat,
                "tanggal" => $request->tanggal,
                "jumlah_beras" => $request->jumlah_beras,
                "jumlah_uang" => $request->jumlah_uang,
            ]);

            return redirect()->route('dashboard.zakat-zakat_fitrah.index')->with('success', 'Data Zakat Fitrah Berhasil Ditambahkan');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (QueryException $e) {
            // Handle query-related errors (e.g., duplicate entry, foreign key constraint violation)
            return redirect()->back()->with('error', 'Terjadi kesalahan pada query database. Silakan coba lagi.')->withInput();
        } catch (PDOException $e) {
            // Handle PDO-related errors
            return redirect()->back()->with('error', 'Terjadi kesalahan pada koneksi database. Silakan coba lagi.')->withInput();
        } catch (Exception $e) {
            // Handle other generic exceptions
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.')->withInput();
        }
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
        try {
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
        } catch (\Exception $e) {
            // Tangani error penyimpanan data ke database
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.')->withInput();
        }
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
