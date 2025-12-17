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

//halaman login dan register
Route::get('Auth/login', [AuthController::class, 'index'])->name('Auth.index');
Route::get('Auth/regis', [AuthController::class, 'regis'])->name('Auth.regis');
Route::post('Auth/store', [AuthController::class, 'store'])->name('Auth.store');
// Route untuk memproses Register (ketika tombol Daftar ditekan)
Route::post('Auth/register/store', [AuthController::class, 'storeRegister'])->name('Auth.regist');


// GROUP Route yang butuh Login
Route::middleware(['auth'])->group(function () {

    // 1. Dashboard (Semua Role bisa akses)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. KHUSUS ADMIN (User Management Full Akses)
    Route::group(['middleware' => ['checkrole:admin']], function () {
        Route::resource('user', UserController::class);
    });

    // 3. ADMIN & STAFF (Hak Akses Menulis Data)
    // Create, Store, Edit, Update, Destroy (Kades TIDAK BOLEH masuk sini)
    Route::group(['middleware' => ['checkrole:admin,staff']], function () {
        // Kita gunakan 'except' index & show, karena index & show akan didefinisikan di group bawah
        Route::resource('warga', WargaController::class)->except(['index', 'show']);
        Route::resource('kategori_pengaduan', Kategori_pengaduanController::class)->except(['index', 'show']);
        Route::resource('Pengaduan', PengaduanController::class)->except(['index', 'show']);

        // Media (Hapus/Tambah)
        Route::post('/media/store', [MediaController::class, 'store'])->name('media.store');
        Route::delete('/media/destroy/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
    });

    // 4. ADMIN, STAFF, & KADES (Hak Akses Membaca Data)
    // Index (Lihat Tabel) & Show (Lihat Detail)
    Route::group(['middleware' => ['checkrole:admin,staff,kades']], function () {
        // Kita gunakan 'only' index & show
        Route::resource('warga', WargaController::class)->only(['index', 'show']);
        Route::resource('kategori_pengaduan', Kategori_pengaduanController::class)->only(['index', 'show']);
        Route::resource('Pengaduan', PengaduanController::class)->only(['index', 'show']);
    });

});




   //route profil
   Route::resource('profil', ProfilController::class);
