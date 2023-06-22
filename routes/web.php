<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardRekapController;
use App\Http\Controllers\DashboardKurbanController;
use App\Http\Controllers\DashboardSholatController;
use App\Http\Controllers\DashboardPemasukanController;
use App\Http\Controllers\DashboardPengajianController;
use App\Http\Controllers\DashboardPengumumanController;
use App\Http\Controllers\DashboardPengeluaranController;
use App\Http\Controllers\DashboardZakatFitrahController;
use App\Http\Controllers\DashboardZakatMustahikController;
use App\Http\Controllers\HalamanUtama\LandingPageController;


// ======================================== Halaman Landing Page ======================================== //
Route::get("/", [LandingPageController::class, "home"]);
Route::get('/profil-index1', [LandingPageController::class, 'index'])->name('profil.laporan');
Route::get('/profil-laporan', [LandingPageController::class, 'laporan'])->name('profil.laporan');
Route::get('/profil-pengurus', [LandingPageController::class, 'pengurus'])->name('profil.pengurus');
Route::get('/jadwal-pengajian-app', [LandingPageController::class, 'pengajian'])->name('jadwal.pengajian');
Route::get('/jadwal-sholat-app', [LandingPageController::class, 'sholat'])->name('jadwal.sholat');
Route::get('/pengumuman-app', [LandingPageController::class, 'pengumuman'])->name('pengumuman.index');
Route::get('/kontak', [LandingPageController::class, 'kontak'])->name('kontak.index');


// ========================================= Halaman Dashboard ========================================= //
//Tampilan Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post');
Route::get('registration', [LoginController::class, 'registration'])->name('register');
Route::post('post-registration', [LoginController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [LoginController::class, 'dashboard']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

//Login Pengurus
Route::middleware(['auth', 'user-access:pengurus'])->group(function () {
    Route::resource('/pengumuman', DashboardPengumumanController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update'
    ]);
    Route::get('/pengumuman/{id}/delete', [DashboardPengumumanController::class, 'destroy'])->name('pengumuman.destroy');
    Route::get('/laporan-rekap-index', [DashboardRekapController::class, 'index'])->name('laporan-rekap-index');
    return view('dashboard.laporan.rekap.index');
});

//Login Admin
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::name('dashboard.')->group(function () {

        Route::group(['controller' => DashboardController::class], function () {
            Route::get('dashboard', 'index')->name('index');
        });
        //PemasukanKasMasjid
        Route::resource('/laporan-pemasukan', DashboardPemasukanController::class)->except('destroy');
        Route::delete('laporan-pemasukan/delete/{id}', [DashboardPemasukanController::class, 'destroy'])->name('laporan-pemasukan.destroy');
        Route::get('generate-pdf-pemasukan', [DashboardPemasukanController::class, 'cetak_pdf'])->name('generate-pdf-pemasukan');
        Route::get('/cetak-data-pertanggal/{tglawal}/{tglakhir}', [DashboardPemasukanController::class, 'cetak_pertanggal'])->name('cetak-data-pertanggal');
        Route::get('/filter-pemasukan', [DashboardPemasukanController::class, 'filter_pemasukan'])->name('filter-pemasukan');
        //pengeluaranKasMasjid
        Route::resource('/laporan-pengeluaran', DashboardPengeluaranController::class)->except('destroy');
        Route::delete('/laporan-pengeluaran/delete/{id}', [DashboardPengeluaranController::class, 'destroy'])->name('laporan-pengeluaran.destroy');
        Route::get('generate-pdf-pengeluaran', [DashboardPengeluaranController::class, 'cetak_pdf'])->name('generate-pdf-pengeluaran');
        Route::get('/cetak-data-perbulan/{tglawal}/{tglakhir}', [DashboardPengeluaranController::class, 'cetak_perbulan'])->name('cetak-data-perbulan');
        Route::get('/filter', [DashboardPengeluaranController::class, 'filter'])->name('filter');
        //Jadwal Pengajian
        Route::resource('/jadwal-pengajian', DashboardPengajianController::class)->except('destroy');
        Route::delete('/jadwal-pengajian/delete/{id}', [DashboardPengajianController::class, 'destroy'])->name('jadwal-pengajian.destroy');
        //Jadwal Sholat
        Route::resource('/jadwal-sholat', DashboardSholatController::class)->except('destroy');
        Route::delete('/jadwal-sholat/delete/{id}', [DashboardSholatController::class, 'destroy'])->name('jadwal-sholat.destroy');
        //Pengurus
        Route::resource('/pengurus', AdminController::class);
        Route::get('/pengurus-kategori', [AdminController::class, 'kategori'])->name('pengurus.kategori');
        Route::post('/pengurus-kategori', [AdminController::class, 'kategori_store'])->name('pengurus.kategori.store');
        Route::delete('/pengurus/delete/{id}', [AdminController::class, 'destroy'])->name('pengurus.destroy');
        // Pengumuman
        Route::resource('/pengumuman', DashboardPengumumanController::class);
        Route::resource('/pengumuman', DashboardPengumumanController::class)->only([
            'index', 'create', 'store', 'show', 'edit', 'update'
        ]);
        Route::delete('/pengumuman/{id}/delete', [DashboardPengumumanController::class, 'destroy'])->name('pengumuman.destroy');
        //Kurban
        Route::resource('/kurban', DashboardKurbanController::class)->except('destroy');
        Route::delete('/kurban/delete/{id}', [DashboardKurbanController::class, 'destroy'])->name('kurban.destroy');
        Route::resource('zakat-zakat_fitrah', DashboardZakatFitrahController::class);
        Route::resource('zakat-zakat_mustahik', DashboardZakatMustahikController::class);
    });
});
