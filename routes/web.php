<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasAdmin\DashboardAdminController;
use App\Http\Controllers\PetugasAdmin\KeluhanController;
use App\Http\Controllers\PetugasAdmin\RiwayatController;
use App\Http\Controllers\PetugasAdmin\FeedbackController;
use App\Http\Controllers\PetugasAdmin\ProfileController;
use App\Http\Controllers\petugasAdmin\CivilController;
use App\Http\Controllers\PetugasAdmin\MeController;
use App\Http\Controllers\Dept\FormKeluhanController;
use App\Http\Controllers\Dept\RiwayatController as DeptRiwayat;
use App\Http\Controllers\Dept\RiwayatControlle;
use App\Http\Controllers\Dept\ProfileController as DeptProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
]);/*->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});*/

//petugas-admin
Route::get('/dashboard', [DashboardAdminController::class,'index'])->name('dashboard');
Route::get('/keluhan', [KeluhanController::class, 'index'])->name('keluhan');
Route::get('/keluhan/{id}/detail',[KeluhanController::class,'detail'])->name('detail-keluhan');
Route::get('/cetak', [KeluhanController::class,'cetak'])->name('cetak');
Route::get('/keluhan/{id}/edit',[KeluhanController::class,'edit'])->name('edit-keluhan');
Route::post('/keluhan/selesai/{id}', [KeluhanController::class, 'selesai'])->name('keluhan.selesai');
Route::put('/keluhan/{id}',[KeluhanController::class,'update'])->name('update-keluhan');
Route::get('/export-excel', [KeluhanController::class,'exportExcel'])->name('export-excel');
Route::get('/export-pdf', [KeluhanController::class, 'exportPDF'])->name('export-pdf');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::get('/civil', [CivilController::class,'index'])->name('civil');
Route::get('/civil/export-excel', [CivilController::class,'exportExcel'])->name('civil.export-excel');
Route::get('/civil/export-pdf', [CivilController::class,'exportPDF'])->name('civil.export-pdf');
Route::get('/me', [MeController::class, 'index'])->name('me');
Route::get('/me/export-excel', [MeController::class, 'exportExcel'])->name('me.export-excel');
Route::get('/me/export-pdf', [MeController::class, 'exportPDF'])->name('me.export-pdf');

Route::get('/profil', [ProfileController::class,'index'])->name('profil');
Route::get('/edit-profil', [ProfileController::class,'edit'])->name('edit-profil');
Route::post('/update-profil', [ProfileController::class,'update'])->name('update-profil');
Route::get('/riwayat', [RiwayatController::class, 'riwayat'])->name('riwayat');
Route::get('/detail-riwayat/{id}', [RiwayatController::class, 'detail'])->name('detail-riwayat');
Route::delete('/riwayat/{id}/hapus', [RiwayatController::class, 'destroy'])->name('riwayat-hapus');
Route::post('/edit-profil', function () {
    return redirect()->back()->with('success','Data berhasil disimpan');
});

//department
Route::get('/index', [DeptRiwayat::class, 'index'])->name('index');
Route::get('/home', function () {
        return view('department.home');
})->name('home');
Route::get('/homee', function () {
        return view('department.homee');
})->name('homee');
Route::post('/form', [FormKeluhanController::class, 'store'])
    ->name('form.store');
Route::get('/form', function () {
    return view('department.form');
})->name('form');
Route::get('/detail/{id}', [DeptRiwayat::class, 'detail'])->name('detail');
Route::get('/profil-dept', [DeptProfileController::class, 'index'])->name('profil-dept');
Route::post('/notif-on', [DeptProfileController::class, 'notifOn'])->name('notif.on');
Route::post('/notif-off', [DeptProfileController::class, 'notifOff'])->name('notif.off');
Route::get('/profil-edit', [DeptProfileController::class, 'edit'])->name('profil-edit');
Route::post('/profil-update', [DeptProfileController::class, 'update'])->name('profil.update');
