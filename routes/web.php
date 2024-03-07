<?php

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

Route::get('/', function () {
    return view('index');
})->name('home');

/* Authentification */
Route::prefix('auth')->group(function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'doLogin'])->name('home.login');
    Route::post('register', [App\Http\Controllers\AuthController::class, 'doRegister'])->name('home.register');
    Route::get('verify_email/{email}', [App\Http\Controllers\AuthController::class, 'verify'])->name('home.verify');
    Route::get('logout', [App\Http\Controllers\AuthController::class, 'doLogout'])->name('dashboard.logout');
});

/* Dashboard */
Route::prefix('dashboard')->middleware('auth.check')->group(function () {
    Route::get('first_login', [App\Http\Controllers\DashboardController::class, 'seeFirstLogin'])->name('dashboard.first_login');
    Route::post('first_login', [App\Http\Controllers\LivretController::class, 'store'])->name('dashboard.first_login');
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('profile', [App\Http\Controllers\DashboardController::class, 'updateUser'])->name('dashboard.profile.update_user');
    Route::post('profile/update_livret', [App\Http\Controllers\DashboardController::class, 'updateLivret'])->name('dashboard.profile.update_livret');
});
