<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\KeluhanController;
use App\Http\Controllers\Petugas\LaporanEngController;
use App\Http\Controllers\Petugas\RiwayatController;
use App\Http\Controllers\Petugas\PetugasEngController;

use App\Http\Controllers\Customer\HomeCustController;
use App\Http\Controllers\Customer\HomeeCustController;
use App\Http\Controllers\Customer\KeluhanCustController;
use App\Http\Controllers\Customer\HistoryController;
use App\Http\Controllers\Customer\FormCustController;
use App\Http\Controllers\Customer\DetailCustController;


Route::get('/', function () {
    return view('welcome');
});

//jetstream
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',

// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//PETUGAS ENG
Route::get('/petugas/dashboard', function () {
    return view('petugas-eng.dashboard');
})->name('petugas.dashboard'); //PETUGAS ENG-dashboard
Route::get('/petugas/laporan', [LaporanEngController::class, 'index'])
    ->name('petugas.laporan');
Route::get('/petugas/tambah-laporan', function () {
    return view('petugas-eng.tambah-laporan');
})->name('petugas.tambah-laporan'); //PETUGAS ENG-tambah laporan
Route::get('/petugas/profile', function () {
    return view('petugas-eng.profile');
})->name('petugas.profile'); //PETUGAS ENG-profil
Route::get('/petugas/edit-profile', function () {
    return view('petugas-eng.edit-profile');
})->name('petugas.edit-profile'); //PETUGAS ENG-edit profil
Route::get('/petugas/laporan', [LaporanEngController::class, 'index'])
    ->name('petugas.laporan');
//Petugas Controller
// Route::middleware(['auth'])->group(function () {
Route::get('/petugas/dashboard', [DashboardController::class, 'index']) //dashboard
    ->name('petugas.dashboard');

Route::get('/petugas/keluhan', [KeluhanController::class, 'index']) //detail keluhan
    ->name('petugas.daftar-keluhan');
Route::get('/petugas/keluhan/{id}', [KeluhanController::class, 'show'])
    ->name('petugas.detail-keluhan');
Route::put('/petugas/keluhan/{id}', [KeluhanController::class, 'update'])
    ->name('petugas.update-keluhan');

Route::get('/petugas/keluhan', [KeluhanController::class, 'index']) //daftar keluhan
    ->name('petugas.daftar-keluhan');
Route::get('/petugas/daftar-keluhan', [KeluhanController::class, 'index'])
    ->name('petugas.daftar-keluhan');
Route::get('/petugas/keluhan/{id}', [KeluhanController::class, 'show'])
    ->name('petugas.detail-keluhan');
Route::put('/petugas/keluhan/{id}', [KeluhanController::class, 'update'])
    ->name('petugas.update-keluhan');
Route::put('/petugas/kerjakan/{id}', [KeluhanController::class, 'kerjakan'])
    ->name('petugas.kerjakan');
Route::get('/petugas/selesai/{id}', [KeluhanController::class, 'formSelesai'])
    ->name('petugas.selesai.form');
Route::put('/petugas/selesai/{id}', [KeluhanController::class, 'selesai'])
    ->name('petugas.selesai');

// Laporan proker
Route::prefix('petugas/laporan')->group(function () {
Route::get('/', [LaporanEngController::class, 'index'])
    ->name('petugas.laporan');
Route::post('/', [LaporanEngController::class, 'store'])
    ->name('petugas.store-laporan');
Route::get('/{id}', [LaporanEngController::class, 'show'])
    ->name('petugas.detail-laporan');
Route::get('/{id}/edit', [LaporanEngController::class, 'edit'])
    ->name('petugas.edit-laporan');
Route::put('/{id}', [LaporanEngController::class, 'update'])
    ->name('petugas.update-laporan');
Route::delete('/{id}', [LaporanEngController::class, 'destroy'])
    ->name('petugas.hapus-laporan');
});


//Riwayat
// Route::middleware(['auth'])->group(function () {
Route::get('/riwayat', [RiwayatController::class, 'index'])
    ->name('petugas.riwayat');
Route::get('/riwayat/{id}', [RiwayatController::class, 'show'])
    ->name('petugas.detail-riwayat');
Route::get('/riwayat/{id}', [RiwayatController::class, 'show'])
    ->name('petugas.riwayat.detail');
// });

//Profil
// Route::middleware(['auth'])->group(function () {

    Route::get('/petugas/profile', [PetugasEngController::class, 'profile'])
        ->name('petugas.profile');

    Route::get('/petugas/edit-profile', [PetugasEngController::class, 'editProfile'])
        ->name('petugas.edit-profile');

    Route::post('/petugas/update-profile', [PetugasEngController::class, 'updateProfile'])
        ->name('petugas.update-profile');

// });

//customer
// Route::get('/customer/home', function () {
//     return view('customer.home');
// });
// Route::get('/customer/homee', function () {
//     return view('customer.homee');
// });
// Route::get('/customer/form', function () {
//     return view('customer.form');
// });
// Route::get('/customer/history', function () {
//     return view('customer.history');
// })->name('customer.history');
// Route::get('/customer/detail', function () {
//     return view('customer.detail');
// })->name('customer.detail');

//customer controller
//Route::prefix('customer')->middleware(['auth'])->group(function () {
// Route::prefix('customer')->name('customer.')->group(function () {
// //home
// Route::get('/home', [HomeCustController::class, 'home'])
//     ->name('customer.home');
// Route::get('/menu', [HomeCustController::class, 'homee'])
//     ->name('customer.homee');
// //form
// Route::get('/customer/form', [FormCustController::class, 'create'])
//     ->name('customer.form');
// Route::post('/customer/form', [FormCustController::class, 'store'])
//     ->name('customer.form.store');
// Route::get('/menu', [HomeCustController::class, 'homee'])
//     ->name('customer.homee');
// //histori 
// Route::get('/customer/history', [HistoryController::class, 'history']) //kembali
//     ->name('customer.history');
// Route::get('/customer/history', [KeluhanCustController::class, 'history'])
//     ->name('customer.history');
// Route::post('/store', [KeluhanCustController::class, 'store'])
//     ->name('customer.store');
// Route::delete('/customer/delete/{id}', [KeluhanCustController::class, 'delete'])
//     ->name('customer.delete');
// Route::get('/customer/history',[HistoryController::class, 'history'])->name('customer.history');

// //detail
// Route::get('/customer/detail/{id}', [DetailCustController::class, 'show'])
//     ->name('customer.detail');
// });

Route::prefix('customer')->name('customer.')->group(function () {
    // HOME
    Route::get('/home', [HomeCustController::class, 'home'])
        ->name('home');
    Route::get('/menu', [HomeCustController::class, 'homee'])
        ->name('homee');
    // FORM (❗ HAPUS /customer DI SINI)
    Route::get('/form', [FormCustController::class, 'create'])
        ->name('form');
    Route::post('/form', [FormCustController::class, 'store'])
        ->name('form.store');
    // HISTORY (❗ CUMA 1, JANGAN DUPLIKAT)
    Route::get('/history', [HistoryController::class, 'history'])
        ->name('history');
    // DELETE
    Route::delete('/delete/{id}', [KeluhanCustController::class, 'delete'])
        ->name('delete');
    // DETAIL
    Route::get('/detail/{id}', [DetailCustController::class, 'show'])
        ->name('detail');

});