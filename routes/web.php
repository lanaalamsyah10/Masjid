<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardRekapController;
use App\Http\Controllers\DashboardSaranController;
use App\Http\Controllers\DashboardKurbanController;
use App\Http\Controllers\DashboardSholatController;
use App\Http\Controllers\DashboardPengurusController;
use App\Http\Controllers\DashboardPemasukanController;
use App\Http\Controllers\DashboardPengajianController;
use App\Http\Controllers\HalamanUtama\SaranController;
use App\Http\Controllers\DashboardPengumumanController;
use App\Http\Controllers\DashboardPengeluaranController;
use App\Http\Controllers\DashboardZakatFitrahController;
use App\Http\Controllers\DashboardZakatMustahikController;
use App\Http\Controllers\HalamanUtama\LandingPageController;

//Tampilan Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post');
Route::get('registration', [LoginController::class, 'registration'])->name('register');
Route::post('post-registration', [LoginController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [LoginController::class, 'dashboard']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// ======================================== Halaman Landing Page ======================================== //
Route::get("/", [LandingPageController::class, "home"]);
Route::get('/profil-laporan-app', [LandingPageController::class, 'laporan'])->name('profil.laporan');
Route::get('/profil-pengurus-app', [LandingPageController::class, 'pengurus'])->name('profil.pengurus');
Route::get('/jadwal-pengajian-app', [LandingPageController::class, 'pengajian'])->name('jadwal.pengajian');
Route::get('/jadwal-sholat-app', [LandingPageController::class, 'sholat'])->name('jadwal.sholat');
Route::get('/pengumuman-app', [LandingPageController::class, 'pengumuman'])->name('pengumuman.index');
Route::get('/pengumuman-app/search', [LandingPageController::class, 'pengumuman'])->name('pengumuman.search');
Route::get('/kontak-app', [SaranController::class, 'index'])->name('kontak.index');
Route::post('/kontak-app', [SaranController::class, 'store'])->name('kontak.store');


// ========================================= Halaman Dashboard ========================================= //
//Login Admin
Route::middleware(['auth'])->group(function () {
    Route::name('dashboard.')->group(function () {

        Route::group(['controller' => DashboardController::class], function () {
            Route::get('dashboard', 'index')->name('index');
        });
        //Rekap laporan
        Route::get('/laporan-rekap', [DashboardRekapController::class, 'index'])->name('laporan-rekap');
        Route::get('/cetak-laporan-pdf', [DashboardRekapController::class, 'generatePDF'])->name('cetak-laporan-pdf');
        Route::post("/laporan-rekap/rekap", [DashboardRekapController::class, "rekap"]);
        Route::get("/laporan-rekap/unduh-periode/{tglawal}/{tglakhir}", [DashboardRekapController::class, "filter_rekap"]);
        //PemasukanKasMasjid
        Route::resource('/laporan-pemasukan', DashboardPemasukanController::class);
        Route::post("/laporan-pemasukan/pemasukan", [DashboardPemasukanController::class, "pemasukan"]);
        Route::get("/laporan-pemasukan/unduh-periode/{tglawal}/{tglakhir}", [DashboardPemasukanController::class, "filter_pemasukan"]);
        Route::get('generate-pdf-pemasukan', [DashboardPemasukanController::class, 'cetak_pdf'])->name('generate-pdf-pemasukan');
        //pengeluaranKasMasjid
        Route::resource('/laporan-pengeluaran', DashboardPengeluaranController::class);
        Route::post("/laporan-pengeluaran/pengeluaran", [DashboardPengeluaranController::class, "pengeluaran"]);
        Route::get("/laporan-pengeluaran/unduh-periode/{tglawal}/{tglakhir}", [DashboardPengeluaranController::class, "filter_pengeluaran"]);
        Route::get('generate-pdf-pengeluaran', [DashboardPengeluaranController::class, 'cetak_pdf'])->name('generate-pdf-pengeluaran');
        //Jadwal Pengajian
        Route::resource('/jadwal-pengajian', DashboardPengajianController::class);
        //Jadwal Sholat
        Route::resource('/jadwal-sholat', DashboardSholatController::class);
        //Pengurus
        Route::middleware(['auth', 'user-access:admin'])->group(function () {
            Route::resource('/kelola-pengurus', AdminController::class);
            Route::resource('/biodata-pengurus', DashboardPengurusController::class);
        });
        //Zakat fitrah
        Route::resource('zakat-zakat_fitrah', DashboardZakatFitrahController::class);
        //Zakat mustahik
        Route::resource('zakat-zakat_mustahik', DashboardZakatMustahikController::class);
        // Pengumuman
        Route::resource('/pengumuman', DashboardPengumumanController::class);
        //Kurban
        Route::resource('/kurban', DashboardKurbanController::class);
        //Saran
        Route::resource('/saran', DashboardSaranController::class);
    });
});
