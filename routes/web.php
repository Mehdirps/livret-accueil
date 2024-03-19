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
    Route::post('module/wifi', [App\Http\Controllers\DashboardController::class, 'addModuleWifi'])->name('dashboard.module.wifi');
    Route::get('module/wifi/{id}', [App\Http\Controllers\DashboardController::class, 'deleteModuleWifi'])->name('dashboard.module.wifi.delete');

    /* Digicode */
    Route::post('module/digicode', [App\Http\Controllers\DashboardController::class, 'addModuleDigicode'])->name('dashboard.module.digicode');
    Route::get('module/digicode/{id}', [App\Http\Controllers\DashboardController::class, 'deleteModuleDigicode'])->name('dashboard.module.digicode.delete');

    /* Utils phone */
    Route::post('module/utils_phone', [App\Http\Controllers\DashboardController::class, 'addModuleUtilsPhone'])->name('dashboard.module.utils_phone');
    Route::get('module/utils_phone/{id}', [App\Http\Controllers\DashboardController::class, 'deleteModuleUtilsPhone'])->name('dashboard.module.utils_phone.delete');

    /* Utils infos */
    Route::post('module/utils_infos', [App\Http\Controllers\DashboardController::class, 'addModuleUtilsInfos'])->name('dashboard.module.utils_infos');
    Route::get('module/utils_infos/{id}', [App\Http\Controllers\DashboardController::class, 'deleteModuleUtilsInfos'])->name('dashboard.module.utils_infos.delete');

    /* Start info */
    Route::post('module/start_info', [App\Http\Controllers\DashboardController::class, 'addModuleStartInfo'])->name('dashboard.module.start_info');
    Route::get('module/start_info/{id}', [App\Http\Controllers\DashboardController::class, 'deleteModuleStartInfo'])->name('dashboard.module.start_info.delete');

    /* End info */
    Route::post('module/end_info', [App\Http\Controllers\DashboardController::class, 'addModuleEndInfo'])->name('dashboard.module.end_info');
    Route::get('module/end_info/{id}', [App\Http\Controllers\DashboardController::class, 'deleteModuleEndInfo'])->name('dashboard.module.end_info.delete');

    /* Home Infos */
    Route::post('module/home_infos', [App\Http\Controllers\DashboardController::class, 'addModuleHomeInfos'])->name('dashboard.module.home_infos');
});
