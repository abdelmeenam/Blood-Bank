<?php


use App\Http\Controllers\Api\DonationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function () {

    // Auth Routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('password/email',  [AuthController::class, 'forgetPassword']);
    Route::post('password/reset', [AuthController::class, 'resetPassword']);


    Route::group(['middleware' => 'auth:sanctum'], function () {

        // Main Routes
        Route::get('/governorates', [MainController::class, 'getAllGovernates']);
        Route::get('/cities', [MainController::class, 'getAllCities']);

        // Profile Routes
        Route::post('/edit-profile', [ProfileController::class, 'updateProfile']);
        Route::get('/show-profile', [ProfileController::class, 'getProfile']);

        // Notification Settings Routes
        Route::get('/get-notification-settings', [ProfileController::class, 'getNotificationSettings']);
        Route::post('/update-notification-settings', [ProfileController::class, 'updateNotificationSettings']);

        // Posts Routes
        Route::get('posts', [PostController::class, 'getAllPosts']);
        Route::get('post', [PostController::class, 'showPost']);
        Route::get('search-posts', [PostController::class, 'search']);
        Route::get('filter-post-by-category', [PostController::class, 'filterByCategory']);
        Route::post('toggle-post', [PostController::class, 'postToggleFavourite']);
        Route::get('list-favourites', [PostController::class, 'getAllFavourites']);

        // Donation Routes
        Route::post('create-donation-request', [DonationController::class, 'createDonationRequest']);
        Route::get('donation-requests', [DonationController::class, 'getAllDonationRequests']);
        Route::get('filter-requests', [DonationController::class, 'filterDonationRequestsByBloodType']);
        Route::post('store-fcm-token', [AuthController::class, 'storeFcmToken']);
        Route::post('remove-fcm-token', [AuthController::class, 'removeFcmToken']);

        Route::get('/logout', [AuthController::class, 'logout']);
    });
});
