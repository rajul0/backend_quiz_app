<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\UsersController;
use App\Models\Quiz;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
