<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Kategori_pengaduanController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

#Route::get('/home',[HomeController::class,'index']);

//halaman login
Route::get('Auth/login', [AuthController::class, 'index'])->name('Auth.index');
Route::get('Auth/regis', [AuthController::class, 'regis'])->name('Auth.regis');
Route::post('Auth/store', [AuthController::class, 'store'])->name('Auth.store');


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

