<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('user', [UserController::class, 'index'])->middleware(['role:admin'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->middleware(['role:admin'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->middleware(['role:admin'])->name('user.store');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->middleware(['role:admin'])->name('user.edit');
    Route::put('user/{id}', [UserController::class, 'update'])->middleware(['role:admin'])->name('user.update');
    Route::get('user/show/{id}',[UserController::class,'show'])->middleware(['role:admin'])->name('user.show');
    Route::delete('user/{id}',[UserController::class, 'destroy'])->middleware(['role:admin'])->name('user.delete');

    Route::get('kategori', [KategoriController::class, 'index'])->middleware(['role:admin'])->name('kategori.index');
    Route::get('kategori/create', [KategoriController::class, 'create'])->middleware(['role:admin'])->name('kategori.create');
    Route::post('kategori/store', [KategoriController::class, 'store'])->middleware(['role:admin'])->name('kategori.store');
    Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->middleware(['role:admin'])->name('kategori.edit');
    Route::put('kategori/{id}', [KategoriController::class, 'update'])->middleware(['role:admin'])->name('kategori.update');
    Route::get('kategori/show/{id}',[KategoriController::class,'show'])->middleware(['role:admin'])->name('kategori.show');
    Route::delete('kategori/{id}',[KategoriController::class, 'destroy'])->middleware(['role:admin'])->name('kategori.delete');

    Route::get('menu', [MenuController::class, 'index'])->middleware(['role:admin'])->name('menu.index');
    Route::get('menu/create', [MenuController::class, 'create'])->middleware(['role:admin'])->name('menu.create');
    Route::post('menu/store', [MenuController::class, 'store'])->middleware(['role:admin'])->name('menu.store');
    Route::get('menu/edit/{id}', [MenuController::class, 'edit'])->middleware(['role:admin'])->name('menu.edit');
    Route::put('menu/{id}', [MenuController::class, 'update'])->middleware(['role:admin'])->name('menu.update');
    Route::get('menu/show/{id}',[MenuController::class,'show'])->middleware(['role:admin'])->name('menu.show');
    Route::delete('menu/{id}',[MenuController::class, 'destroy'])->middleware(['role:admin'])->name('menu.delete');
    // Route::get('menu/hapus/{id}', [MenuController::class, 'hapus'])->middleware(['role:admin,staff'])->name('menu.hapus');

    Route::get('meja', [MejaController::class, 'index'])->middleware(['role:admin,kasir,pegawai'])->name('meja.index');
    Route::post('meja/store', [MejaController::class, 'store'])->middleware(['role:admin,kasir,pegawai'])->name('meja.store');
    Route::put('meja/{id}', [MejaController::class, 'update'])->middleware(['role:admin,kasir,pegawai'])->name('meja.update');
    Route::delete('meja/{id}', [MejaController::class, 'destroy'])->middleware(['role:admin,kasir,pegawai'])->name('meja.delete');

    Route::get('pesanan', [PesananController::class, 'index'])->middleware(['role:admin,kasir,pegawai'])->name('pesanan.index');
    Route::post('pesanan/store', [PesananController::class, 'store'])->middleware(['role:admin,kasir,pegawai'])->name('pesanan.store');
    Route::put('pesanan/{id}', [PesananController::class, 'update'])->middleware(['role:admin,kasir,pegawai'])->name('pesanan.update');
    Route::delete('pesanan/{id}', [PesananController::class, 'destroy'])->middleware(['role:admin,kasir,pegawai'])->name('pesanan.delete');

    Route::get('pembayaran', [PembayaranController::class, 'index'])->middleware(['role:admin,kasir,'])->name('pembayaran.index');
    Route::post('pembayaran/store', [PembayaranController::class, 'store'])->middleware(['role:admin,kasir,'])->name('pembayaran.store');
    Route::put('pembayaran/{id}', [PembayaranController::class, 'update'])->middleware(['role:admin,kasir,'])->name('pembayaran.update');
    Route::delete('pembayaran/{id}', [PembayaranController::class, 'destroy'])->middleware(['role:admin,kasir,'])->name('pembayaran.delete');
    
});
require __DIR__.'/auth.php';
