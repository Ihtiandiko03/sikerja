<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BKMPController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BentukKegiatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TelaahKerjasamaController;
use App\Http\Controllers\KlasifikasiMitraController;
use App\Http\Controllers\RepositoryKerjasamaController;
use App\Http\Controllers\MonitoringTelaahKerjasamaController;
use App\Http\Controllers\UserController;

Route::get('/', [LoginController::class, 'halamanutama'])->name('halamanutama');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login/callback', [LoginController::class, 'callback']);
Route::get('/restricted_page', [LoginController::class, 'restrictedPage'])->name('restricted_page');
Route::get('/login/restricted_page', [LoginController::class, 'restrictedPage'])->name('restricted_page');
Route::get('/not_found', [LoginController::class, 'notFound'])->name('not_found');
Route::get('/logout', [LoginController::class, 'signout'])->name('logout');

Route::middleware(['role:admin,user'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Telaah Kerjasama
Route::middleware(['role:admin,user'])
  ->prefix('telaah-kerja-sama')
  ->group(function () {
    Route::get('/', [TelaahKerjasamaController::class, 'index'])->name('telaah-kerja-sama');
    Route::get('/create', [TelaahKerjasamaController::class, 'create'])->name('telaah-kerja-sama.create');
    Route::post('/store', [TelaahKerjasamaController::class, 'store'])->name('telaah-kerja-sama.store');
    Route::get('/delete/{id}', [TelaahKerjasamaController::class, 'delete'])->name('telaah-kerja-sama.delete');
  });

Route::middleware(['role:admin'])
  ->prefix('telaah-kerja-sama')
  ->group(function () {
    Route::put('/{id}/validasi', [TelaahKerjasamaController::class, 'validasi'])->name('telaah-kerja-sama.validasi');
  });

Route::middleware(['role:admin'])
  ->prefix('user')
  ->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
  });

Route::middleware(['role:user'])
  ->prefix('telaah-kerja-sama')
  ->group(function () {
    Route::get('/{id}/edit', [TelaahKerjasamaController::class, 'edit'])->name('telaah-kerja-sama.edit');
    Route::put('/{id}/revisi', [TelaahKerjasamaController::class, 'revisi'])->name('telaah-kerja-sama.revisi');
  });

Route::middleware(['role:admin,user'])
  ->prefix('monitoring-telaah-kerja-sama')
  ->group(function () {
    Route::get('/', [MonitoringTelaahKerjasamaController::class, 'index'])->name('monitoring-telaah-kerja-sama');
    Route::get('/detail/{id}', [MonitoringTelaahKerjasamaController::class, 'show'])->name(
      'monitoring-telaah-kerja-sama.show'
    );
  });

Route::middleware(['role:admin,user'])
  ->prefix('repository-kerja-sama')
  ->group(function () {
    Route::get('/', [RepositoryKerjasamaController::class, 'index'])->name('repository-kerja-sama.index');
    Route::get('/create', [RepositoryKerjasamaController::class, 'create'])->name('repository-kerja-sama.create');
    Route::post('/store', [RepositoryKerjasamaController::class, 'store'])->name('repository-kerja-sama.store');
    Route::get('/detail/{id}', [RepositoryKerjasamaController::class, 'show'])->name('repository-kerja-sama.show');
    Route::get('/{id}/edit', [RepositoryKerjasamaController::class, 'edit'])->name('repository-kerja-sama.edit');
    Route::put('/{id}/update', [RepositoryKerjasamaController::class, 'update'])->name('repository-kerja-sama.update');
    Route::delete('/{id}/delete', [RepositoryKerjasamaController::class, 'delete'])->name(
      'repository-kerja-sama.delete'
    );
  });

Route::middleware(['role:admin'])->group(function () {
  Route::resource('klasifikasi-mitra', KlasifikasiMitraController::class);
  Route::resource('bentuk-kegiatan', BentukKegiatanController::class);
});

Route::prefix('bkmp')->group(function () {
  Route::get('/validasi-telaah-kerja-sama', [BKMPController::class, 'validasiTelaah'])->name('bkmp.validasitelaah');
  Route::put('/store-validasi-telaah-kerja-sama', [BKMPController::class, 'storeValidasiTelaah'])->name(
    'bkmp.storevalidasitelaah'
  );
});

Route::get('/login/user', function () {
  Session::flush();
  $userData = [
    'id' => 'PEG001',
    'name' => 'Mulyono S.Kom',
    'role_kerja' => 'user',
    'is_login' => true,
  ];

  Session::put($userData);
  return Session::all();
});

Route::get('/login/admin', function () {
  Session::flush();
  $userData = [
    'id' => 'PEG002',
    'name' => 'Joko S.Kom',
    'role_kerja' => 'admin',
    'is_login' => true,
  ];

  Session::put($userData);
  return Session::all();
});
