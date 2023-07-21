<?php

use App\Models\LogTransaksi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MustahikController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenyaluranController;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\LogTransaksiController;
use App\Http\Controllers\ProgramDonasiController;
use App\Http\Controllers\PermintaanAmbulanController;

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
Route::get('/register/donatur',[DonaturController::class,'create'])->name('donatur.register');
Route::post('/donatur/user',[DonaturController::class,'store'])->name('donatur.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'admin.or.pimpinan'])->name('dashboard');

Route::middleware(['auth', 'admin.or.pimpinan'])->group(function () {
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
    Route::get('/program-donasi/show/{id_akun}/program-donasi/{programdonasi_id}',[ProgramDonasiController::class, 'show'])->name('program.donasi.show');
    Route::post('/program-donasi',[ProgramDonasiController::class, 'store'])->name('program.donasi.store');
    Route::post('/program-donasi/{id}',[ProgramDonasiController::class, 'update'])->name('program.donasi.update');
    Route::get('/program-donasi/destroy/{id}',[ProgramDonasiController::class, 'destroy'])->name('program.donasi.destroy');
// Cetak Pertanggal
    Route::get('/cetak-program-donasi-pertanggal/{tglAwal}/{tglAkhir}',[ProgramDonasiController::class,'cetakPertanggalProgramDonasi'])->name('cetakPertanggalProgramDonasi.pdf');
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
    Route::get('/program/{id}/akun/{akun_id}',[DonasiController::class,'programIndex'])->name('program.index');
    // //Export Perprogram donasi pertanggal
    Route::get('/cetak-program-dan-akun-pertanggal/{programId}/{tglAwal}/{tglAkhir}', [DonasiController::class,'cetakProgramDanAkunPertanggal'])->name('cetak.program-akun-pertanggal');
    //Cetak invoice
    Route::get('/cetak-invoice/{id}',[DonasiController::class,'invoice'])->name('donasi.invoice');
    Route::get('/cetak-faktur/{id}',[DonasiController::class,'faktur'])->name('donasi.faktur');

    // Export menggunakan datatables
    Route::get('/export-donasi',[ExportController::class,'exportDonasi'])->name('dropd.exportDonasi');
    Route::get('/export-zakat',[ExportController::class,'exportZakat'])->name('exportZakat');
    Route::get('/export-permintaan-Ambulan',[ExportController::class,'exportPermintaanAmbulan'])->name('exportPermintaanAmbulan');


    // Validasi Donasi
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
    Route::get('/user', [UserController::class, 'index'])->name('dropdo.user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/aktivitas/{id}', [ZakatController::class, 'aktivitas'])->name('aktivitas');

    //Driver
    Route::get('/driver',[DriverController::class,'index'])->name('driver.index');
    Route::post('/driver/store',[DriverController::class,'store'])->name('driver.store');
    Route::post('/driver/update/{id}',[DriverController::class,'update'])->name('driver.update');
    Route::get('/driver/destroy/{id}',[DriverController::class,'destroy'])->name('driver.destroy');

    // Akun
    Route::get('/akun',[AkunController::class, 'index'])->name('akun.index');
    Route::get('/akun/delete/{id}',[AkunController::class, 'destroy'])->name('akun.delete');
    Route::post('/akun',[AkunController::class, 'store'])->name('akun.store');
    Route::post('/akun/update/{id}',[AkunController::class, 'update'])->name('akun.update');
    Route::get('/detile-akun/{id_akun}/program-donasi',[AkunController::class,'programDonasi'])->name('akun.programDonasi');

    // Transaction
    Route::get('/create-transaction', [LogTransaksiController::class,'create'])->name('create.transaction');
    Route::get('/transaction', [LogTransaksiController::class,'index'])->name('d.index.transaction');
    Route::post('/create-transaction', [LogTransaksiController::class,'transferSaldo'])->name('store.transaction');
    Route::get('/deleted-transaction/{id}', [LogTransaksiController::class,'destroy'])->name('destroy.transaksi');
    //Export Perprogram donasi pertanggal
    Route::get('/cetak-transaksi/pertanggal/{tglAwal}/{tglAkhir}',[LogTransaksiController::class,'cetakPertanggalTransaksi'])->name('cetakPertanggalTransaksi.pdf');

    // Dokumentasi
    Route::get('/dokumentasi/index', [DokumentasiController::class, 'index'])->name('dokumentasi.index');
    Route::get('/dokumentasi/create', [DokumentasiController::class, 'create'])->name('dokumentasi.create');
    Route::post('/dokumentasi/post', [DokumentasiController::class, 'store'])->name('dokumentasi.store');
    Route::get('/dokumentasi/show/{id}', [DokumentasiController::class, 'show'])->name('dokumentasi.show');
    Route::get('/dokumentasi/edit/{id}', [DokumentasiController::class, 'edit'])->name('dokumentasi.edit');
    Route::post('/dokumentasi/update/{id}', [DokumentasiController::class, 'update'])->name('dokumentasi.update');
    Route::get('/dokumentasi/destroy/{id}', [DokumentasiController::class, 'destroy'])->name('dokumentasi.destroy');

    //Donatur
    Route::get('/donatur',[DonaturController::class,'index'])->name('donatur.index');
    Route::get('/donatur/edit/{id}',[DonaturController::class,'edit'])->name('donatur.edit');
    Route::post('/donatur/update/{id}',[DonaturController::class,'update'])->name('donatur.update');
    Route::get('/tambah-donatur',[DonaturController::class,'tambah'])->name('donatur.tambah');
    Route::get('/delete-donatur/{id}',[DonaturController::class,'destroy'])->name('donatur.delete');

    // Invoice
    Route::get('/invoice-zis/{id}',[InvoiceController::class,'invoice'])->name('invoice');
    // Route::get('/invoice-pdf/{id}/{user_id}',[InvoiceController::class,'cetakInvoice'])->name('donatur.cetakInvoice');

    // Penyaluran
    Route::get('/data-penyaluran',[PenyaluranController::class,'index'])->name('index.penyaluran');
    Route::get('/salurkan-donasi-program',[PenyaluranController::class,'create'])->name('program.salurkan');
    Route::get('/edit-salurkan-donasi-program/{id}',[PenyaluranController::class,'edit'])->name('edit.salurkan');
    Route::post('/salurkan-donasi-program',[PenyaluranController::class,'store'])->name('store.program.salurkan');
    Route::post('/update-donasi-program/{id}',[PenyaluranController::class,'update'])->name('update.program.salurkan');
    Route::get('/delete-donasi-program/{id}',[PenyaluranController::class,'destroy'])->name('destroy.program.salurkan');
    // Cetak Penyaluran pertanggal
    Route::get('/cetak-penyaluran/pertanggal/{tglAwal}/{tglAkhir}',[PenyaluranController::class,'cetakPertanggalPenyaluran'])->name('cetakPertanggalPenyaluran.pdf');

    // Mustahik
    Route::get('/data-mustahik', [MustahikController::class, 'index'])->name('dropdown.index');
    Route::post('/store-mustahik', [MustahikController::class, 'store'])->name('store.mustahik');
    Route::post('/update-mustahik/{id}', [MustahikController::class, 'update'])->name('update.mustahik');
    Route::get('/destroy-mustahik/{id}', [MustahikController::class, 'destroy'])->name('destroy.mustahik');
});

require __DIR__.'/auth.php';