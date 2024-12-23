<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\RiwayatKuisController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);

// Route untuk user dengan autentikasi Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user(); // Mengembalikan data user yang sedang login
    });

    // Resource routes untuk UsersController
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']); // Menampilkan semua user
        Route::post('/', [UserController::class, 'store']); // Menambahkan user baru
        Route::get('/{id}', [UserController::class, 'show']); // Menampilkan user berdasarkan ID
        Route::put('/{id}', [UserController::class, 'update']); // Mengupdate user
        Route::delete('/{id}', [UserController::class, 'destroy']); // Menghapus user
    });
});

// Rute untuk resource Kuis
Route::prefix('kuis')->group(function () {
    Route::get('/', [QuizController::class, 'index']); // Menampilkan semua kuis
    Route::get('/{id}', [QuizController::class, 'getQuizById']); // Menampilkan kuis berdasarkan ID
    Route::get('/{id}/pertanyaan', [QuizController::class, 'getPertanyaanByQuizId']); // Menampilkan pertanyaan berdasarkan ID kuis
    Route::get('/available/{id}', [QuizController::class, 'getAvailableQuizById']); // Menampilkan kuis yang tersedia berdasarkan ID
    Route::post('/buatKuis', [QuizController::class, 'buatKuis']); // Membuat kuis baru
    Route::put('/{id}/tambahPertanyaan', [QuizController::class, 'tambahPertanyaan']); // Menambahkan pertanyaan ke kuis
    Route::put('/{id}/update-time', [QuizController::class, 'updateQuizTime']); // Mengupdate waktu kuis
    Route::delete('/{id}/delete-time', [QuizController::class, 'deleteQuizTime']); // Mengupdate waktu kuis
    Route::delete('/hapusKuis/{id}', [QuizController::class, 'destroy']); // Menghapus kuis berdasarkan ID
});

// Routes untuk Riwayat Kuis
Route::prefix('riwayat-kuis')->group(function () {
    Route::get('/', [RiwayatKuisController::class, 'index']); // Menampilkan semua riwayat kuis
    Route::post('/simpanRiwayat', [RiwayatKuisController::class, 'simpanRiwayatKuis']); // Menyimpan riwayat baru
    Route::get('/{id}', [RiwayatKuisController::class, 'show']); // Menampilkan riwayat berdasarkan ID
    Route::post('/kuis-user', [RiwayatKuisController::class, 'getQuizHistory']); // Retrieve quiz history based on id_kuis and id_user
    Route::post('/by-kuis', [RiwayatKuisController::class, 'getQuizHistoryByKuis']); // by id kuis
    Route::post('/by-user', [RiwayatKuisController::class, 'getQuizHistoryByUser']); // by id user
    Route::delete('/{id}', [RiwayatKuisController::class, 'destroy']); // Menghapus riwayat
});
