<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Search Data
Route::get('/books', [BookController::class, 'index']);

// Add Books
Route::post('/books', [BookController::class, 'store']);

// Get Books
Route::get('/books/{id}', [BookController::class, 'show']);

// Update Books
Route::put('/books/{id}', [BookController::class, 'update']);

// Delete Books
Route::delete('/books/{id}', [BookController::class, 'destroy']);