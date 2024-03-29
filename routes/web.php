<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdmin;
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

Route::get('/', [LandingPageController::class, 'landingPage'])->name('/');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix('/admin')
    ->controller(AdminController::class)
    ->middleware([CheckAdmin::class])
    ->group(function () {
        Route::get('', 'index');
    });

Route::resource('users', UserController::class);

Route::prefix('businesses')
    ->controller(BusinessController::class)
    ->group(function () {
        Route::get('', 'index')->name('businesses.index');
        Route::get('{id}', 'show')->name('businesses.show');
        Route::post('', 'store')->name('businesses.store');
        Route::get('{id}/edit', 'edit')->name('businesses.edit');
        Route::put('{id}', 'update')->name('businesses.update');
        Route::patch('{id}', 'update')->name('businesses.change');
        Route::delete('{id}', 'destroy')->name('businesses.destroy');
    });
