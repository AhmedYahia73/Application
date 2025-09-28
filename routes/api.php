<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\client\ApplicationController;

Route::get('lists', [ApplicationController::class, 'lists']);
Route::post('send_email', [ApplicationController::class, 'send_email']);
Route::post('check_security', [ApplicationController::class, 'check_security']);