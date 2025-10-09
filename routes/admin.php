<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\admin\ApplicationController;
use App\Http\Controllers\Api\admin\CityController;
use App\Http\Controllers\Api\admin\JobController;
use App\Http\Controllers\Api\admin\SecurityNumController;

use App\Http\Controllers\Api\auth\AuthController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::controller(ApplicationController::class)
    ->prefix('application')->group(function(){
        Route::get('/', 'view');
        Route::get('/favourites', 'favourites');
        Route::put('/status/{id}', 'status');
        Route::delete('/delete/{id}', 'delete_application');
    });
    Route::controller(CityController::class)
    ->prefix('city')->group(function(){
        Route::get('/', 'view');
        Route::put('/status/{id}', 'status');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete');
    });
    Route::controller(JobController::class)
    ->prefix('job')->group(function(){
        Route::get('/', 'view');
        Route::put('/status/{id}', 'status');
        Route::post('/add', 'create');
        Route::post('/update/{id}', 'modify');
        Route::delete('/delete/{id}', 'delete');
    });
    Route::controller(SecurityNumController::class)
    ->prefix('security')->group(function(){
        Route::get('/', 'view');                  // GET /api/security
        Route::put('/status', 'status');     // PUT /api/security/status/{id}
        Route::post('/add_update', 'create_update'); // POST /api/security/add_update
    });

});