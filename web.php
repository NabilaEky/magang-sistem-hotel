<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

// PETUGAS
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\KeluhanController;
use App\Http\Controllers\Petugas\LaporanEngController;
use App\Http\Controllers\Petugas\RiwayatController as EngRiwayat;
use App\Http\Controllers\Petugas\PetugasEngController;

// CUSTOMER
use App\Http\Controllers\Customer\HomeCustController;
use App\Http\Controllers\Customer\KeluhanCustController;
use App\Http\Controllers\Customer\HistoryController;
use App\Http\Controllers\Customer\FormCustController;
use App\Http\Controllers\Customer\DetailCustController;

// ADMIN
use App\Http\Controllers\PetugasAdmin\DashboardAdminController;
use App\Http\Controllers\PetugasAdmin\KeluhanController as AdminKeluhan;
use App\Http\Controllers\PetugasAdmin\RiwayatController as AdminRiwayat;
use App\Http\Controllers\PetugasAdmin\FeedbackController;
use App\Http\Controllers\PetugasAdmin\ProfileController;
use App\Http\Controllers\PetugasAdmin\CivilController;
use App\Http\Controllers\PetugasAdmin\MeController;

// DEPT
use App\Http\Controllers\Dept\FormKeluhanController;
use App\Http\Controllers\Dept\RiwayatController as DeptRiwayat;
use App\Http\Controllers\Dept\ProfileController as DeptProfileController;

/*
|--------------------------------------------------------------------------
| DEFAULT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| PETUGAS (ENG)
|--------------------------------------------------------------------------
*/

Route::prefix('petugas')->name('petugas.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Keluhan
    Route::get('/keluhan', [KeluhanController::class, 'index'])->name('daftar-keluhan');
    Route::get('/keluhan/{id}', [KeluhanController::class, 'show'])->name('detail-keluhan');
    Route::put('/keluhan/{id}', [KeluhanController::class, 'update'])->name('update-keluhan');

    Route::put('/kerjakan/{id}', [KeluhanController::class, 'kerjakan'])->name('kerjakan');
    Route::post('kerjakan/{id}', [KeluhanController::class, 'kerjakan'])->name('kerjakan');

    Route::get('/selesai/{id}', [KeluhanController::class, 'formSelesai'])->name('selesai.form');
    Route::put('/selesai/{id}', [KeluhanController::class, 'selesai'])->name('selesai');

    // Laporan
    Route:: prefix('laporan')->group(function () {
        Route::get('/', [LaporanEngController::class, 'index'])->name('laporan');
        Route::post('/', [LaporanEngController::class, 'store'])->name('store-laporan');
        Route::get('/create', [LaporanEngController::class, 'create'])->name('tambah-laporan'); 
        Route::get('/{id}', [LaporanEngController::class, 'show'])->name('detail-laporan');
        Route::get('/{id}/edit', [LaporanEngController::class, 'edit'])->name('edit-laporan');
        Route::put('/{id}', [LaporanEngController::class, 'update'])->name('update-laporan');
        Route::delete('/{id}', [LaporanEngController::class, 'destroy'])->name('hapus-laporan');
    });

    // Riwayat
    Route::get('/riwayat', [EngRiwayat::class, 'index'])->name('riwayat');
    Route::get('/riwayat/{id}', [EngRiwayat::class, 'show'])->name('detail-riwayat');

    // Profile
    Route::get('/profile', [PetugasEngController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [PetugasEngController::class, 'editProfile'])->name('edit-profile');
    Route::post('/update-profile', [PetugasEngController::class, 'updateProfile'])->name('update-profile');
    Route::post('/toggle-notif', [PetugasEngController::class, 'toggleNotif'])->name('toggle-notif');
});

/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::prefix('customer')->name('customer.')->group(function () {

    Route::get('/home', [HomeCustController::class, 'home'])->name('home');
    Route::get('/menu', [HomeCustController::class, 'homee'])->name('homee');

    Route::get('/form', [FormCustController::class, 'create'])->name('form');
    Route::post('/form', [FormCustController::class, 'store'])->name('form.store');

    Route::get('/history', [HistoryController::class, 'history'])->name('history');

    Route::delete('/delete/{id}', [KeluhanCustController::class, 'delete'])->name('delete');
    Route::get('/detail/{id}', [DetailCustController::class, 'show'])->name('detail');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardAdminController::class,'index'])->name('dashboard');

    Route::get('/keluhan', [AdminKeluhan::class, 'index'])->name('keluhan');
    Route::get('/keluhan/{id}/detail', [AdminKeluhan::class,'detail'])->name('detail-keluhan');
    Route::get('/keluhan/{id}/edit', [AdminKeluhan::class,'edit'])->name('edit-keluhan');

    Route::put('/keluhan/{id}', [AdminKeluhan::class,'update'])->name('update-keluhan');
    Route::post('/keluhan/selesai/{id}', [AdminKeluhan::class, 'selesai'])->name('keluhan.selesai');

    Route::get('/cetak', [AdminKeluhan::class,'cetak'])->name('cetak');
    Route::get('/export-excel', [AdminKeluhan::class,'exportExcel'])->name('export-excel');
    Route::get('/export-pdf', [AdminKeluhan::class, 'exportPDF'])->name('export-pdf');

    // Riwayat
    Route::get('/riwayat', [AdminRiwayat::class, 'riwayat'])->name('riwayat');
    Route::get('/riwayat/{id}', [AdminRiwayat::class, 'detail'])->name('detail-riwayat');
    Route::delete('/riwayat/{id}', [AdminRiwayat::class, 'destroy'])->name('riwayat-hapus');

    // Lainnya
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
    Route::get('/civil', [CivilController::class,'index'])->name('civil');
    Route::get('/civil/export-excel', [CivilController::class,'exportExcel'])->name('civil.export-excel');
    Route::get('/civil/export-pdf', [CivilController::class,'exportPDF'])->name('civil.export-pdf');

    Route::get('/me', [MeController::class, 'index'])->name('me');
    Route::get('/me/export-excel', [MeController::class, 'exportExcel'])->name('me.export-excel');
    Route::get('/me/export-pdf', [MeController::class, 'exportPDF'])->name('me.export-pdf');

    // Profile
    Route::get('/profil', [ProfileController::class,'index'])->name('profil');
    Route::get('/edit-profil', [ProfileController::class,'edit'])->name('edit-profil');
    Route::post('/update-profil', [ProfileController::class,'update'])->name('update-profil');
});

/*
|--------------------------------------------------------------------------
| DEPARTMENT
|--------------------------------------------------------------------------
*/

Route::prefix('dept')->name('dept.')->group(function () {

    Route::get('/index', [DeptRiwayat::class, 'index'])->name('index');

    Route::get('/home', fn() => view('department.home'))->name('home');
    Route::get('/homee', fn() => view('department.homee'))->name('homee');

    Route::get('/form', fn() => view('department.form'))->name('form');
    Route::post('/form', [FormKeluhanController::class, 'store'])->name('form.store');

    Route::get('/detail/{id}', [DeptRiwayat::class, 'detail'])->name('detail');

    Route::get('/profil', [DeptProfileController::class, 'index'])->name('profil-dept');
    Route::get('/profil-edit', [DeptProfileController::class, 'edit'])->name('profil-edit');
    Route::post('/profil-update', [DeptProfileController::class, 'update'])->name('profil.update');

    Route::post('/notif-on', [DeptProfileController::class, 'notifOn'])->name('notif.on');
    Route::post('/notif-off', [DeptProfileController::class, 'notifOff'])->name('notif.off');
});