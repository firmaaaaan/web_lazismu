<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PenyaluranController;
use App\Http\Controllers\PermintaanAmbulanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramDonasiController;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\ZakatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


//Pegawai
Route::get('/pegawai',[KaryawanController::class,'index'])->name('dropdown.pegawai.index');
Route::get('/pegawai/create',[KaryawanController::class,'create'])->name('pegawai.create');
Route::post('/pegawai/store',[KaryawanController::class,'store'])->name('pegawai.store');
Route::post('/pegawai/update/{id}',[KaryawanController::class,'update'])->name('pegawai.update');
Route::get('/pegawai/destroy/{id}',[KaryawanController::class,'destroy'])->name('pegawai.destroy');

//Permintaan Ambulan
Route::get('/permintaan-ambulan',[PermintaanAmbulanController::class,'index'])->name('permintaan.ambulan.index');
Route::get('/create/permintaan-ambulan',[PermintaanAmbulanController::class,'create'])->name('permintaan.ambulan.create');
Route::post('/create/permintaan-ambulan',[PermintaanAmbulanController::class,'store'])->name('permintaan.ambulan.store');
Route::get('/edit/permintaan-ambulan/{id}',[PermintaanAmbulanController::class,'edit'])->name('permintaan.ambulan.edit');
Route::post('/update/permintaan-ambulan/{id}',[PermintaanAmbulanController::class,'update'])->name('permintaan.ambulan.update');
Route::get('/destroy/permintaan-ambulan/{id}',[PermintaanAmbulanController::class,'destroy'])->name('permintaan.ambulan.destroy');
// Export PDF
Route::get('/export-permintaan-ambulan-pdf',[PermintaanAmbulanController::class,'exportPermintaanAambulanPdf'])->name('permintaan.ambulan.Pdf');
// Cetak Pertanggal
Route::get('/cetak-pertanggal/{tglAwal}/{tglAkhir}',[PermintaanAmbulanController::class,'cetakPertanggal'])->name('cetakPertanggal.pdf');



//Program Donasi
Route::get('/program-donasi',[ProgramDonasiController::class, 'index'])->name('dropdown.program.donasi.index');
Route::get('/program-donasi/show/{id}',[ProgramDonasiController::class, 'show'])->name('program.donasi.show');
Route::post('/program-donasi',[ProgramDonasiController::class, 'store'])->name('program.donasi.store');
Route::post('/program-donasi/{id}',[ProgramDonasiController::class, 'update'])->name('program.donasi.update');
Route::get('/program-donasi/destroy/{id}',[ProgramDonasiController::class, 'destroy'])->name('program.donasi.destroy');

//Donasi
Route::get('/donasi', [DonasiController::class, 'index'])->name('drop.donasi.index');
Route::get('/donasi/create', [DonasiController::class, 'create'])->name('donasi.create');
Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');
Route::get('/donasi/edit/{id}', [DonasiController::class, 'edit'])->name('donasi.edit');
Route::post('/donasi/update/{id}', [DonasiController::class, 'update'])->name('donasi.update');
Route::get('/donasi/destroy{id}', [DonasiController::class, 'destroy'])->name('donasi.destroy');
// Export PDF
Route::get('/export-donasi-pdf',[DonasiController::class,'exportPdf'])->name('exportPdf');
// Cetak Pertanggal
Route::get('/cetak-donasi-pertanggal/{tglAwal}/{tglAkhir}',[DonasiController::class,'cetakPertanggalDonasi'])->name('cetakPertanggalDonasi.pdf');
// Export Excel
Route::get('/export-donasi-excel', [DonasiController::class,'exportExcel'])->name('exportdonasiexcel');


//Zakat
Route::get('/zakat', [ZakatController::class, 'index'])->name('drop.zakat.index');
Route::get('/create-zakat', [ZakatController::class, 'create'])->name('zakat.create');
Route::post('/create-zakat',[ZakatController::class, 'store'])->name('zakat.store');
Route::get('/edit-zakat/{id}', [ZakatController::class, 'edit'])->name('zakat.edit');
Route::post('/update-zakat/{id}', [ZakatController::class, 'update'])->name('zakat.update');
Route::get('/destroy-zakat/{id}', [ZakatController::class, 'destroy'])->name('zakat.destroy');
// Export PDF
Route::get('/export-zakat-pdf',[ZakatController::class,'exportZakatPdf'])->name('exportZakatPdf');
// Cetak Pertanggal
Route::get('/cetak-zakat-pertanggal/{tglAwal}/{tglAkhir}',[ZakatController::class,'cetakPertanggalZakat'])->name('cetakPertanggalZakat.pdf');
// Export Excel
Route::get('/export-zakat-excel', [ZakatController::class,'exportExcelZakat'])->name('exportzakatexcel');



// Route penyaluran donasi
    Route::get('/donasi/{id}/salurkan', [DonasiController::class,'salurkan'])->name('donasi.salurkan');
    Route::post('/salurkan/{id}', [DonasiController::class,'storeSalurkan'])->name('donasi.storeSalurkan');

//Penyaluran Zakat
    Route::get('/zakat/{id}/salurkan', [ZakatController::class,'salurkan'])->name('zakat.salurkan');
    Route::post('zakat/salurkan/{id}', [ZakatController::class,'storeSalurkan'])->name('zakat.storeSalurkan');


Route::get('/validasi/donasi/{id}', [DonasiController::class, 'validasiDonasi'])->name('validasi.donasi');
Route::get('/validasi/zakat/{id}', [ZakatController::class, 'validasiZakat'])->name('validasi.zakat');
Route::get('/validasi/permintaan-ambulan/{id}', [PermintaanAmbulanController::class, 'validasiAmbulan'])->name('validasi.ambulan');
Route::put('perjalanan/{id}/updateStatus', [PermintaanAmbulanController::class,'updateStatus'])->name('perjalanan.updateStatus');

//Rumah Sakit
Route::get('/rumah-sakit', [RumahSakitController::class,'index'])->name('dropdown.rumahsakit.index');
Route::post('/rumah-sakit/store',[RumahSakitController::class,'store'])->name('rumahsakit.store');
Route::post('/rumah-sakit/update/{id}',[RumahSakitController::class,'update'])->name('rumahsakit.update');
Route::get('/rumah-sakit/destroy/{id}', [RumahSakitController::class,'destroy'])->name('rumahsakit.destroy');

// User
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

require __DIR__.'/auth.php';