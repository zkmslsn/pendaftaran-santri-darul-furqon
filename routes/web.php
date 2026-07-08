<?php

use App\Http\Controllers\AdminPendaftarController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengasuhController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriStatusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/informasi', function () {
    return view('informasi');
})->name('informasi');

Route::get('/syarat-ketentuan', function () {
    return view('syarat');
})->name('syarat');

Route::get('/daftar', [PendaftaranController::class, 'create'])->name('daftar.create');
Route::post('/daftar', [PendaftaranController::class, 'store'])->name('daftar.store');

/*
|--------------------------------------------------------------------------
| Dashboard Setelah Login Breeze
|--------------------------------------------------------------------------
| Breeze default-nya masuk ke /dashboard.
| Route ini kita ubah agar user diarahkan sesuai role.
*/

Route::get('/dashboard', function () {
    $user = auth()->user();
    $dashboardRoute = $user->dashboardRouteName();

    return $dashboardRoute
        ? redirect()->route($dashboardRoute)
        : redirect()->route('beranda');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Halaman Admin, Pengasuh, dan Santri
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile Breeze
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', [AdminPendaftarController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/pendaftar', [AdminPendaftarController::class, 'index'])
        ->name('admin.pendaftar.index');

    Route::get('/admin/pendaftar/export', [AdminPendaftarController::class, 'export'])
        ->name('admin.pendaftar.export');

    Route::get('/admin/santri-aktif', [AdminPendaftarController::class, 'aktif'])
        ->name('admin.santri.aktif');

    Route::get('/admin/alumni', [AdminPendaftarController::class, 'alumni'])
        ->name('admin.santri.alumni');

    Route::get('/admin/download-data', [AdminPendaftarController::class, 'download'])
        ->name('admin.download.index');

    Route::post('/admin/download-data/export', [AdminPendaftarController::class, 'export'])
        ->name('admin.download.export');

    Route::get('/admin/download-data/{pendaftar}/pdf', [AdminPendaftarController::class, 'downloadPdf'])
        ->name('admin.download.pdf');

    Route::get('/admin/pendaftar/{pendaftar}/edit', [AdminPendaftarController::class, 'edit'])
        ->name('admin.pendaftar.edit');

    Route::get('/admin/pendaftar/{pendaftar}', [AdminPendaftarController::class, 'show'])
        ->name('admin.pendaftar.show');

    Route::patch('/admin/pendaftar/{pendaftar}', [AdminPendaftarController::class, 'update'])
        ->name('admin.pendaftar.update');

    Route::patch('/admin/pendaftar/{pendaftar}/status', [AdminPendaftarController::class, 'updateStatus'])
        ->name('admin.pendaftar.updateStatus');

    Route::patch('/admin/pendaftar/{pendaftar}/pembayaran', [AdminPendaftarController::class, 'updatePembayaran'])
        ->name('admin.pendaftar.updatePembayaran');

    Route::patch('/admin/pendaftar/{pendaftar}/verifikasi', [AdminPendaftarController::class, 'updateVerification'])
        ->name('admin.pendaftar.updateVerification');

    Route::post('/admin/pendaftar/{pendaftar}/buat-akun-santri', [AdminPendaftarController::class, 'buatAkunSantri'])
        ->name('admin.pendaftar.buatAkunSantri');

    Route::patch('/admin/pendaftar/{pendaftar}/verifikasi-final', [AdminPendaftarController::class, 'verifikasiFinal'])
        ->name('admin.pendaftar.verifikasiFinal');

    /*
    |--------------------------------------------------------------------------
    | Santri
    |--------------------------------------------------------------------------
    */

    Route::get('/santri/status', [SantriStatusController::class, 'status'])
        ->name('santri.status');

    /*
    |--------------------------------------------------------------------------
    | Pengasuh
    |--------------------------------------------------------------------------
    */

    Route::get('/pengasuh/dashboard', [PengasuhController::class, 'dashboard'])
        ->name('pengasuh.dashboard');
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');

Route::get('/santri', function () {
    return redirect()->route('santri.status');
})->middleware('auth');

Route::get('/pengasuh', function () {
    return redirect()->route('pengasuh.dashboard');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Route Auth Laravel Breeze
|--------------------------------------------------------------------------
*/
Route::get('/santri/login', function () {
    return redirect()->route('login', ['role' => 'santri']);
})->name('santri.login');

require __DIR__.'/auth.php';
