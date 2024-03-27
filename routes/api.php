<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\ProfileController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function () {

    // Auth Routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {

        // Main Routes
        Route::get('/governorates', [MainController::class, 'getAllGovernates']);
        Route::get('/cities', [MainController::class, 'getAllCities']);
        Route::get('/posts', [MainController::class, 'getAllPosts']);

        // Profile Routes
        Route::match(['get', 'post'], '/edit-profile', [ProfileController::class, 'updateProfile']);

        // Notification Settings Routes
        Route::get('/get-notification-settings', [ProfileController::class, 'getNotificationSettings']);
        Route::post('/update-notification-settings', [ProfileController::class, 'updateNotificationSettings']);





        Route::get('/logout', [AuthController::class, 'logout']);
    });
});