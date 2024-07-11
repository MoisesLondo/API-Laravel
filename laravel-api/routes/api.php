<?php

use App\Http\Controllers\bookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/books', [bookController::class, 'index']);

Route::get('/books/{id}', function(){
    return "libro";
});

Route::post('/books', [bookController::class, 'save']);

Route::put('/books/{id}', function(){
    return "actualizando libro";
});

Route::delete('/books/{id}', function(){
    return "eliminando libros";
});
