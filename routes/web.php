<?php

use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(function() {Route::get('/buku', [BukuController::class, 'index']);
Route::get( '/buku/create', [BukuController::class, 'create' ])->name( 'buku.create');
Route::post('/buku', [BukuController::class, 'store' ])->name( 'buku.store');
Route::delete('/buku/{id}', [BukuController::class, 'destroy' ])->name ( 'buku.destroy');
Route::put('/buku/{id}', [BukuController::class, 'update' ])->name ( 'buku.update');
Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
   });

   