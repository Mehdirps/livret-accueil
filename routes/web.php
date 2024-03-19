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

Route::get('/livret/{slug}/{id}', [App\Http\Controllers\LivretController::class, 'show'])->name('livret.show');

/* Authentification */
Route::prefix('auth')->group(function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'doLogin'])->name('home.login');
    Route::post('register', [App\Http\Controllers\AuthController::class, 'doRegister'])->name('home.register');
    Route::get('verify_email/{email}', [App\Http\Controllers\AuthController::class, 'verify'])->name('home.verify');
    Route::get('logout', [App\Http\Controllers\AuthController::class, 'doLogout'])->name('dashboard.logout');
});

/* Dashboard */
Route::prefix('dashboard')->middleware('auth.check')->group(function () {
    /* First login / Create livret*/
    Route::get('first_login', [App\Http\Controllers\DashboardController::class, 'seeFirstLogin'])->name('dashboard.first_login');
    Route::post('first_login', [App\Http\Controllers\LivretController::class, 'store'])->name('dashboard.first_login');

    /* Dashboard index*/
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    /* Profile */
    Route::get('profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('profile', [App\Http\Controllers\DashboardController::class, 'updateUser'])->name('dashboard.profile.update_user');

    /* Password */
    Route::post('profile/update_password', [App\Http\Controllers\DashboardController::class, 'updatePassword'])->name('dashboard.profile.update_password');

    /* Livret */
    Route::post('profile/update_livret', [App\Http\Controllers\DashboardController::class, 'updateLivret'])->name('dashboard.profile.update_livret');
    Route::get('background', [App\Http\Controllers\DashboardController::class, 'background'])->name('dashboard.background');
    Route::get('background/{id}', [App\Http\Controllers\DashboardController::class, 'updateBackground'])->name('dashboard.background.update');
    Route::get('edit_livret', [App\Http\Controllers\DashboardController::class, 'editLivret'])->name('dashboard.edit_livret');
    /* Livret Module */
    /* Wifi */
    Route::post('module/wifi', [App\Http\Controllers\DashboardController::class, 'moduleWifi'])->name('dashboard.module.wifi');

    /* Digicode */
    Route::post('module/digicode', [App\Http\Controllers\DashboardController::class, 'addModuleDigicode'])->name('dashboard.module.digicode');
    Route::get('module/digicode/{id}', [App\Http\Controllers\DashboardController::class, 'deleteModuleDigicode'])->name('dashboard.module.digicode.delete');
});
