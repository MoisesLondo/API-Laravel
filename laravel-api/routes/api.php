<?php

use App\Http\Controllers\tripController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/trips', [tripController::class, 'trips']);

Route::get('/trips/{id}',[tripController::class, 'oneTrip']);

Route::post('/trips', [tripController::class, 'save']);

Route::put('/trips/{id}', [tripController::class, 'update']);

Route::delete('/trips/{id}', [tripController::class, 'delete']);
