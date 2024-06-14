<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrokersController;
use App\Http\Controllers\EnquiriesController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ConfigurationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/enquiries', [EnquiriesController::class, 'store']);

Route::get('/configurations', [ConfigurationController::class, 'getAll']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::group(['middleware' => ['role:superAdmin,admin']], function () {
        Route::post('/configurations', [ConfigurationController::class, 'store']);
        Route::get('/configurations/{configName}', [ConfigurationController::class, 'show']);
        Route::put('/configurations/{configName}', [ConfigurationController::class, 'update']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/users/trashed', [UsersController::class, 'trashed']);
        Route::post('/users/{id}/restore', [UsersController::class, 'restore']);
        Route::delete('/users/{id}/force', [UsersController::class, 'forceDelete']);
        Route::apiResource('/users', UsersController::class);
        Route::get('/enquiries/trashed', [EnquiriesController::class, 'trashed']);
        Route::post('/enquiries/{id}/restore', [EnquiriesController::class, 'restore']);
        Route::delete('/enquiries/{id}/force', [EnquiriesController::class, 'forceDelete']);
    });
    Route::group(['middleware' => ['role:superAdmin,admin,user']], function () {
        Route::apiResource('/enquiries', EnquiriesController::class)->except(['store', 'create']);
    });
});