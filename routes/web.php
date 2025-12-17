<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Kategori_pengaduanController;

Route::get('/', function () {
    return view('pages.Auth.login');
});

#Route::get('/home',[HomeController::class,'index']);

//halaman login
Route::get('Auth/login', [AuthController::class, 'index'])->name('Auth.index');
Route::get('Auth/regis', [AuthController::class, 'regis'])->name('Auth.regis');
Route::post('Auth/store', [AuthController::class, 'store'])->name('Auth.store');
// Route untuk memproses Register (ketika tombol Daftar ditekan)
Route::post('Auth/register/store', [AuthController::class, 'storeRegister'])->name('Auth.regist');
// Route::resource('Auth', AuthController::class);

// Jika ini route untuk MEMPROSES data registrasi (biasanya POST)
Route::post('/register', [AuthController::class, 'storeRegister'])->name('Auth.regist');

// ATAU

// Jika ini route untuk MENAMPILKAN halaman formulir daftar (biasanya GET)
Route::get('/register', [AuthController::class, 'indexRegister'])->name('Auth.regist');

//route ke halaman home
Route::get('/home', [HomeController::class, 'index'])->name('Home.index');

//route ke halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//route controller warga
Route::resource('warga', WargaController::class);

//route controller kategori_pengaduan
Route::resource('kategori_pengaduan',Kategori_pengaduanController::class);

//route controller user
Route::resource('user', UserController::class);

//route controller pengaduan
Route::resource('Pengaduan',PengaduanController::class);

//route controller media
Route::post('/media/store', [MediaController::class, 'store'])->name('media.store');
Route::delete('/media/destroy/{id}', [MediaController::class, 'destroy'])->name('media.destroy');

//route middleware
  Route::group(['middleware' => ['checkrole:admin']], function () {
        Route::resource('user', UserController::class);
    });

      Route::group(['middleware' => ['checkrole:kades']], function () {
        Route::resource('user', UserController::class);
    });

   //route profil
   Route::resource('profil', ProfilController::class);
