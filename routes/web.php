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
        Route::get('generate-pdf-rekap', [DashboardRekapController::class, 'cetak_pdf'])->name('generate-pdf-rekap');

        Route::get('/laporan-rekap', [DashboardRekapController::class, 'index'])->name('laporan-rekap');
        Route::get('/laporan-rekap/filter', [DashboardRekapController::class, 'filter'])->name('laporan-rekap.filter');
        // Route::get('/cetak-laporan-pdf{bulan}/{tahun}', [DashboardRekapController::class, 'generatePDF'])->name('cetak-laporan-pdf');

        Route::post("/laporan-rekap/rekap", [DashboardRekapController::class, "rekap"]);
        Route::get("/laporan-rekap/unduh-periode/{tglawal}/{tglakhir}", [DashboardRekapController::class, "filter_rekap"]);
        //PemasukanKasMasjid
        Route::resource('/laporan-pemasukan', DashboardPemasukanController::class);
        Route::get('generate-pdf-pemasukan', [DashboardPemasukanController::class, 'cetak_pdf'])->name('generate-pdf-pemasukan');
        // Route::post("/laporan-pemasukan/pemasukan", [DashboardPemasukanController::class, "pemasukan"]);
        // Route::get("/laporan-pemasukan/unduh-periode/{tglawal}/{tglakhir}", [DashboardPemasukanController::class, "filter_pemasukan"]);
        //pengeluaranKasMasjid
        Route::resource('/laporan-pengeluaran', DashboardPengeluaranController::class);
        Route::get('generate-pdf-pengeluaran', [DashboardPengeluaranController::class, 'cetak_pdf'])->name('generate-pdf-pengeluaran');
        // Route::post("/laporan-pengeluaran/pengeluaran", [DashboardPengeluaranController::class, "pengeluaran"]);
        // Route::get("/laporan-pengeluaran/unduh-periode/{tglawal}/{tglakhir}", [DashboardPengeluaranController::class, "filter_pengeluaran"]);
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
        // Route::resource('zakat-zakat_fitrah', DashboardZakatFitrahController::class);
        // Route::post('/zakat-zakat_fitrah/filter', [DashboardZakatFitrahController::class, 'filterByYear'])->name('zakat-zakat_fitrah.filter');

        Route::resource('zakat-zakat_fitrah', DashboardZakatFitrahController::class);
        // Route::get('zakat-zakat_fitrah/print-preview/{tahun}', 'DashboardZakatFitrahController@printPreview')->name('zakat-zakat_fitrah.print-preview');
        Route::get('generate-pdf-zakat_fitrah', [DashboardZakatFitrahController::class, 'downloadPDF'])
            ->name('generate-pdf-zakat_fitrah');
        // Route::post("/zakat-zakat_fitrah/zakat_fitrah", [DashboardZakatFitrahController::class, "zakat_fitrah"]);
        // Route::get("/zakat-zakat_fitrah/unduh-periode/{tglawal}/{tglakhir}", [DashboardZakatFitrahController::class, "filter_zakat_fitrah"]);
        //Zakat mustahik
        Route::resource('zakat-zakat_mustahik', DashboardZakatMustahikController::class);
        // Pengumuman
        Route::resource('/pengumuman', DashboardPengumumanController::class);
        //Kurban
        // Route::post('/kurban/filter', [DashboardKurbanController::class, 'filterByYear'])->name('kurban.filter');
        // Route::get('/kurban/download-pdf/{tahun}', [DashboardKurbanController::class, 'download_pdf'])->name('dashboard.kurban.download-pdf');
        // Route::get('/dashboard/kurban/download-pdf', [DashboardKurbanController::class, 'downloadPDF'])->name('dashboard.kurban.download-pdf');

        Route::resource('/kurban', DashboardKurbanController::class);
        // Route::get('/kurban/filter', [DashboardKurbanController::class, 'filter'])->name('dashboard.kurban.filter');

        Route::get('generate-pdf-kurban', [DashboardKurbanController::class, 'downloadPDF'])
            ->name('generate-pdf-kurban');

        // Route::post("/laporan-kurban/kurban", [DashboardKurbanController::class, "kurban"]);
        // Route::get("/laporan-kurban/unduh-periode/{tglawal}/{tglakhir}", [DashboardKurbanController::class, "filter_kurban"]);
        //Saran
        Route::resource('/saran', DashboardSaranController::class);
    });
});
