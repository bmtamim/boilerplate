<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function () {

    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('customers', CustomerController::class)->except(['show']);

    //Settings Route
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('general/', [SettingController::class, 'generalSettingsIndex'])->name('general.index');
        Route::post('general/', [SettingController::class, 'generalSettingsStore'])->name('general.store');

        Route::get('/profile', [SettingController::class, 'profileSettingsIndex'])->name('profile.index');
        Route::put('/profile/{id}', [SettingController::class, 'profileSettingsUpdate'])->name('profile.update');

        Route::get('password', [SettingController::class, 'passwordView'])->name('password.view');
        Route::put('password/{id}', [SettingController::class, 'passwordChange'])->name('password.change');

        Route::resource('roles', RolePermissionController::class)->except(['show', 'create', 'store', 'destroy']);

    });
});
