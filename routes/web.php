<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard\CityController;
use App\Http\Controllers\AdminDashboard\PostController;
use App\Http\Controllers\AdminDashboard\ClientController;
use App\Http\Controllers\AdminDashboard\ContactController;
use App\Http\Controllers\AdminDashboard\ProfileController;
use App\Http\Controllers\AdminDashboard\SettingController;
use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\AdminDashboard\DonationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AdminDashboard\GovernorateController;
<<<<<<< HEAD
use App\Http\Controllers\AdminDashboard\UserController;
=======
use App\Http\Controllers\AdminDashboard\AdminController;
>>>>>>> e6235a202f6f7643cce5012104e3f351bcb17c1b

Route::get('/', function () {
    return view('welcome');
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
<<<<<<< HEAD
        Route::resource('users', UserController::class);
=======
        Route::resource('admins', AdminController::class);
>>>>>>> e6235a202f6f7643cce5012104e3f351bcb17c1b

        // Edit Settings
        Route::get('/settings/edit', [SettingController::class, 'editSetting'])->name('admin.settings.edit');
        Route::patch('/settings/update', [SettingController::class, 'updateSetting'])->name('admin.settings.update');

        // Edit Profile
        Route::get('/admin-profile/edit', [ProfileController::class, 'editProfile'])->name('admin.password.edit');
        Route::put('/admin-profile/update', [ProfileController::class, 'updateProfile'])->name('admin.password.update');

        // Get Cities by Governorate
        Route::get('/get-cities/{governorateId}', [CityController::class, 'getCities'])->name('get-cities');
        Route::post('/update-user-status/{userId}', [ClientController::class, 'updateUserStatus'])->name('update-user-status');

        // Search Clients
        Route::get('/search-clients', [ClientController::class, 'searchClients'])->name('search-clients');

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    }
);


require __DIR__ . '/auth.php';