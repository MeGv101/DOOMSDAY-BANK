<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('index');
});



Route::get('/transactions', [AccountController::class, 'index']);
Route::post('/deposit', [AccountController::class, 'deposit']);
Route::post('/withdraw', [AccountController::class, 'withdraw']);

// Vistas
Route::get('/login', [AuthController::class, 'showLogin']);
Route::get('/register', [AuthController::class, 'showRegister']);

// Acciones
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

// Ruta protegida
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth.custom');
Route::get('/transactions', function () {
    return view('transactions.index');
})->middleware('auth.custom');

Route::get('/', function () {
    if (session('user_id')) {
        return redirect('/dashboard');
    }
    return view('index');
});


Route::middleware(['auth.custom', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});

// Rutas de administración de usuarios
Route::middleware(['auth.custom', 'admin'])->group(function () {

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/delete/{id}', [UserController::class, 'delete']);

});

Route::get('/transactions', [AccountController::class, 'index']);