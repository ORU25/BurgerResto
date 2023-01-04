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
});

Route::get('user', [UserController::class, 'index'])->middleware(['role:admin'])->name('user.index');
Route::get('user/create', [UserController::class, 'create'])->middleware(['role:admin'])->name('user.create');
Route::post('user/store', [UserController::class, 'store'])->middleware(['role:admin'])->name('user.store');
Route::get('user/edit/{id}', [UserController::class, 'edit'])->middleware(['role:admin'])->name('user.edit');
Route::put('user/{id}', [UserController::class, 'update'])->middleware(['role:admin'])->name('user.update');
Route::get('user/show/{id}',[UserController::class,'show'])->middleware(['role:admin'])->name('user.show');
Route::delete('user/{id}',[UserController::class, 'destroy'])->middleware(['role:admin'])->name('user.delete');

require __DIR__.'/auth.php';
