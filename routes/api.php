<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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

// Rute untuk Kuis
Route::get('/kuis', [QuizController::class, 'index']);

Route::post('/kuis/buatKuis', [QuizController::class, 'buatKuis']);
Route::put('/kuis/{id}/tambahPertanyaan', [QuizController::class, 'tambahPertanyaan']);
