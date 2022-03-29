<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UbahPwController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('prosseslogin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/post', PostController::class);
    Route::resource('/project', ProjectController::class);
    Route::post('/uploadgambar', [UploadController::class, 'upload'])->name('uploadgambar');
    Route::post('/deletegambar', [UploadController::class, 'delete'])->name('deletegambar');
    Route::get('coba', [UploadController::class, 'index']);
    Route::resource('kategori', KategoriController::class);
    Route::resource('/gallery', GalleryController::class);
    Route::middleware(['siswa'])->group(function () {
        Route::resource('/anggota', AnggotaController::class);
    });
    Route::get('profil', [DashboardController::Class, 'profil'])->name('profil');
    Route::post('ubahprofil', [DashboardController::Class, 'ubahprofil'])->name('ubahprofil');
    Route::get('ubahpassword', [UbahPwController::Class, 'ubahpw'])->name('ubahpassword');
    Route::post('pubahpassword', [UbahPwController::Class, 'prosesubahpw'])->name('pubahpassword');
});
