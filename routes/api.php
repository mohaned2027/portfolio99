<?php

use Laravel\Mcp\Enums\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExperienceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/auth/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {


    Route::get('/user', [UserController::class, 'index']);
    Route::delete('/auth/logout', [LoginController::class, 'logout']);

    // Education
    Route::controller(EducationController::class)->prefix('education')->group(function () {
        Route::get('/',  'index');
        Route::post('/store',  'store');
        Route::put('/update/{id}',  'update');
        Route::delete('/delete/{id}',  'destroy');
    });


    // Experience
    Route::controller(ExperienceController::class)->prefix('experience')->group(function () {
        Route::get('/',  'index');
        Route::post('/store',  'store');
        Route::put('/update/{id}',  'update');
        Route::delete('/delete/{id}',  'destroy');
    });


    // Skills
    Route::controller(SkillController::class)->prefix('skill')->group(function () {
        Route::get('/',  'index');
        Route::post('/store',  'store');
        Route::put('/update/{id}',  'update');
        Route::delete('/delete/{id}',  'destroy');
    });

    // Blog
    Route::controller(BlogController::class)->prefix('blog')->group(function () {
        Route::get('/',  'index');
        Route::post('/store',  'store');
        Route::put('/update/{id}',  'update');
        Route::delete('/delete/{id}',  'destroy');
    });

    // Certifications
    Route::controller(CertificateController::class)->prefix('certification')->group(function () {
        Route::get('/',  'index');
        Route::post('/store',  'store');
        Route::put('/update/{id}',  'update');
        Route::delete('/delete/{id}',  'destroy');
    });

    // Portfolio
    Route::controller(ProjectController::class)->prefix('portfolio')->group(function () {
        Route::get('/',  'index');
        Route::post('/store',  'store');
        Route::put('/update/{id}',  'update');
        Route::delete('/delete/{id}',  'destroy');
    });

    // Settings
    Route::controller(SettingController::class)->prefix('setting')->group(function () {
        Route::get('/',  'index');
        Route::post('/store',  'store');
        Route::put('/update/{id}',  'update');
        Route::delete('/delete/{id}',  'destroy');
    });

    // Team
    Route::controller(TeamController::class)->prefix('team')->group(function () {
        Route::get('/',  'index');
        Route::post('/store',  'store');
        Route::put('/update/{id}',  'update');
        Route::delete('/delete/{id}',  'destroy');
    });
});
