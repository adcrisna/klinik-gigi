<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PetugasController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::any('/', [IndexController::class, 'index'])->name('index');
Route::any('/about', [IndexController::class, 'about'])->name('about');
Route::any('/pdf/{id}', [IndexController::class, 'pdf'])->name('pdf');
Route::any('/service', [IndexController::class, 'service'])->name('service');
Route::any('/login', [AuthController::class, 'login'])->name('login');
Route::any('/proses_login', [AuthController::class, 'prosesLogin'])->name('prosesLogin');
Route::any('/register', [AuthController::class, 'register'])->name('register');
Route::any('/proses_register', [AuthController::class, 'prosesRegister'])->name('prosesRegister');
Route::any('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::any('/home', [AdminController::class, 'index'])->name('admin.index');
        Route::any('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::any('/update_profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
        Route::any('/klinik', [AdminController::class, 'klinik'])->name('admin.klinik');
        Route::any('/add_klinik', [AdminController::class, 'addKlinik'])->name('admin.addKlinik');
        Route::any('/update_klinik', [AdminController::class, 'updateKlinik'])->name('admin.updateKlinik');
        Route::any('/delete_klinik/{id}', [AdminController::class, 'deleteKlinik'])->name('admin.deleteKlinik');
        Route::any('/dokter', [AdminController::class, 'dokter'])->name('admin.dokter');
        Route::any('/add_dokter', [AdminController::class, 'addDokter'])->name('admin.addDokter');
        Route::any('/update_dokter', [AdminController::class, 'updateDokter'])->name('admin.updateDokter');
        Route::any('/delete_dokter/{id}', [AdminController::class, 'deleteDokter'])->name('admin.deleteDokter');
        Route::any('/petugas', [AdminController::class, 'petugas'])->name('admin.petugas');
        Route::any('/add_petugas', [AdminController::class, 'addPetugas'])->name('admin.addPetugas');
        Route::any('/update_petugas', [AdminController::class, 'updatePetugas'])->name('admin.updatePetugas');
        Route::any('/delete_petugas/{id}', [AdminController::class, 'deletePetugas'])->name('admin.deletePetugas');
        Route::any('/pasien', [AdminController::class, 'pasien'])->name('admin.pasien');
        Route::any('/add_pasien', [AdminController::class, 'addPasien'])->name('admin.addPasien');
        Route::any('/update_pasien', [AdminController::class, 'updatePasien'])->name('admin.updatePasien');
        Route::any('/delete_pasien/{id}', [AdminController::class, 'deletePasien'])->name('admin.deletePasien');
        Route::any('/service', [AdminController::class, 'service'])->name('admin.service');
        Route::any('/add_service', [AdminController::class, 'addService'])->name('admin.addService');
        Route::any('/update_service', [AdminController::class, 'updateService'])->name('admin.updateService');
        Route::any('/delete_service/{id}', [AdminController::class, 'deleteService'])->name('admin.deleteService');
        Route::any('/order', [AdminController::class, 'order'])->name('admin.order');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('dokter')->middleware(['dokter'])->group(function () {
        Route::any('/home', [DokterController::class, 'index'])->name('dokter.index');
        Route::any('/perawatan', [DokterController::class, 'perawatan'])->name('dokter.perawatan');
        Route::any('/perawatan_detail/{id}', [DokterController::class, 'perawatanDetail'])->name('dokter.perawatanDetail');
        Route::any('/perawatan_selesai', [DokterController::class, 'perawatanSelesai'])->name('dokter.perawatanSelesai');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('pasien')->middleware(['pasien'])->group(function () {
        Route::any('/home', [PasienController::class, 'index'])->name('pasien.index');
        Route::any('/profile', [PasienController::class, 'profile'])->name('pasien.profile');
        Route::any('/update_profile', [PasienController::class, 'updateProfile'])->name('pasien.updateProfile');
        Route::any('/about', [PasienController::class, 'about'])->name('pasien.about');
        Route::any('/service', [PasienController::class, 'service'])->name('pasien.service');
        Route::any('/booking', [PasienController::class, 'booking'])->name('pasien.booking');
        Route::any('/history', [PasienController::class, 'history'])->name('pasien.history');
        Route::any('/cek_jam', [PasienController::class, 'cekJam'])->name('pasien.cekJam');
        Route::any('/cek_booking', [PasienController::class, 'cekBooking'])->name('pasien.cekBooking');
        Route::any('/order', [PasienController::class, 'order'])->name('pasien.order');
        Route::any('/delete_booking/{id}', [PasienController::class, 'deleteBooking'])->name('pasien.deleteBooking');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('petugas')->middleware(['petugas'])->group(function () {
        Route::any('/home', [PetugasController::class, 'index'])->name('petugas.index');
        Route::any('/booking', [PetugasController::class, 'booking'])->name('petugas.booking');
        Route::any('/payment', [PetugasController::class, 'payment'])->name('petugas.payment');
        Route::any('/konfirmasi/{id}', [PetugasController::class, 'konfirmasi'])->name('petugas.konfirmasi');
        Route::any('/hapus/{id}', [PetugasController::class, 'hapus'])->name('petugas.hapus');
        Route::any('/cancel', [PetugasController::class, 'cancel'])->name('petugas.cancel');
        Route::any('/save_payment', [PetugasController::class, 'savePayment'])->name('petugas.savePayment');
    });
});
