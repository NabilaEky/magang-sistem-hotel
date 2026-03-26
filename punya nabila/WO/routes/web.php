<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\KeluhanController;
use App\Http\Controllers\SuperAdmin\PetugasController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\LokasiController;
use App\Http\Controllers\SuperAdmin\DepartementController;
use App\Http\Controllers\SuperAdmin\KategoriController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\RiwayatController;
use App\Http\Controllers\SuperAdmin\UserManagementController;
use App\Http\Controllers\SuperAdmin\AuditLogController;
use App\Http\Controllers\SuperAdmin\SystemSettingController;
use App\Http\Controllers\SuperAdmin\SettingController;
use App\Http\Controllers\SuperAdmin\JabatanController;
use App\Http\Controllers\SuperAdmin\MasterDataController;
use App\Http\Controllers\SuperAdmin\RoleController;
# ===============================
# LOGIN ROLE
# ===============================
Route::get('/{role}/login', function ($role) {
    $allowed = ['super-admin', 'admin', 'customer', 'dept', 'petugas'];

    if (!in_array($role, $allowed)) {
        abort(404);
    }

    session()->forget('login_role');
    session(['login_role' => str_replace('-', '_', $role)]);

    return view('auth.login', ['role' => $role]);
});

# ===============================
# SUPER ADMIN (PROTEKSI)
# ===============================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:super_admin'
])
    ->prefix('super-admin')
    ->name('superadmin.')
    ->group(function () {

        # Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware(['auth', 'verified', 'role:super_admin'])
            ->name('dashboard');

        # Daftar Keluhan (resource)
        Route::resource('daftar-keluhan', KeluhanController::class);

        # Riwayat
        Route::get('/riwayat', [RiwayatController::class, 'index'])
            ->name('riwayat');

        Route::get('/riwayat/{id}', function ($id) {
            return view('super-admin.riwayat.detail-riwayat');
        })->name('riwayat.detail');

        # Menyimpan password baru
        Route::post(
            '/petugas/{id}/reset-password',
            [PetugasController::class, 'updatePassword']
        )->name('petugas.update-password');

        # Membuka halaman reset password
        Route::get(
            '/petugas/{id}/reset-password',
            [PetugasController::class, 'resetPassword']
        )->name('petugas.reset');

        #user-role
        Route::resource('user-role', UserManagementController::class);
        Route::resource('roles', RoleController::class)->names([
            'index' => 'roles.index',
            'create' => 'roles.create',
            'store' => 'roles.store',
            'edit' => 'roles.edit',
            'update' => 'roles.update',
            'destroy' => 'roles.destroy',
        ]);

        Route::resource('petugas', PetugasController::class)->names([
            'index' => 'petugas.index',
            'create' => 'petugas.create',
            'store' => 'petugas.store',
            'edit' => 'petugas.edit',
            'update' => 'petugas.update',
            'destroy' => 'petugas.destroy',
            'show' => 'petugas.show',
        ]);

        Route::post('petugas/{petugas}/selesai', [PetugasController::class, 'tugasSelesai'])->name('superadmin.petugas.selesai');

        #manajemen-user
        Route::resource('user-management', UserManagementController::class);

        # Master Data
        Route::get('/master-data', [MasterDataController::class, 'index'])
            ->name('master-data.index');

        Route::get('/master-data/{tipe}/{id}/edit', [MasterDataController::class, 'edit'])
            ->name('master-data.edit');
            
        Route::put('/master-data/{tipe}/{id}', [MasterDataController::class, 'update'])
            ->name('master-data.update');

        Route::delete('/master-data/{tipe}/{id}', [MasterDataController::class, 'destroy'])
            ->name('master-data.destroy');

        # Departement
        Route::get('departement', [DepartementController::class, 'index'])->name('departement.index');
        Route::get('departement/create', [DepartementController::class, 'create'])->name('departement.create');
        Route::post('departement/store', [DepartementController::class, 'store'])->name('departement.store');

        #Kategori
        Route::prefix('kategori')->name('kategori.')->group(function () {
            Route::get('create', [KategoriController::class, 'create'])->name('create');
            Route::post('', [KategoriController::class, 'store'])->name('store');
        });

        # Lokasi
        Route::prefix('lokasi')->name('lokasi.')->group(function () {
            Route::get('create', [LokasiController::class, 'create'])->name('create');
            Route::post('', [LokasiController::class, 'store'])->name('store');
        });

        # Jabatan
        Route::prefix('jabatan')->name('jabatan.')->group(function () {
            Route::get('create', [JabatanController::class, 'create'])->name('create');
            Route::post('', [JabatanController::class, 'store'])->name('store');
        });

        // Audit Log
        Route::get('audit-log', [AuditLogController::class, 'index'])
            ->name('audit-log.index');;

        // Laporan
        Route::get('laporan', [\App\Http\Controllers\SuperAdmin\LaporanController::class, 'index'])
            ->name('laporan.index');

        // User Setting
        Route::get('setting', [SettingController::class, 'index'])
            ->name('setting.index'); // halaman utama setting

        Route::get('setting/edit-profile', [SettingController::class, 'editProfile'])
            ->name('setting.edit-profile'); // tombol edit profil

        Route::post('setting/update-profile', [SettingController::class, 'updateProfile'])
            ->name('setting.update-profile'); // simpan perubahan profil

        Route::post('setting/update-notification', [SettingController::class, 'updateNotification'])
            ->name('setting.update-notification');

        // System Setting (global, terpisah)
        Route::get('system-setting', [SystemSettingController::class, 'index'])
            ->name('system-setting.index');

        Route::post('system-setting', [SystemSettingController::class, 'store'])
            ->name('system-setting.store');
    });
