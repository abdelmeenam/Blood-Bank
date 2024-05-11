<?php

use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\AdminDashboard\CityController;
use App\Http\Controllers\AdminDashboard\ClientController;
use App\Http\Controllers\AdminDashboard\ContactController;
use App\Http\Controllers\AdminDashboard\DonationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AdminDashboard\GovernorateController;
use App\Http\Controllers\AdminDashboard\PostController;
use App\Http\Controllers\AdminDashboard\SettingController;
use App\Models\Contact;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(
    ['prefix' => LaravelLocalization::setLocale(),    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']],
    function () {
        Route::resource('governorates', GovernorateController::class);
        Route::resource('cities', CityController::class);
        Route::resource('posts', PostController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('contacts', ContactController::class);
        Route::resource('donations', DonationController::class);
        Route::resource('settings', SettingController::class);

        Route::get('/get-cities/{governorateId}', [CityController::class, 'getCities'])->name('get-cities');
        Route::post('/update-user-status/{userId}', [ClientController::class, 'updateUserStatus'])->name('update-user-status');

        Route::get('/search-clients', [ClientController::class, 'searchClients'])->name('search-clients');



        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    }
);


require __DIR__ . '/auth.php';
