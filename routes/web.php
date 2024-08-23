<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\FileuploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(BaseController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');

    Route::post('/user-store', 'store_user')->name('user.store');
    Route::post('/user-authenticate', 'auth_user')->name('user.auth');

    Route::post('/user-logout', 'logout')->name('user.logout');
});

Route::controller(AdminController::class)->prefix('admin')->group(function () {
    Route::get('/dashboard', 'dashboard')->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Settings Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/settings', 'settings')->name('admin.settings');
    Route::get('/site-settings', 'site_settings')->name('admin.site_settings');
    Route::get('/audit-trail', 'audit_trail')->name('admin.audit_trail');
    Route::get('/audit-trail-get', 'audit_trail_get')->name('admin.audit_trail_get');

    Route::post('/site-settings-save', 'site_settings_save')->name('admin.site_settings_save');


})->middleware('auth');



