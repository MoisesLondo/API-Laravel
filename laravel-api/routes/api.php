<?php

use App\Http\Controllers\bookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/books', [bookController::class, 'books']);

Route::post('/books', [bookController::class, 'save']);

Route::put('/books/{id}', [bookController::class, 'update']);

Route::delete('/books/{id}', [bookController::class, 'delete']);
