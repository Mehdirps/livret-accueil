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

/* CGU */
Route::get('/cgu', function () {
    return view('cgu');
})->name('cgu');

Route::get('/livret/{slug}/{id}', [App\Http\Controllers\LivretController::class, 'show'])->name('livret.show');

// Fait une route de test pour mon api en POST et return les données recu
Route::post('/test', function () {

    // Fait un validator pour la request
    $validator = Validator::make(request()->all(), [
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|numeric',
        'message' => 'required|string',
    ]);

    // Si le validator echoue, return les erreurs

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    return response()->json(request()->all(), 200);
});
/* Suggestions */
Route::post('/suggestions', [App\Http\Controllers\SuggestionController::class, 'store'])->name('suggestion.store');

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
    Route::get('stats', [App\Http\Controllers\DashboardController::class, 'stats'])->name('dashboard.stats');
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

    /* Places groups */
    Route::post('module/places_groups', [App\Http\Controllers\DashboardController::class, 'addModulePlacesGroups'])->name('dashboard.module.places_groups');
    Route::get('module/places_groups/{id}', [App\Http\Controllers\DashboardController::class, 'deleteModulePlacesGroups'])->name('dashboard.module.places_groups.delete');

    /* Nearby Places */
    Route::post('module/nearby_places', [App\Http\Controllers\DashboardController::class, 'addModuleNearbyPlaces'])->name('dashboard.module.nearby_places');
    Route::get('module/nearby_places/{id}', [App\Http\Controllers\DashboardController::class, 'deleteModuleNearbyPlaces'])->name('dashboard.module.nearby_places.delete');

    /* Module order */
    Route::post('/update-order', [App\Http\Controllers\DashboardController::class, 'updateOrder'])->name('dashboard.update-order');

    /* Inventories */
    Route::get('/inventories', [App\Http\Controllers\DashboardController::class, 'inventories'])->name('dashboard.inventories');
    Route::post('/inventories', [App\Http\Controllers\DashboardController::class, 'addInventory'])->name('dashboard.inventories.add');
    Route::post('/inventories/update', [App\Http\Controllers\DashboardController::class, 'statusInventory'])->name('dashboard.inventories.status');
    Route::delete('/inventories/{id}', [App\Http\Controllers\DashboardController::class, 'deleteInventory'])->name('dashboard.inventories.delete');
    Route::post('dashboard.inventories.search', [App\Http\Controllers\DashboardController::class, 'searchInventories'])->name('dashboard.inventories.search');

    /* Contact */
    Route::post('module/contact', [App\Http\Controllers\DashboardController::class, 'contactSupport'])->name('dashboard.contact');

    /* Suggestions */
    Route::get('suggestions', [App\Http\Controllers\DashboardController::class, 'suggestions'])->name('dashboard.suggestions');
    Route::get('suggestion/enable/{id}', [App\Http\Controllers\DashboardController::class, 'enableSuggestion'])->name('dashboard.suggestion.enable');
    Route::post('suggestion/status', [App\Http\Controllers\DashboardController::class, 'statusSuggestion'])->name('dashboard.suggestion.status');
    Route::post('dashboard.suggestion.search', [App\Http\Controllers\DashboardController::class, 'searchSuggestions'])->name('dashboard.suggestion.search');

    /* Products */
    Route::get('products', [App\Http\Controllers\DashboardController::class, 'products'])->name('dashboard.products');
/*    Route::get('products/search', [App\Http\Controllers\DashboardController::class, 'searchProducts'])->name('dashboard.products.search');*/

    /* Text design */
    Route::post('/update-text-design', [App\Http\Controllers\DashboardController::class, 'updateTextDesign'])->name('dashboard.update-text-design');

    /* PDF Export */
    Route::post('datas/export', [App\Http\Controllers\DashboardController::class, 'exportDatas'])->name('dashboard.datas.export');

});

/* Admin */
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    /* Users */
    Route::get('users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users.index');
    Route::get('users/enable/{id}', [App\Http\Controllers\AdminController::class, 'enableUser'])->name('admin.user.enable');
    Route::get('/admin/user/search', [App\Http\Controllers\AdminController::class, 'searchUsers'])->name('admin.user.searchUsers');

    /* Backgrounds */
    Route::get('backgrounds', [App\Http\Controllers\AdminController::class, 'backgrounds'])->name('admin.backgrounds.index');
    Route::post('background_groups', [App\Http\Controllers\AdminController::class, 'addBackgroundGroup'])->name('admin.background_groups.add');
    Route::get('background_groups/{id}', [App\Http\Controllers\AdminController::class, 'deleteBackgroundGroup'])->name('admin.background_groups.delete');
    Route::post('backgrounds', [App\Http\Controllers\AdminController::class, 'addBackground'])->name('admin.backgrounds.add');
    Route::get('backgrounds/{id}', [App\Http\Controllers\AdminController::class, 'deleteBackground'])->name('admin.backgrounds.delete');

    /* Livrets */
    Route::get('livrets', [App\Http\Controllers\AdminController::class, 'livrets'])->name('admin.livrets.index');
    Route::get('livret/search', [App\Http\Controllers\AdminController::class, 'searchLivrets'])->name('admin.livret.searchLivrets');

    /* Products */
    Route::get('products', [App\Http\Controllers\AdminController::class, 'products'])->name('admin.products.index');
    Route::post('products', [App\Http\Controllers\AdminController::class, 'addProduct'])->name('admin.products.add');
    Route::get('products/{id}', [App\Http\Controllers\AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    Route::post('products/update', [App\Http\Controllers\AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::post('products/search', [App\Http\Controllers\AdminController::class, 'searchProducts'])->name('admin.products.searchProducts');

    /* Product Catégories */
    Route::post('product_categories', [App\Http\Controllers\AdminController::class, 'addProductCategory'])->name('admin.product_categories.add');
    Route::get('product_categories/{id}', [App\Http\Controllers\AdminController::class, 'deleteProductCategory'])->name('admin.product_categories.delete');
    Route::post('product_categories/update', [App\Http\Controllers\AdminController::class, 'updateProductCategory'])->name('admin.product_categories.update');
});
