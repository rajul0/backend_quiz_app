<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk mendapatkan daftar pengguna (GET)
Route::get('/users', [UsersController::class, 'index']);

// Rute untuk menambahkan pengguna baru (POST)
Route::post('/users', [UsersController::class, 'store']);

// Rute untuk mendapatkan detail pengguna berdasarkan ID (GET)
Route::get('/users/{id}', [UsersController::class, 'show']);

// Rute untuk mengupdate pengguna (PUT)
Route::put('/users/{id}', [UsersController::class, 'update']);

// Rute untuk menghapus pengguna (DELETE)
Route::delete('/users/{id}', [UsersController::class, 'destroy']);
