<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/services', [ServiceController::class, 'index']);
Route::post('/services/store', [ServiceController::class, 'store']);

