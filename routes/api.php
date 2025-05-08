<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;


Route::middleware('auth:sanctum')->group(function () {
    // Autores
    Route::apiResource('authors', AuthorController::class);

    // Libros
    Route::apiResource('books', BookController::class);
});

// Rutas públicas
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Ruta protegida: solo accesible con token
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


